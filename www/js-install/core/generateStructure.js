/**
 *
 * @param {Object} structure
 * @return {HTMLElement}
 */
export default function generateStructure(structure) {
  // TODO: A améliorer
  if (typeof structure.type === "function")
    return generateStructure(structure.type(structure.attributes));
  //

  const element = document.createElement(structure.type);

  if (structure.children) {
    for (const child of structure.children) {
      let subChild;
      if (typeof child === "string") {
        subChild = document.createTextNode(child);
      } else {
        subChild = generateStructure(child);
      }
      element.appendChild(subChild);
    }
  }

  if (structure.events) {
    for (const event in structure.events) {
      element.addEventListener(event, structure.events[event]);
    }
  }

  if (structure.attributes) {
    for (const attribute in structure.attributes) {
      if (attribute.startsWith("data-")) {
        element.dataset[attribute.substring(5)] =
          structure.attributes[attribute];
      } else if (attribute === "style") {
        Object.assign(element.style, structure.attributes[attribute]);
      } else {
        element.setAttribute(attribute, structure.attributes[attribute]);
      }
    }
  }

  structure.node = element;
  return element;
}
