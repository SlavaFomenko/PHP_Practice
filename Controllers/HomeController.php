<?php

namespace Controllers;


#[Route("/")]
class HomeController
{

    #[Route("/main")]
    public function main()
    {
        echo 'home_main';
    }

    #[Route("/etc")]
    public function etc()
    {
        echo 'home_etc';
    }

    #[Route("/index")]
    public function index()
    {
        echo 'home_index';
    }

}
