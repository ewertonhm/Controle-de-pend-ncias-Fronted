function unHide(id){
    timer.pause();
    var element = document.getElementById(id);
    element.hidden = false;
}

function hide(id){
    var element = document.getElementById(id);
    element.hidden = true; 
    if(document.getElementById("andamentosTable")){
        removeElement("andamentosTable");
        createNewTable("andamentosTable");
    }

    timer.reset();
    timer.resume();
}

function removeElement(id) {
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}

function createNewTable(id){
    let table = document.getElementById("andamentoTableMain");
    let tbody = document.createElement("tbody");
    tbody.setAttribute("id", id);
    table.appendChild(tbody);
}