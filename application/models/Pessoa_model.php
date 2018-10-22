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
     * O método getByRg() tem como objetivo retornar um objeto do tipo Pessoa comparado pelo RG na tabela pessoa
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
     * @returns: bool
     * @params: $object Pessoa
     * O médodo persist() tem como objetivo inserir um objeto do tipo Pessoa na tabela pessoa;
     * SQL STATEMENT: INSERT INTO pessoa VALUES(nome, rg);
     * 
     */
    public function persist(){
    	return $this->db->insert('pessoa', $this);
    }
}