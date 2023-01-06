<?php
class ProduitDevis extends Produit_cl
{
	private $dlsProduit;

	public function __construct($libP,$dlsP)
	{
		parent::__construct($codeP,$libP);
		$this->$dlsProduit = $dlsP;
	}

	public function getDelais()
	{
		return $this->$dlsProduit;
	}
}
?>