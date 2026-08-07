document.addEventListener('DOMContentLoaded', function () {
  const board = document.getElementById('kanbanBoard');
  if (!board) return;

  let cardArrastado = null;
  let colunaOrigem = null;

  function mostrarToast(mensagem, tipo) {
    let container = document.getElementById('toastContainer');
    if (!container) {
      container = document.createElement('div');
      container.id = 'toastContainer';
      container.className = 'toast-container';
      document.body.appendChild(container);
    }
    const toast = document.createElement('div');
    toast.className = 'toast toast-' + (tipo || 'success');
    toast.textContent = mensagem;
    container.appendChild(toast);
    setTimeout(function () {
      toast.classList.add('toast-out');
      setTimeout(function () { toast.remove(); }, 200);
    }, 2600);
  }

  board.querySelectorAll('.kanban-card').forEach(function (card) {
    card.addEventListener('dragstart', function () {
      cardArrastado = card;
      colunaOrigem = card.parentElement;
      card.classList.add('dragging');
    });
    card.addEventListener('dragend', function () {
      card.classList.remove('dragging');
      cardArrastado = null;
      colunaOrigem = null;
    });
  });

  board.querySelectorAll('.kanban-column').forEach(function (coluna) {
    coluna.addEventListener('dragover', function (e) {
      e.preventDefault();
      coluna.classList.add('drag-over');
    });
    coluna.addEventListener('dragleave', function () {
      coluna.classList.remove('drag-over');
    });
    coluna.addEventListener('drop', function (e) {
      e.preventDefault();
      coluna.classList.remove('drag-over');
      if (!cardArrastado) return;

      const card = cardArrastado;
      const origem = colunaOrigem;
      const projetoId = card.dataset.projetoId;
      const etapaId = coluna.dataset.etapaId;
      const etapaNome = coluna.querySelector('.kanban-column-title').textContent;
      const container = coluna.querySelector('.kanban-column-body');
      container.appendChild(card);

      fetch('api/mover_etapa.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          projeto_id: projetoId,
          etapa_id: etapaId,
          csrf_token: window.CSRF_TOKEN,
        }),
      })
        .then(function (r) { return r.json(); })
        .then(function (resp) {
          if (!resp.ok) {
            origem.appendChild(card);
            mostrarToast('Não foi possível mover o card: ' + (resp.erro || 'erro desconhecido'), 'error');
          } else {
            card.dataset.finalizadoEm = resp.finalizado_em ? resp.finalizado_em.slice(0, 10) : '';
            mostrarToast('Movido para "' + etapaNome + '"', 'success');
          }
          atualizarContadores();
          aplicarFiltros();
        })
        .catch(function () {
          origem.appendChild(card);
          mostrarToast('Erro de conexão ao mover o card.', 'error');
          atualizarContadores();
          aplicarFiltros();
        });
    });
  });

  const modalOverlay = document.getElementById('cardModalOverlay');
  const modalCliente = document.getElementById('cardModalCliente');
  const modalProximoPasso = document.getElementById('cardModalProximoPasso');
  const modalSalvarPasso = document.getElementById('cardModalSalvarPasso');
  const modalNotaForm = document.getElementById('cardModalNotaForm');
  const modalNotaTexto = document.getElementById('cardModalNotaTexto');
  const modalNotasLista = document.getElementById('cardModalNotasLista');
  const modalFechar = document.getElementById('cardModalFechar');
  let modalProjetoId = null;
  let arrastouRecentemente = false;

  function renderizarNota(nota) {
    const item = document.createElement('div');
    item.className = 'note-item';
    const autor = document.createElement('span');
    autor.className = 'note-author';
    autor.textContent = nota.usuario_nome;
    const tempo = document.createElement('span');
    tempo.className = 'note-time';
    tempo.textContent = nota.criado_em;
    const corpo = document.createElement('div');
    corpo.style.flex = '1';
    const texto = document.createElement('div');
    texto.className = 'note-text';
    texto.textContent = nota.texto;
    corpo.appendChild(autor);
    corpo.appendChild(tempo);
    corpo.appendChild(texto);
    item.appendChild(corpo);
    return item;
  }

  function abrirModal(card) {
    if (arrastouRecentemente) return;
    const projetoId = card.dataset.projetoId;
    modalProjetoId = projetoId;
    modalCliente.textContent = card.querySelector('.kanban-card-client').textContent;
    modalProximoPasso.value = '';
    modalNotasLista.innerHTML = '<p style="font-size:13px;color:var(--muted)">Carregando…</p>';
    modalOverlay.classList.add('open');

    fetch('api/detalhes_projeto.php?projeto_id=' + encodeURIComponent(projetoId))
      .then(function (r) { return r.json(); })
      .then(function (resp) {
        if (!resp.ok || modalProjetoId !== projetoId) return;
        modalCliente.textContent = resp.cliente_nome;
        modalProximoPasso.value = resp.proximo_passo || '';
        modalNotasLista.innerHTML = '';
        if (!resp.notas.length) {
          modalNotasLista.innerHTML = '<p style="font-size:13px;color:var(--muted)">Nenhuma nota ainda.</p>';
        } else {
          resp.notas.forEach(function (nota) {
            modalNotasLista.appendChild(renderizarNota(nota));
          });
        }
      })
      .catch(function () {
        mostrarToast('Erro ao carregar dados do projeto.', 'error');
      });
  }

  function fecharModal() {
    modalOverlay.classList.remove('open');
    modalProjetoId = null;
  }

  if (modalOverlay) {
    board.querySelectorAll('.kanban-card').forEach(function (card) {
      card.addEventListener('click', function () {
        abrirModal(card);
      });
      card.addEventListener('dragstart', function () {
        arrastouRecentemente = true;
      });
      card.addEventListener('dragend', function () {
        setTimeout(function () { arrastouRecentemente = false; }, 50);
      });
    });

    modalFechar.addEventListener('click', fecharModal);
    modalOverlay.addEventListener('click', function (e) {
      if (e.target === modalOverlay) fecharModal();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modalOverlay.classList.contains('open')) fecharModal();
    });

    modalSalvarPasso.addEventListener('click', function () {
      if (!modalProjetoId) return;
      const texto = modalProximoPasso.value;
      const projetoId = modalProjetoId;

      fetch('api/atualizar_proximo_passo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          projeto_id: projetoId,
          proximo_passo: texto,
          csrf_token: window.CSRF_TOKEN,
        }),
      })
        .then(function (r) { return r.json(); })
        .then(function (resp) {
          if (!resp.ok) {
            mostrarToast('Não foi possível salvar: ' + (resp.erro || 'erro desconhecido'), 'error');
            return;
          }
          const card = board.querySelector('.kanban-card[data-projeto-id="' + projetoId + '"]');
          if (card) {
            const campo = card.querySelector('[data-campo="proximo_passo"]');
            if (campo) {
              campo.textContent = resp.proximo_passo || '-';
              campo.classList.toggle('muted', !resp.proximo_passo);
            }
          }
          mostrarToast('Próximo passo atualizado.', 'success');
        })
        .catch(function () {
          mostrarToast('Erro de conexão ao salvar o próximo passo.', 'error');
        });
    });

    modalNotaForm.addEventListener('submit', function (e) {
      e.preventDefault();
      if (!modalProjetoId) return;
      const texto = modalNotaTexto.value.trim();
      if (!texto) return;
      const projetoId = modalProjetoId;

      fetch('api/adicionar_nota.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          projeto_id: projetoId,
          texto: texto,
          csrf_token: window.CSRF_TOKEN,
        }),
      })
        .then(function (r) { return r.json(); })
        .then(function (resp) {
          if (!resp.ok) {
            mostrarToast('Não foi possível adicionar a nota: ' + (resp.erro || 'erro desconhecido'), 'error');
            return;
          }
          if (modalNotasLista.querySelector('p')) modalNotasLista.innerHTML = '';
          modalNotasLista.insertBefore(renderizarNota(resp.nota), modalNotasLista.firstChild);
          modalNotaTexto.value = '';

          const card = board.querySelector('.kanban-card[data-projeto-id="' + projetoId + '"]');
          if (card) {
            card.classList.add('kanban-card-com-notas');
            let badge = card.querySelector('.kanban-card-notas-badge');
            if (!badge) {
              badge = document.createElement('span');
              badge.className = 'kanban-card-notas-badge';
              badge.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path></svg>';
              badge.appendChild(document.createTextNode(''));
              card.querySelector('.kanban-card-date-row').appendChild(badge);
            }
            badge.title = resp.notas_qtd + ' nota(s) da equipe';
            badge.lastChild.textContent = String(resp.notas_qtd);
          }
          mostrarToast('Nota adicionada.', 'success');
        })
        .catch(function () {
          mostrarToast('Erro de conexão ao adicionar a nota.', 'error');
        });
    });
  }

  function atualizarContadores() {
    document.querySelectorAll('.kanban-column').forEach(function (coluna) {
      const qtd = coluna.querySelectorAll('.kanban-card:not(.kanban-card-hidden)').length;
      coluna.querySelector('.kanban-column-count').textContent = qtd;
    });
  }

  const busca = document.getElementById('kanbanBusca');
  const filtroResponsavel = document.getElementById('kanbanFiltroResponsavel');
  const filtroPlano = document.getElementById('kanbanFiltroPlano');
  const filtroDataDe = document.getElementById('kanbanDataDe');
  const filtroDataAte = document.getElementById('kanbanDataAte');
  const contagem = document.getElementById('kanbanFiltroContagem');
  const mesPronto = document.getElementById('kanbanMesPronto');
  const mesProntoLimpar = document.getElementById('kanbanMesProntoLimpar');
  const todosCards = board.querySelectorAll('.kanban-card');

  function aplicarFiltros() {
    const termo = (busca.value || '').trim().toLowerCase();
    const responsavelId = filtroResponsavel.value;
    const planoId = filtroPlano.value;
    const dataDe = filtroDataDe.value;
    const dataAte = filtroDataAte.value;
    const mesSelecionado = mesPronto ? mesPronto.value : '';
    let visiveis = 0;

    todosCards.forEach(function (card) {
      const chegouEm = card.dataset.chegouEm || '';
      const bateNome = !termo || card.dataset.cliente.indexOf(termo) !== -1;
      const bateResponsavel = !responsavelId || card.dataset.responsavelId === responsavelId;
      const batePlano = !planoId || card.dataset.planoId === planoId;
      const bateDataDe = !dataDe || (chegouEm && chegouEm >= dataDe);
      const bateDataAte = !dataAte || (chegouEm && chegouEm <= dataAte);

      const coluna = card.closest('.kanban-column');
      const ehColunaPronto = !!coluna && coluna.dataset.etapaNome === 'Prontos';
      const finalizadoEm = card.dataset.finalizadoEm || '';
      const bateMesPronto = !ehColunaPronto || !mesSelecionado || finalizadoEm.slice(0, 7) === mesSelecionado;

      const visivel = bateNome && bateResponsavel && batePlano && bateDataDe && bateDataAte && bateMesPronto;
      card.classList.toggle('kanban-card-hidden', !visivel);
      if (visivel) visiveis++;
    });

    atualizarContadores();
    contagem.textContent = visiveis + ' de ' + todosCards.length + ' projetos';
  }

  if (mesPronto && mesProntoLimpar) {
    mesPronto.addEventListener('change', aplicarFiltros);
    mesProntoLimpar.addEventListener('click', function () {
      mesPronto.value = '';
      aplicarFiltros();
    });
  }

  if (busca && filtroResponsavel && filtroPlano && filtroDataDe && filtroDataAte && contagem) {
    busca.addEventListener('input', aplicarFiltros);
    filtroResponsavel.addEventListener('change', aplicarFiltros);
    filtroPlano.addEventListener('change', aplicarFiltros);
    filtroDataDe.addEventListener('change', aplicarFiltros);
    filtroDataAte.addEventListener('change', aplicarFiltros);
    aplicarFiltros();
  }
});
