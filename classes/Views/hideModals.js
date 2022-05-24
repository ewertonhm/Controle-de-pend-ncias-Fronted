function hideModals(){
    var addAndamento = document.getElementById("addAndamento");
    var editPendencia = document.getElementById("editPendencia");
    var addPendencia = document.getElementById("addPendencia");
    var fecharPendencia = document.getElementById("fecharPendencia");
    var detalhesPendencia = document.getElementById("pendenciaDetail");

    console.log(detalhesPendencia);
    
    addAndamento.hidden = true;
    editPendencia.hidden = true;
    addPendencia.hidden = true;
    fecharPendencia.hidden = true;
    detalhesPendencia.hidden = true;

}

document.onload= hideModals();
