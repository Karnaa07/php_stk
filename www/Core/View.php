<?php
namespace App\Core;

class View {

    private String $view;
    private String $template;
    private $data = [];
    private string $pageTitle = '';
    private string $h1Title = '';

    public function __construct(String $view, String $template = "back") {
        $this->setView($view);
        $this->setTemplate($template);

    }

    public function render(): void
    {
        extract($this->data);

        ob_start();
        include $this->view;
        $content = ob_get_clean();

        include $this->template;
    }
    
    public function setH1Title(string $title): void
    {
        $this->h1Title = $title;
    }

    public function setPageTitle(string $title): void
    {
        $this->pageTitle = $title;
    }


    public function assign(String $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @param String $view
     */
    public function setView(string $view): void
    {
        $this->view = "Views/".$view.".view.php";
        if(!file_exists($this->view)){
            die("La vue ".$this->view." n'existe pas");
        }
    }

    /**
     * @param String $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = "Views/".$template.".tpl.php";
        if(!file_exists($this->template)){
            die("Le template ".$this->template." n'existe pas");
        }
    }

    public function partial(String $name, array $config, $errors = []): void
    {
        if(!file_exists("Views/Partials/".$name.".ptl.php")){
            die("Le partial ".$name." n'existe pas");
        }
        include "Views/Partials/".$name.".ptl.php";
    }

    public function __destruct(){
        extract($this->data);
        include $this->template;
       
    }


    
}