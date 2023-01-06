<?php
class devis
{
	private $pdo;

	// Connexion à la base de données
	public function __construct() {
		$config = parse_ini_file("config.ini");
		
		try {
			$this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	public function RecupererTousLesDevis()
	{
		$sql = "SELECT designationProduit,id,nomClient,prenomClient,tarif,commentaire FROM devis INNER JOIN produit ON produit.codeProduit = devis.idProduit INNER JOIN client ON client.idClient = devis.idClient WHERE etat = 0";

		$req = $this->pdo->prepare($sql);
		$req->execute();
		
		return $req->fetchAll();
	}

	public function RecupererMesDevis($idClient)
	{
		$sql = "SELECT designationProduit,id,nomClient,prenomClient,tarif,commentaire,etat FROM devis INNER JOIN produit ON produit.codeProduit = devis.idProduit INNER JOIN client ON client.idClient = devis.idClient WHERE devis.idClient = :idClient";

		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idClient', $idClient, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetchAll();
	}

	public function DemandeDevis($idClient, $idProd) 
	{
		$getNbDemandeDevisProduit = $this->verificationNombreDemandeDevisProduit($idProd,$idClient);

		if($getNbDemandeDevisProduit[0] == 0)
		{
			
			$sql = "INSERT INTO devis (idProduit, idClient) VALUES (:idProduit, :idClient);";
			$req = $this->pdo->prepare($sql);
			$req->bindParam(':idClient', $idClient, PDO::PARAM_INT);
			$req->bindParam(':idProduit', $idProd, PDO::PARAM_INT);
			$req->execute();

			return true;
		}
		else
		{
			return false;
		}
		

	}

	public function RepondreDevis($idDevis)
	{
		$sql = "SELECT designationProduit,nomClient,prenomClient,id FROM devis INNER JOIN produit ON devis.idProduit = produit.codeProduit INNER JOIN client ON devis.idClient = client.idClient WHERE id = :idDevis";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idDevis', $idDevis, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetch();
	}

	public function RecupererNomProduitDevis($idProd)
	{
		$sql = "SELECT designationProduit FROM produit WHERE codeProduit = :idProd";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idProd', $idProd, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetch();
	}

	public function verificationNombreDemandeDevisProduit($idProd, $idClient)
	{
		$sql = "SELECT COUNT(*) FROM devis WHERE idProduit = :idProd AND idClient = :idClient";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idProd', $idProd, PDO::PARAM_INT);
		$req->bindParam(':idClient', $idClient, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetch();
	}

	public function RecupererDevisTermine()
	{
		$sql = "SELECT designationProduit,id,nomClient,prenomClient,tarif,commentaire FROM devis INNER JOIN produit ON produit.codeProduit = devis.idProduit INNER JOIN client ON client.idClient = devis.idClient WHERE etat = 1";

		$req = $this->pdo->prepare($sql);
		$req->execute();
		
		return $req->fetchAll();	
	}

	public function ModifierDevisEnCours($idDevis,$tarif,$comm)
	{
		$sql = "UPDATE devis SET tarif = :tarif, commentaire = :comm, etat = 1 WHERE id = :idDevis";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':tarif', $tarif, PDO::PARAM_INT);
		$req->bindParam(':comm', $comm, PDO::PARAM_STR);
		$req->bindParam(':idDevis', $idDevis, PDO::PARAM_INT);	
		$req->execute();
	}





}
?>