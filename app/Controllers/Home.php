<?php

namespace App\Controllers;

use App\Models\LlibresModel;


class Home extends BaseController
{
    public function index(): string
    {
        $model = new LlibresModel();

        $data = [
            // 'llibres' => $model->findAll(),
            'llibres' => $model->paginate(8),
            'pager'   => $model->pager,
        ];

        return view('llibres/home', $data);
    }

    public function filter_by_year(string $year): string
    {
        $model = model('LlibresModel');
        $llibres = $model->where("data_inici", $year)->findAll();
        return view('llibres/home', ['llibres' => $llibres]);
    }
}
