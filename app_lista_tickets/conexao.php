<?php

class Conexao {

	private $host = 'mysql380.umbler.com';
	private $dbname = 'php_com_pdo';
	private $user = 'eliascmendhes';
	private $pass = 'dksw1010p';

	public function conectar() {
		try {

			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"				
			);

			return $conexao;


		} catch (PDOException $e) {
			echo '<p>'.$e->getMessege().'</p>'; 
		}
	}
}

?>