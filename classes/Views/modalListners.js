// create listners for the modals
const addAndamentoModal{{ pendencia.id|replace({"-": ""}) }} = document.getElementById('addAndamento');
addAndamentoModal{{ pendencia.id|replace({"-": ""}) }}.addEventListener('show.bs.modal', event => {
const addAndamentoButton{{ pendencia.id|replace({"-": ""}) }} = event.relatedTarget;
const addAndamentoId{{ pendencia.id|replace({"-": ""}) }} = addAndamentoButton{{ pendencia.id|replace({"-": ""}) }}.getAttribute('data-bs-pendencia-id');
const addAndamentoModalBodyInput{{ pendencia.id|replace({"-": ""}) }} = addAndamentoModal{{ pendencia.id|replace({"-": ""}) }}.querySelector('#idPendenciaOnAddPendencia');


addAndamentoModalBodyInput{{ pendencia.id|replace({"-": ""}) }}.value = addAndamentoId{{ pendencia.id|replace({"-": ""}) }};
})
const editPendenciaModal{{ pendencia.id|replace({"-": ""}) }} = document.getElementById('editPendencia');
editPendenciaModal{{ pendencia.id|replace({"-": ""}) }}.addEventListener('show.bs.modal', event => {
const editPendneciaButton{{ pendencia.id|replace({"-": ""}) }} = event.relatedTarget;
const editPendenciaId{{ pendencia.id|replace({"-": ""}) }} = editPendneciaButton{{ pendencia.id|replace({"-": ""}) }}.getAttribute('data-bs-pendencia-id');
const editPendenciaModalBodyInput{{ pendencia.id|replace({"-": ""}) }} = editPendenciaModal{{ pendencia.id|replace({"-": ""}) }}.querySelector('#idPendenciaOnEditPendencia');
editPendenciaModalBodyInput{{ pendencia.id|replace({"-": ""}) }}.value = editPendenciaId{{ pendencia.id|replace({"-": ""}) }};
})

const fecharPendenciaModal{{ pendencia.id|replace({"-": ""}) }} = document.getElementById('fecharPendencia');
fecharPendenciaModal{{ pendencia.id|replace({"-": ""}) }}.addEventListener('show.bs.modal', event => {
const fecharPendenciaButton{{ pendencia.id|replace({"-": ""}) }} = event.relatedTarget;
const fecharPendenciaId{{ pendencia.id|replace({"-": ""}) }} = fecharPendenciaButton{{ pendencia.id|replace({"-": ""}) }}.getAttribute('data-bs-pendencia-id');
const fecharPendenciaModalBodyInput{{ pendencia.id|replace({"-": ""}) }} = fecharPendenciaModal{{ pendencia.id|replace({"-": ""}) }}.querySelector('#idPendenciaOnFecharPendencia');
fecharPendenciaModalBodyInput{{ pendencia.id|replace({"-": ""}) }}.value = fecharPendenciaId{{ pendencia.id|replace({"-": ""}) }};
})

const pendenciaDetailModal{{ pendencia.id|replace({"-": ""}) }} = document.getElementById('pendenciaDetail');
pendenciaDetailModal{{ pendencia.id|replace({"-": ""}) }}.addEventListener('show.bs.modal', event => {
const pendenciaDetailButton{{ pendencia.id|replace({"-": ""}) }} = event.relatedTarget;
const pendenciaDetailId{{ pendencia.id|replace({"-": ""}) }} = pendenciaDetailButton{{ pendencia.id|replace({"-": ""}) }}.getAttribute('data-bs-pendencia-id');
const pendenciaDetailModalBodyInput{{ pendencia.id|replace({"-": ""}) }} = pendenciaDetailModal{{ pendencia.id|replace({"-": ""}) }}.querySelector('#idPendenciaOnPendenciaDetail');
pendenciaDetailModalBodyInput{{ pendencia.id|replace({"-": ""}) }}.value = pendenciaDetailId{{ pendencia.id|replace({"-": ""}) }};
})