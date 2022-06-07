const textarea = document.getElementById("adicionarAndamentoTextArea");
const charCounter = document.getElementById("characterCounterAdicionarAndamentosTextArea")

textarea.addEventListener("input", ({ currentTarget: target }) => {
  const currentLength = target.value.length;
  charCounter.innerText = (`${currentLength}/256`);
});