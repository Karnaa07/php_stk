import InputGroup from "./InputGroup.js";

// FirstPage of Installer, create an user

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

// SecondPage of Installer, control the database

export let bddPrefix = () =>
  InputGroup(
    "bddPrefix",
    "Préfixe pour la base de données",
    "text",
    "bddPrefix",
    "bddPrefix",
    "",
    "Entrez le préfixe de votre base de données."
  );

export let adminEmail = () =>
  InputGroup(
    "adminEmail",
    "E-mail de l'administrateur",
    "email",
    "adminEmail",
    "adminEmail",
    "",
    "Entrez l'adresse mail de l'administrateur."
  );
