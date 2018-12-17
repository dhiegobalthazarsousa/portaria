<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visita_controller extends CI_Controller{

	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $response = array();
        $visitas = $this->visita->getAll();
        foreach ($visitas as $visita) {
            $pessoa = $this->pessoa->findById($visita->id_pessoa);
            $setor = $this->setor->findById($visita->id_setor);
            array_push($response, array(
                    "data" => $visita->data,
                    "nome" => $pessoa->nome,
                    "rg" => $pessoa->rg,
                    "setor" => $setor->nome,
                    "hora_entrada" => $visita->hora_entrada,
                    "hora_saida" => $visita->hora_saida
                )
            );
        }

        echo json_encode($response);
    }

    public function inserir(){

        $post = $this->input->post();
        $nome = $post['nome'];
        $rg = $post['rg'];
        $id_setor = $post['id_setor'];

        $this->pessoa->persist(array("nome"=>$nome, "rg"=>$rg));
        $pessoa_inserida = $this->pessoa->findByRG($rg);

        $arrayVisita = array(
            "data" => getDateNow(),
            "id_pessoa" => $pessoa_inserida->id_pessoa,
            "id_setor" => $id_setor,
            "hora_entrada" => date("H:i:s"),
            "hora_saida" => null
        );
        $this->visita->persist($arrayVisita);
        $setor = $this->setor->findById($id_setor);
        $response = array(
            "data" => $arrayVisita["data"],
            "nome" => $arrayPessoa["nome"],
            "rg" => $arrayPessoa["rg"],
            "setor" => $setor->nome,
            "hora_entrada" => $arrayVisita["hora_entrada"],
            "hora_saida" => $arrayVisita["hora_saida"]
        );
        echo json_encode($response);
        
    }

}