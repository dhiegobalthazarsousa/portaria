<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visita_controller extends CI_Controller{

	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $visitas = $this->visita->getAll();
        echo json_encode($visitas);
    }

    public function inserir(){
        $this->load->library('controllers/Pessoa_controller');
        $inputPost = $this->input->post();
        if($inputPost){
            $nome = $this->input->post("nome");
            $rg = $this->input->post("rg");
            $setor = $this->input->post("setor");

            $arrayPessoa = array(
                "nome"=>$nome,
                "rg"=>$rg
            );

            $pessoa_inserida = $this->pessoa->inserir($arrayPessoa);

            $arrayVisita = array(
                "data" => getDateNow(),
                "id_pessoa" => $pessoa_inserida->id_pessoa,
                "id_setor" => $setor,
                "hora_entrada" => date("H:i:s"),
                "hora_saida" => null
            );

            $this->visita->persist($arrayVisita);

        }
    }

}