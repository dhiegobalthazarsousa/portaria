<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa_controller extends CI_Controller{
	public function __construct(){
        parent::__construct();
    }

    public function searchRG($rg){
    	$data = $this->pessoa->findByRG($rg);
    	echo json_encode($data);
    }
}