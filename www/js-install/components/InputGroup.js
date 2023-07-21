export default function InputGroup(
  labelFor,
  labelText,
  inputType,
  inputId,
  inputName,
  placeholder,
  helperText
) {
  return {
    type: "div",
    children: [
      {
        type: "label",
        attributes: {
          for: labelFor,
          class: "form-label p-1",
        },
        children: [labelText],
      },
      {
        type: "input",
        attributes: {
          type: inputType,
          id: inputId,
          name: inputName,
          placeholder: placeholder,
          class: "form-control",
        },
      },
      {
        type: "div",
        attributes: { class: "form-text mb-4 text-primary" },
        children: [helperText],
      },
    ],
  };
}
