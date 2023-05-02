<?php

namespace App\Controllers;
class Main
{
    public function home(): void
    {
        echo "Page d'accueil";
    }

    public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        echo "Page à propos";
    }

}