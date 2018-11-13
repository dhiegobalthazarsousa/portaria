<?php
/*
 * @author: Dhiego Balthazar
 * metodo que retorna uma data trocada: se houver o caracter '-' ele troca por
 * '/' e transforma na data do Brasil
 * se não ele transforma na data que o banco de dados aceita
 * @params: $date
 * @returns: $date
 */
function getDateNow(){
	date_default_timezone_set('America/Sao_Paulo');
	return date("y-m-d");
}