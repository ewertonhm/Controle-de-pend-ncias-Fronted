function prePopulateForm(id){
    // unhide because this function is called in the on click instead
    
    for(var i in pendencias){
        if(pendencias[i].id == id){

            let tipo = document.getElementById("editTipo");
            tipo.value = pendencias[i].tipo;

            let titulo = document.getElementById("editTitulo");
            let tituloText = pendencias[i].titulo;
            //tituloText = tituloText.replace("&lt;","<")
            //tituloText = tituloText.replace("&gt;",">")

            titulo.value = tituloText;

            let descricao = document.getElementById("editDescricao");
            descricao.value = pendencias[i].descricao;

            let inicio = document.getElementById("editInicio");
            inicio.value = convertDateTime(pendencias[i].inicio);

            let responsavel = document.getElementById("editResponsavel");
            responsavel.value = pendencias[i].responsavel;

            let previsao = document.getElementById("editPrevisao");
            previsao.value = convertDateTime(pendencias[i].previsao);

            let task = document.getElementById("editTask");
            task.value = pendencias[i].task;

            let incidente = document.getElementById("editIncidente");
            incidente.value = pendencias[i].incidente;

            break;
        }
    }
    unHide('editPendencia');
}