<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page_controller extends CI_Controller{
	public function __construct(){
        parent::__construct();
    }

   public function index(){
        loadTemplate('includes/header', 'visita/index', 'includes/footer');
   }
}