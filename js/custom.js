const el = document.getElementById('hoverable');
const hiddenDiv = document.getElementById('show');


el.addEventListener('mouseover', function handleMouseOver() {
  hiddenDiv.style.display = 'block';

});

el.addEventListener('mouseout', function handleMouseOut() {
  hiddenDiv.style.display = 'none';

});
