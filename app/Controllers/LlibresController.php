<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GeneresModel;
use App\Models\LlibresModel;
use CodeIgniter\HTTP\ResponseInterface;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class LlibresController extends BaseController
{
    public function index()
    {
        $model = new LlibresModel();

        $data = [
            'llibres' => $model->findAll(),
        ];

        return view('llibres/home', $data);
    }

    public function kpacrud()
    {

        // $model = new GeneresModel();
        // $generes = $model->findAll();

        // $options = [];
        // foreach ($generes as $genere) {
        //     $options[$genere['id']] = $genere['nom'];
        // }

        $crud = new \SIENSIS\KpaCrud\Libraries\KpaCrud();

        $crud->setTable('llibres');
        $crud->setPrimaryKey('id');

        $crud->setColumns(['titol', 'autor' , 'ISBN', 'estat', 'comprat']);
        $crud->orderBy('id', 'ASC');

        $dataActual = date('Y-m-d');

        // $crud->setColumnsInfo([
        //     // 'id' => ['name' => 'codi', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
        //     'titol' => ['name' => 'titol', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
        //     'autor' => ['name' => 'autor', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
        //     'ISBN' => ['name' => 'ISBN', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
        //     'estat' => ['name' => 'estat', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => ['pendent' => "pendent", 'llegit' => "llegit", 'llegint' => "llegint"]],
        //     'prioritat' => ['name' => 'prioritat', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => ['normal' => "normal", 'alta' => "alta", 'baixa' => "baixa"]],
        //     'data_inici' => ['name' => 'data_inici', 'type' => KpaCrud::DATE_FIELD_TYPE, 'html_atts' => ["required"], 'default' => $dataActual],
        //     'data_fi' => ['name' => 'data_fi', 'type' => KpaCrud::DATE_FIELD_TYPE, 'html_atts' => ["required"], 'default' => $dataActual],
        //     'comprat' => ['name' => 'comprat', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => ['no' => "no", 'si' => "si"]],
        //     // 'generes' => ['name' => 'id_genere', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => $options],
        // ]);

        $crud->setColumnsInfo([
            'id' => ['name' => 'codi', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
            'titol' => ['name' => 'titol', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
            'sinopsis' => ['name' => 'sinopsis', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => [],],
            'autor' => ['name' => 'autor', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
            'spicy' => ['name' => 'spicy', 'type' => KpaCrud::NUMBER_FIELD_TYPE, 'html_atts' => ["required", 'max=5'],],
            'ISBN' => ['name' => 'ISBN', 'type' => KpaCrud::TEXTAREA_FIELD_TYPE, 'html_atts' => ["required"],],
            'estat' => ['name' => 'estat', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => [0 => "pendent", 1 => "llegit", 2 => "llegint"]],
            'prioritat' => ['name' => 'prioritat', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => [0 => "normal", 1 => "alta", 2 => "baixa"]],
            'data_inici' => ['name' => 'data_inici', 'type' => KpaCrud::DATE_FIELD_TYPE, 'html_atts' => ["required"], 'default' => $dataActual],
            'data_fi' => ['name' => 'data_fi', 'type' => KpaCrud::DATE_FIELD_TYPE, 'html_atts' => ["required"], 'default' => $dataActual],
            'comprat' => ['name' => 'comprat', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => [0 => "no", 1 => "si"]],
            // 'generes' => ['name' => 'id_genere', 'type' => KpaCrud::DROPDOWN_FIELD_TYPE, 'html_atts' => ["required"], 'options' => $options],
        ]);
        

        $crud->setConfig('delete', true);
        $crud->setConfig('add', true);
        $crud->setConfig('modify', true);

        $data['output'] = $crud->render();
        return view('llibres/kpacrud', $data);
    }

    public function info($titol)
    {
        $model = new LlibresModel();
        $llibre = $model->where('titol', urldecode($titol))->first();

        if (!$llibre) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("No se puede encontrar el libro: " . $titol);
        }

        $data = [
            'llibre' => $llibre,
        ];

        return view('llibres/info', $data);
    }

    public function search(){
        $searchText = $this->request->getGet('search');

        $model = new LlibresModel();
        $results = $model->searchBooks($searchText);

        $data = [
            'llibres' => $results,
            'searchQuery' => $searchText,
        ];

        return view('llibres/home', $data);
    }
}
