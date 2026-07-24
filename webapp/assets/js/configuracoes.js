document.addEventListener('DOMContentLoaded', function () {
  const tbody = document.querySelector('#etapasTable tbody');
  if (!tbody) return;

  let linhaArrastada = null;

  function salvarOrdem() {
    const linhas = tbody.querySelectorAll('tr[data-etapa-id]');
    const params = new URLSearchParams();
    linhas.forEach(function (linha, indice) {
      params.append('ids[]', linha.dataset.etapaId);
      const inputOrdem = linha.querySelector('input[name="ordem"]');
      if (inputOrdem) inputOrdem.value = indice + 1;
    });
    params.append('csrf_token', window.CSRF_TOKEN);

    fetch('api/reordenar_etapas.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: params,
    })
      .then(function (r) { return r.json(); })
      .then(function (resp) {
        if (!resp.ok) {
          alert('Não foi possível salvar a nova ordem: ' + (resp.erro || 'erro desconhecido'));
        }
      })
      .catch(function () {
        alert('Erro de conexão ao salvar a nova ordem.');
      });
  }

  tbody.querySelectorAll('tr[draggable="true"]').forEach(function (linha) {
    linha.addEventListener('dragstart', function () {
      linhaArrastada = linha;
      linha.classList.add('dragging-row');
    });
    linha.addEventListener('dragend', function () {
      linha.classList.remove('dragging-row');
      linhaArrastada = null;
      salvarOrdem();
    });
    linha.addEventListener('dragover', function (e) {
      e.preventDefault();
      if (!linhaArrastada || linhaArrastada === linha) return;
      const rect = linha.getBoundingClientRect();
      const depoisDoMeio = (e.clientY - rect.top) > rect.height / 2;
      tbody.insertBefore(linhaArrastada, depoisDoMeio ? linha.nextSibling : linha);
    });
  });
});
