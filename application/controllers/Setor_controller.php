<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_controller extends CI_Controller{

	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $response = array();
        $setores = $this->setor->getAll();
        foreach ($setores as $setor) {
            array_push($response, array(
                    "id_setor" => $setor->id_setor,
                    "nome" => $setor->nome,
                    "responsavel" => $setor->responsavel
                )
            );
        }

        echo json_encode($response);
    }

}