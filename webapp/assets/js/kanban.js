document.addEventListener('DOMContentLoaded', function () {
  const board = document.getElementById('kanbanBoard');
  if (!board) return;

  let cardArrastado = null;

  board.querySelectorAll('.kanban-card').forEach(function (card) {
    card.addEventListener('dragstart', function () {
      cardArrastado = card;
      card.classList.add('dragging');
    });
    card.addEventListener('dragend', function () {
      card.classList.remove('dragging');
      cardArrastado = null;
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

      const projetoId = cardArrastado.dataset.projetoId;
      const etapaId = coluna.dataset.etapaId;
      const container = coluna.querySelector('.kanban-column-body');
      container.appendChild(cardArrastado);

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
            alert('Não foi possível mover o card: ' + (resp.erro || 'erro desconhecido'));
            location.reload();
          } else {
            atualizarContadores();
          }
        })
        .catch(function () {
          alert('Erro de conexão ao mover o card.');
          location.reload();
        });
    });
  });

  function atualizarContadores() {
    document.querySelectorAll('.kanban-column').forEach(function (coluna) {
      const qtd = coluna.querySelectorAll('.kanban-card').length;
      coluna.querySelector('.kanban-column-count').textContent = qtd;
    });
  }
});
