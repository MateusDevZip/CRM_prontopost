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
            mostrarToast('Movido para "' + etapaNome + '"', 'success');
          }
          atualizarContadores();
        })
        .catch(function () {
          origem.appendChild(card);
          mostrarToast('Erro de conexão ao mover o card.', 'error');
          atualizarContadores();
        });
    });
  });

  function atualizarContadores() {
    document.querySelectorAll('.kanban-column').forEach(function (coluna) {
      const qtd = coluna.querySelectorAll('.kanban-card:not(.kanban-card-hidden)').length;
      coluna.querySelector('.kanban-column-count').textContent = qtd;
    });
  }

  const busca = document.getElementById('kanbanBusca');
  const filtroResponsavel = document.getElementById('kanbanFiltroResponsavel');
  const filtroPlano = document.getElementById('kanbanFiltroPlano');
  const contagem = document.getElementById('kanbanFiltroContagem');
  const todosCards = board.querySelectorAll('.kanban-card');

  function aplicarFiltros() {
    const termo = (busca.value || '').trim().toLowerCase();
    const responsavelId = filtroResponsavel.value;
    const planoId = filtroPlano.value;
    let visiveis = 0;

    todosCards.forEach(function (card) {
      const bateNome = !termo || card.dataset.cliente.indexOf(termo) !== -1;
      const bateResponsavel = !responsavelId || card.dataset.responsavelId === responsavelId;
      const batePlano = !planoId || card.dataset.planoId === planoId;
      const visivel = bateNome && bateResponsavel && batePlano;
      card.classList.toggle('kanban-card-hidden', !visivel);
      if (visivel) visiveis++;
    });

    atualizarContadores();
    contagem.textContent = visiveis + ' de ' + todosCards.length + ' projetos';
  }

  if (busca && filtroResponsavel && filtroPlano && contagem) {
    busca.addEventListener('input', aplicarFiltros);
    filtroResponsavel.addEventListener('change', aplicarFiltros);
    filtroPlano.addEventListener('change', aplicarFiltros);
    aplicarFiltros();
  }
});
