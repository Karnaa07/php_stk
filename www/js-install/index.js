
import generateStructure from "./core/generateStructure.js";
import Page1 from "./pages/Page1.js";


export const root = document.getElementById("root");

root.appendChild(generateStructure(Page1()));
