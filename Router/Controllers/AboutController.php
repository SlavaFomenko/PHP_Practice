<?php

namespace Controllers;

#[Route("/about")]
class AboutController
{

    #[Route("/main")]
    public function main()
    {
        echo 'about_main';
    }

    #[Route("/etc")]
    public function etc()
    {
        echo 'about_etc';
    }

    #[Route("/about")]
    public function index()
    {
        echo 'about_index';
    }

}
