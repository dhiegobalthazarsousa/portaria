<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Model{

	private $id_pessoa;
	private $nome;
	private $rg;

	/*
	 * Getters & Setters
	 * @author: Dhiego Balthazar
	 *
	 */
	public function __construct(){
        parent::__construct();
    }

    public function getId(){
    	return $this->id_pessoa;
    }

    public function setId($id){
    	$this->id_pessoa = $id;
    }

    public function getNome(){
    	return $this->nome;
    }

    public function setNome($nome){
    	$this->nome = $nome;
    }

    public function getRG(){
    	return $this->rg;
    }

    public function setRG($rg){
    	$this->rg = $rg;
    }

    /*
     * @author: Dhiego Balthazar
     * @returns: mixed Pessoa
     * Método que retorna uma lista de objetos do tipo Pessoa.
     * SQL STATEMENT: SELECT * FROM PESSOA;
     * 
     */
    public fucntion get(){
    	$querry = $this->db->get('pessoa');
    	return $querry->result();
    }

    /*
     * @author: Dhiego Balthazar
     * @returns: mixed Pessoa
     * @params: $object Pessoa
     * Método que retorna um objeto do tipo Pessoa comparado pelo RG
     * SQL STATEMENT: SELECT * FROM PESSOA WHERE RG = RG@params;
     * 
     */
    public function getByRg($object){
    	$this->db->select('*');
    	$this->db->where('rg', $object->rg);
    	return $this->db->get('pessoa')->row();
    }

    /*
     * @author: Dhiego Balthazar
     * @returns: mixed
     * @params: $object Pessoa
     * Insere um objeto do tipo Pessoa na tabela Pessoa
     * SQL STATEMENT: SELECT * FROM PESSOA WHERE RG = RG@params;
     * 
     */
    public function persist($object){
    	$this->db->set('nome', $object->nome);
    	$this->db->set('rg', $object->rg);
    }
}