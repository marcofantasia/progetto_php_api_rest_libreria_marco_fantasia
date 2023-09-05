<?php


class Database
	{
	// credenziali
	private $host = "localhost";
	private $db_name = "libreria";
	private $username = "root";
	private $password = "rootroot";
	public $conn;
	// connessione al database
	public function getConnection()
		{
		$this->conn = null;
		try
			{
			$this->conn = new PDO('mysql:host=localhost;dbname=libreria', 'root', 'rootroot');
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->exec("set names utf8");
			}
		catch(PDOException $exception)
			{
			echo "Errore di connessione: " . $exception->getMessage();
			}
		return $this->conn;
		}
	}
?>





