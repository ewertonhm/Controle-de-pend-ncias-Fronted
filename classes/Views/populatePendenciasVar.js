var pendenciaData = {
    id: "{{ pendencia.id }}",
    tipo: "{{ pendencia.tipoPendencia.id }}",
    titulo: "{{ pendencia.titulo }}",
    descricao: "{{ pendencia.descricao }}",
    inicio: "{{ pendencia.inicio }}",
    previsao: "{{ pendencia.previsao }}",
    responsavel: "{{ pendencia.responsavel }}",
    task: "{{ pendencia.task }}",
    incidente: "{{ pendencia.incidente }}"
};

pendencias.push(pendenciaData);
pendenciaData = {};