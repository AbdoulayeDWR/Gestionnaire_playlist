<?php

class BDD
{
	private $host = 'localhost';
	private $dbname = 'playlist_gestionnaire';
	private $user = 'root';
	private $pwd = '';

	private $bdd = false;

	public function __construct()
	{
		try {
			$this->bdd = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->pwd);
		} catch (PDOException $erreur) {
			die($erreur->getMessage());
		}
	}

	public function getConnexion()
	{
		return $this->bdd;
	}
}