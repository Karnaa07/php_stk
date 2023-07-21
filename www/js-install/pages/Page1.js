import form_check from "../utils/verification.js";
import {
  firstname,
  lastname,
  email,
  pwd,
  pwdConfirm,
} from "../components/Inputs.js";
import { root } from "../index.js";
import generateStructure from "../core/generateStructure.js";

const validationSchema = {
  type: "object",
  properties: {
    firstname: { type: "string", min: 2, max: 20 },
    lastname: { type: "string", min: 2, max: 20 },
    email: { type: "string", min: 6, format: "email" },
    pwd: { type: "string", min: 8, format: "pwd" },
    pwdConfirm: { type: "string", min: 8, format: "pwdConfirm" },
  },
  required: [
    "firstname",
    "lastname",
    "email",
    "pwd",
    "pwdConfirm",
  ],
};

export default function Page1() {
  function isValid(event) {
    event.preventDefault();
    try {
      const formData = new FormData(event.currentTarget);
      const data = {};
      formData.forEach((value, key) => (data[key] = value));

      const validationResult = form_check(data, validationSchema);

      let errorElement = document.getElementById("errorElement");
      if (!validationResult.isValid) {
        if (!errorElement) {
          errorElement = document.createElement("div");
          errorElement.id = "errorElement";
          errorElement.classList.add("alert", "alert-danger");
          errorElement.textContent = validationResult.message;
          root.appendChild(errorElement);
          errorElement.setAttribute("tabindex", "0");
          errorElement.focus();
        }
        errorElement.textContent = validationResult.message;
      } else {
        if (errorElement) {
          errorElement.remove();
        }

        fetch("/installer", {
          method: "POST",
          body: JSON.stringify(data),
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => {
            if (response.ok) {
              return response.json();
            } else {
              throw new Error("Erreur lors de l'envoi du formulaire.");
            }
          })
          .then((responseData) => {
            console.log(responseData);

            if (responseData.success === false) {
              if (!errorElement) {
                errorElement = document.createElement("div");
                errorElement.id = "errorElement";
                errorElement.classList.add("alert");
                errorElement.textContent = responseData.message;
                root.appendChild(errorElement);
                errorElement.setAttribute("tabindex", "0");
                errorElement.focus();
              }
              errorElement.textContent = responseData.message;
              throw new Error(responseData.message);
            }
            // Remplacer la structure de la page par Page2()
            if (errorElement) {
              errorElement.remove();
            }
          });
      }
    } catch (error) {
      console.log(error);
    }
  }

  return {
    type: "div",
    attributes: {
      id: "page1",
      class: "container bg-light  ",
    },
    children: [
      {
        type: "h1",
        children: ["Waveflow!"],
      },
      {
        type: "p",
        children: ["Installation de notre CMS"],
      },
      {
        type: "form",
        attributes: {
          method: "post",
        },
        events: {
          submit: isValid,
        },
        children: [
          firstname(),
          lastname(),
          email(),
          pwd(),
          pwdConfirm(),
          {
            type: "button",
            attributes: { type: "submit" },
            children: ["Suivant"],
          },
        ],
      },
    ],
  };
}
