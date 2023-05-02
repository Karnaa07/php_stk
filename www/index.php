<?php
//Afficher le controller et l'action correspondant à l'URI

$uri = $_SERVER["REQUEST_URI"];
$uriExploded = explode("?", $uri);
$uri = strtolower(trim( $uriExploded[0], "/"));

if(empty($uri)){
    $uri = "default";
}

if(!file_exists("routes.yml")){
    die("Le fichier routes.yml n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

if(empty($routes[$uri])){
    die("Page 404");
}

if(empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"]) ){
    die("Cette route ne possède pas de controller ou d'action dans le fichier de routing");
}

$controller = $routes[$uri]["controller"];
$action = $routes[$uri]["action"];
