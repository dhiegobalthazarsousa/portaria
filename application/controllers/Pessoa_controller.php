<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa_controller extends CI_Controller{

	public function __construct(){
        parent::__construct();
    }

    public function salvar(){
    	$inputPost = $this->input->post();
    	if(!$inputPost){
    		$data['title'] = 'Inserir Pessoa';
    		$data['errors'] = $this->session->flashdata('errors');
    		$data['old_data'] = $this->session->flashdata('old_data');
    		loadTemplate('includes/header', 'pessoa/index', 'includes/footer', $data);
    	}
    }

}