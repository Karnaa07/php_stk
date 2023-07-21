export default function form_check(variable, conf) {
  if ("type" in conf && typeof variable !== conf.type) {
    if (typeof variable !== "object") {
      if (typeof variable.value !== conf.type) {
        return {
          isValid: false,
          message: `Le type attendu est "${conf.type}"`,
        };
      }
    }
  }

  if ("required" in conf && Array.isArray(conf.required)) {
    for (const field of conf.required) {
      if (!(field in variable) || variable[field] === "") {
        return {
          isValid: false,
          message: `Le champ "${field}" est requis`,
        };
      }
    }
  }

  if ("properties" in conf) {
    for (const prop in conf.properties) {
      const validationResult = form_check(
        { field: prop, value: variable[prop] },
        conf.properties[prop]
      );
      if (!validationResult.isValid) {
        return validationResult;
      }
    }
  }

  if ("value" in conf && variable.value !== conf.value) {
    if (typeof variable === "object") {
      if (JSON.stringify(variable) === JSON.stringify(conf.value)) {
        return { isValid: true };
      } else {
        return {
          isValid: false,
          message: `La valeur attendue est "${conf.value}"`,
        };
      }
    }
    return {
      isValid: false,
      message: `La valeur attendue est "${conf.value}"`,
    };
  }

  if ("enum" in conf && !conf.enum.includes(variable)) {
    if (typeof variable === "object") {
      const matchingValues = conf.enum.filter(
        (value) => JSON.stringify(value) === JSON.stringify(variable)
      );
      if (matchingValues.length > 0) {
        return { isValid: true };
      } else {
        return {
          isValid: false,
          message: `La valeur doit être l'une des suivantes : ${conf.enum.join(
            ", "
          )}`,
        };
      }
    }
    return {
      isValid: false,
      message: `La valeur doit être l'une des suivantes : ${conf.enum.join(
        ", "
      )}`,
    };
  }

  if ("min" in conf && variable.value.length < conf.min)
    return {
      isValid: false,
      message: `Le champ ${variable.field} doit être supérieure ou égale à ${conf.min}`,
    };

  if ("max" in conf && variable.value.length > conf.max)
    return {
      isValid: false,
      message: `Le champ ${variable.field} doit être inférieure ou égale à ${conf.max}`,
    };

  if ("format" in conf && conf.format === "email") {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(variable.value)) {
      return { isValid: false, message: "L'email n'est pas au format valide" };
    }
  }

  if ("format" in conf && conf.format === "pwd") {
    const passwordRegex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/;
    if (!passwordRegex.test(variable.value)) {
      return {
        isValid: false,
        message:
          "Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre, et être d'au moins 8 caractères",
      };
    }
  }

  return { isValid: true };
}
