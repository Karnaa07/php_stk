export default function Exo({ rows = 5, cols = 5 }) {
  const storage = localStorage; //sessionStorage

  function changeTextIntoInput(event) {
    const td = event.currentTarget;
    const textNode = td.childNodes[0];
    const input = document.createElement("input");
    const text = textNode.textContent;
    input.value = text;
    td.removeChild(textNode);
    td.appendChild(input);
    input.focus();
    input.addEventListener("blur", changeInputIntoText);
    td.removeEventListener("click", changeTextIntoInput);
  }

  function changeInputIntoText(event) {
    const input = event.currentTarget;
    const td = input.parentNode;
    const text = input.value;
    const textNode = document.createTextNode(text);
    td.replaceChild(textNode, input);
    input.removeEventListener("blur", changeInputIntoText);
    data[td.dataset.position] = text;
    storage.setItem("tableData", JSON.stringify(data));
    td.addEventListener("click", changeTextIntoInput);
  }

  const data = JSON.parse(storage.getItem("tableData") || "{}");

  return {
    type: "table",
    children: [
      {
        type: "tbody",
        children: Array.from({ length: rows }, (_, i) => ({
          type: "tr",
          children: Array.from({ length: cols }, (_, j) => {
            return {
              type: "td",
              attributes: {
                "data-position": `${i}-${j}`,
              },
              events: {
                click: changeTextIntoInput,
              },
              children: [data[`${i}-${j}`] ?? "Default"],
            };
          }),
        })),
      },
    ],
  };
}
