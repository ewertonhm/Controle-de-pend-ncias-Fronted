function populateDetailsPendencia(id){
    for(var i in pendencias){
        if(pendencias[i].id == id){
            // pendencia
            let titulo = document.getElementById("detailPendenciaLabel");
            titulo.innerHTML = "Título: " + pendencias[i].titulo;

            let detalhes = document.getElementById("detailPendenciaDetalhes");
            detalhes.innerHTML = "Descrição: " + pendencias[i].descricao;

            let tipo = document.getElementById("detailPendenciaTipo");
            tipo.innerHTML = "Tipo: " + pendencias[i].tipoNome;

            let responsavel = document.getElementById("detailPendenciaResponsavel");
            responsavel.innerHTML = "Responsável: " + pendencias[i].responsavel;

            // data/hora
            let inicio = document.getElementById("pendenciaDetailInicio");
            inicio.innerHTML = "Inicio: " + pendencias[i].inicio;

            let previsao = document.getElementById("pendenciaDetailPrevisao");
            previsao.innerHTML = "Previsão: " + pendencias[i].previsao;

            let conclusao = document.getElementById("pendenciaDetailConclusao");
            conclusao.innerHTML = "Conclusão: " + pendencias[i].conclusao;

            // abertura
            let nomeAbertura = document.getElementById("detailPendenciaNomeAbertura");
            nomeAbertura.innerHTML = "Nome: " + pendencias[i].user_abertura;

            let emailAbertura = document.getElementById("detailPendenciaEmailAbertura");
            emailAbertura.innerHTML = "Email: " + pendencias[i].email_abertura;
            
            let horaAbertura = document.getElementById("detailPendenciaHoraAbertura");
            horaAbertura.innerHTML = "Hora abertura: " + pendencias[i].hora_abertura;

            // fechamento
            let nomeFechamento = document.getElementById("detailPendenciaNomeFechamento");
            nomeFechamento.innerHTML = "Nome: " + pendencias[i].user_fechamento;

            let emailFechamento = document.getElementById("detailPendenciaEmailFechamento");
            emailFechamento.innerHTML = "Email: " + pendencias[i].email_fechamento;
            
            let horaFechamento = document.getElementById("detailPendenciaHoraFechamento");
            horaFechamento.innerHTML = "Hora fechamento: " + pendencias[i].hora_fechamento;
            
            // incidente/task
            let incidente = document.getElementById("detailPendenciaIncidente");
            incidente.href = pendencias[i].incidente;
            
            let incidenteText = document.getElementById("detailPendenciaIncidenteText");
            incidenteText.innerHTML = "Incidente: " + pendencias[i].incidente;

            let task = document.getElementById("detailPendenciaTask");
            task.href = pendencias[i].task;

            let taskText = document.getElementById("detailPendenciaTaskText");
            taskText.innerHTML = "Task: " + pendencias[i].task;

            // andamentos
            let table = document.getElementById("andamentosTable");
            for (x in pendencias[i].andamentos){
                let row = document.createElement("tr");
                
                let tdhora = document.createElement("td");
                let tdhoratext = document.createTextNode(pendencias[i].andamentos[x].data);
                tdhora.appendChild(tdhoratext);

                let tdusuario = document.createElement("td");
                let tdusuariotext = document.createTextNode(pendencias[i].andamentos[x].user);
                tdusuario.appendChild(tdusuariotext);

                let tdandamento = document.createElement("td");
                let tdandamentotext = document.createTextNode(pendencias[i].andamentos[x].andamento);
                tdandamento.appendChild(tdandamentotext);

                row.appendChild(tdhora);
                row.appendChild(tdusuario);
                row.appendChild(tdandamento);

                table.appendChild(row);
                
            }
            break;
        }
    }
    // unhide because this function is called in the on click instead
    unHide('pendenciaDetail');
}