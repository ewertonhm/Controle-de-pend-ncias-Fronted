var pendenciaData = {
    id: "{{ pendencia.id }}",
    tipo: "{{ pendencia.tipoPendencia.id }}",
    tipoNome: "{{ pendencia.tipoPendencia.tipo }}",
    titulo: "{{ pendencia.titulo }}",
    descricao: "{{ pendencia.descricao }}",
    inicio: "{{ pendencia.inicio }}",
    previsao: "{{ pendencia.previsao }}",
    conclusao: "{{ pendencia.fim }}",
    responsavel: "{{ pendencia.responsavel }}",
    task: "{{ pendencia.task }}",
    incidente: "{{ pendencia.incidente }}",
    user_abertura: "{{ pendencia.userAbertura.nome }} {{ pendencia.userAbertura.sobrenome }}",
    email_abertura: "{{ pendencia.userAbertura.email }}",
    hora_abertura: "{{ pendencia.hora_abertura }}",
    user_fechamento: "{{ pendencia.userFechamento.nome }} {{ pendencia.userFechamento.sobrenome }}",
    email_fechamento: "{{ pendencia.userFechamento.email }}",
    hora_fechamento: "{{ pendencia.hora_fechamento }}",
    incidente: "{{ pendencia.incidente }}",
    task: "{{ pendencia.task }}",
    andamentos: []
};

{% for andamento in pendencia.andamentos %}
    var andamentoData = {
        andamento: "{{ andamento.andamento }}",
        user: "{{ andamento.user.email }}",
        data: "{{ andamento.hora }}"
    };
    pendenciaData.andamentos.push(andamentoData);
    andamentoData = {};
{% endfor %}

pendencias.push(pendenciaData);
pendenciaData = {};