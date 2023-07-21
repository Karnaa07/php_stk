import generateStructure from "../core/generateStructure.js";

export function BrowserLink({ title, path }) {
  return {
    type: "a",
    attributes: {
      href: path,
    },
    events: {
      click: function (event) {
        event.preventDefault();
        window.history.pushState({}, null, path);
      },
    },
    children: [title],
  };
}

export default function BrowserRouter(routes, root) {
  const generate = function () {
    const pathname = window.location.pathname;
    let structure = routes[pathname];
    if (!structure.component) {
      structure = {
        component: structure,
        attributes: {},
      };
    }
    const element = generateStructure({
      type: structure.component,
      attributes: structure.attributes,
    });
    if (root.childNodes[0]) {
      root.replaceChild(element, root.childNodes[0]);
    } else root.appendChild(element);
  };
  const oldPushState = window.history.pushState;
  window.history.pushState = function (state, title, path) {
    oldPushState.call(window.history, state, title, path);
    window.dispatchEvent(new Event("popstate"));
  };
  generate();
  window.addEventListener("popstate", generate);
}
