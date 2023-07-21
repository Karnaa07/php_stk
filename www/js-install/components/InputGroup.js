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
        },
      },
      {
        type: "div",
        children: [helperText],
      },
    ],
  };
}
