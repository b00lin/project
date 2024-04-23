<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('templates/header')
        . view('index')
        . view('templates/footer');
    }
}
