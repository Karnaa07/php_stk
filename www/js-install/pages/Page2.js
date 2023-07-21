import {
  bddPrefix,
  adminEmail,
} from "../components/Inputs.js";
import { root } from "../index.js";
import generateStructure from "../core/generateStructure.js";
import form_check from "../utils/verification.js";

const validationSchema2 = {
  type: "object",
  properties: {
    bddPrefix: { type: "string", min: 2, max: 20 },
    adminEmail: { type: "string", min: 6, format: "email" },
  },
  required: ["bddPrefix", "adminEmail"],
};

export default function Page2() {
  window.addEventListener("load", () => {
    const currentPage = sessionStorage.getItem("currentPage");

    if (currentPage === "page2") {
      // Afficher la Page2
      console.log(currentPage);
      root.appendChild(generateStructure(Page2()));
    } else {
      // Afficher la Page1 (ou toute autre page par défaut)
      root.appendChild(generateStructure(Page1()));
    }
  });

  function isValid(event) {
    event.preventDefault();
    try {
      const formData = new FormData(event.currentTarget);
      const data = {};
      formData.forEach((value, key) => (data[key] = value));

      const validationResult = form_check(data, validationSchema2);

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
        window.location.href = "/login";
      }
    } catch (error) {
      console.error(error);
    }
  }

  return {
    type: "div",
    attributes: { id: "page2", class: "container" },

    children: [
      {
        type: "h1",
        children: ["Création BDD"],
        attributes: {
          class: "text-center p-3 text-primary",
        },
      },
      {
        type: "form",
        attributes: {
          method: "post",
          style: { display: "flex", flexDirection: "column" },
          class: "container",
        },
        events: {
          submit: isValid,
        },
        children: [
          bddPrefix(),
          adminEmail(),
          {
            type: "button",
            attributes: { type: "submit", class: "btn btn-primary text-white" },
            children: ["Suivant"],
          },
        ],
      },
    ],
  };
}
