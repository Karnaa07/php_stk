import generateStructure from "../core/generateStructure.js";

export default function HashRouter(routes, root) {
  const generate = function () {
    const pathname = window.location.hash.slice(1);
    const structure = routes[pathname];
    const element = generateStructure(structure);
    if (root.childNodes[0]) {
      root.replaceChild(element, root.childNodes[0]);
    } else root.appendChild(element);
  };
  generate();
  window.addEventListener("hashchange", generate);
}
export function HashLink(title, path) {
  return {
    type: "a",
    attributes: {
      href: "#" + path,
    },
    children: [title],
  };
}
