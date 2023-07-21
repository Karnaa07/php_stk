import InputGroup from "./InputGroup.js";

export let firstname = () =>
  InputGroup(
    "firstname",
    "Prénom",
    "text",
    "firstname",
    "firstname",
    "Entrez votre prénom",
    "Entrez votre prénom"
  );
export let lastname = () =>
  InputGroup(
    "lastname",
    "Nom",
    "text",
    "lastname",
    "lastname",
    "Entrez votre nom",
    "Entrez votre nom"
  );
export let email = () =>
  InputGroup(
    "email",
    "E-mail",
    "email",
    "email",
    "email",
    "Entrez votre adresse mail",
    "Entrez votre adresse mail d'aministrateur"
  );

export let pwd = () =>
  InputGroup(
    "pwd",
    "Mot de passe",
    "pwd",
    "pwd",
    "pwd",
    "Entrez votre mot de passe",
    "Entrez votre mot de passe"
  );

export let pwdConfirm = () =>
  InputGroup(
    "pwdConfirm",
    "Confirmation du mot de passe",
    "pwd",
    "pwdConfirm",
    "pwdConfirm",
    "Confirmez votre mot de passe",
    "Confirmez votre mot de passe"
  );