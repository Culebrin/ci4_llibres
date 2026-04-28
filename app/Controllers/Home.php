<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $model = model('LlibresModel');
        $llibres = $model->findAll();
        return view('llibres/home', ['llibres' => $llibres]);
    }

    public function filter_by_year(string $year): string
    {
        $model = model('LlibresModel');
        $llibres = $model->where("data_inici" , $year)->findAll();
        return view('llibres/home', ['llibres' => $llibres]);
    }
}
