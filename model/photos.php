<?php
class photo
{
	// Objet PDO servant à la connexion à la base
	private $pdo;

	// Connexion à la base de données
	public function __construct() 
	{
		$config = parse_ini_file("config.ini");
		
		try 
		{
			$this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
		} 
		catch(Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	// Récuperer les photos d'un produit
	public function getLesPhotos($idProduit)
	{
		$sql = "SELECT imgProd FROM photos INNER JOIN produit ON produit.codeProduit = photos.idProduit WHERE codeProduit = :code";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':code', $idProduit, PDO::PARAM_INT);
		$req->execute();
		return $req->fetchAll();
	}

}


?>