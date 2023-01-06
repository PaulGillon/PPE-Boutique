<?php
class ProduitFixe extends Produit_cl
{
	private $stockProduit;
	private $prixProduit;

	public function __construct($codeP,$libP,$stockP,$prixP)
	{
		parent::__construct($codeP,$libP);
		$this->stockProduit = $stockP;
		$this->prixProduit = $prixP;
	}

	public function getStock()
	{
		return $this->stockProduit;
	}

	public function getPrix()
	{
		return $this->prixProduit;
	}
}
?>