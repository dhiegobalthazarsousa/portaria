<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visita_model extends CI_Model{

    private $id_visita;
    private $data;
    private $id_pessoa;
    private $id_setor;
    private $hora_entrada;
    private $hora_saida;

    //getters and setters

    /**
     *
     * @return mixed
     */

    public function getHoraSaida()
    {
        return $this->hora_saida;
    }

    /**
     * @param mixed $hora_saida
     *
     * @return self
     */
    public function setHoraSaida($hora_saida)
    {
        $this->hora_saida = $hora_saida;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdVisita()
    {
        return $this->id_visita;
    }

    /**
     * @param mixed $id_visita
     *
     * @return self
     */
    public function setIdVisita($id_visita)
    {
        $this->id_visita = $id_visita;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPessoa()
    {
        return $this->id_pessoa;
    }

    /**
     * @param mixed $id_pessoa
     *
     * @return self
     */
    public function setIdPessoa($id_pessoa)
    {
        $this->id_pessoa = $id_pessoa;

        return $this;
    }

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
    public function getHoraEntrada()
    {
        return $this->hora_entrada;
    }

    /**
     * @param mixed $hora_entrada
     *
     * @return self
     */
    public function setHoraEntrada($hora_entrada)
    {
        $this->hora_entrada = $hora_entrada;

        return $this;
    }

    /**
     * @author: Dhiego Balthazar
     * @return: mixed Visita
     * @name: getAll()
     * Método que retorna uma lista de objetos do tipo Visita.
     * SQL STATEMENT: SELECT * FROM VISITA;
     * 
     */
    public function getAll(){
        $querry = $this->db->order_by('data', 'ASC')->get('visita');
        return $querry->result();
    }

    /*
     * @author: Dhiego Balthazar
     * @returns: mixed Visita
     * @params: $object Visita
     * O método getByData() tem como objetivo retornar um objeto do tipo Visita comparado pela Data na tabela visita
     * SQL STATEMENT: SELECT * FROM VISITA WHERE data = data@params;
     * 
     */
    public function findByData($object){
        $this->db->select('*');
        $this->db->where('data', $object->data);
        return $this->db->get('visita')->row();
    }

    /*
     * @author: Dhiego Balthazar
     * @returns: bool
     * @params: $object Visita
     * O médodo persist() tem como objetivo inserir um objeto do tipo Pessoa na tabela visita;
     * SQL STATEMENT: INSERT INTO visita VALUES(nome, rg);
     * 
     */
    public function persist($array){
        return $this->db->insert('visita', $array);
    }
}