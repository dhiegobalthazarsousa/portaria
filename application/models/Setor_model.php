<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	private $id_setor;
	private $nome;
	private $responsavel;

	//*********************Getters and Setters***************************************


    /**
     * @return mixed
     */
    public function getIdSetor()
    {
        return $this->id_setor;
    }

    /**
     * @param mixed $id_setor
     *
     * @return self
     */
    public function setIdSetor($id_setor)
    {
        $this->id_setor = $id_setor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * @param mixed $responsavel
     *
     * @return self
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;

        return $this;
    }

    //****************************Data Access*****************************

    /**
     *
     *@author: Dhiego Balthazar
     *@return: mixed
     * Método que retorna uma lista de objetos do tipo Setor
     *
     */
    public function getAll(){
    	$query = $this->db->get('setor');
    	return $query->result();
    }

     public function findById($id){
        $this->db->select('*');
        $this->db->where('id_setor', $id);
        return $this->db->get('setor')->row();
    }
}