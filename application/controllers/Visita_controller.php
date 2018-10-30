<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visita_controller extends CI_Controller{

	public function __construct(){
        parent::__construct();
    }

    public function index(){
    	$inputPost = $this->input->post();
        $data['pessoas'] = $this->pessoa->getAll();
        $data['setores'] = $this->setor->getAll();
        $data['visitas'] = $this->visita->getAll();
        foreach($data['visitas'] as $visita){
            $visita->data = switchDate($visita->data);
        }
    	if(!$inputPost){
            $data['title'] = 'Visitas';
            $data['old_data'] = $this->session->flashdata('old_data');
            $data['errors'] = $this->session->flashdata('errors');
    		loadTemplate('includes/header', 'visita/index', 'includes/footer', $data);
    	}else{
            $data['old_data'] = $this->session->flashdata('old_data');
            $data['errors'] = $this->session->flashdata('errors');
        }
    }

}