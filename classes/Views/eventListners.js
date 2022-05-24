let el{{ pendencia.id|replace({"-": ""}) }} = document.getElementById('{{ pendencia.id }}');
let hiddenDiv{{ pendencia.id|replace({"-": ""}) }}  = document.getElementById('{{ pendencia.id }}_hidden');



el{{ pendencia.id|replace({"-": ""}) }}.addEventListener('mouseover', function handleMouseOver() {
hiddenDiv{{ pendencia.id|replace({"-": ""}) }}.style.display = 'block';

});

el{{ pendencia.id|replace({"-": ""}) }}.addEventListener('mouseout', function handleMouseOut() {
hiddenDiv{{ pendencia.id|replace({"-": ""}) }}.style.display = 'none';

});