<?php
class Produit_cl
{
	private $codeProduit;
	private $libProduit;

	public function __construct($codeP,$libProduit) 
	{
		$this->codeProduit = $codeP;
		$this->libProduit = $libProduit;
	}

	public function getCode()
	{
		return $this->codeProduit;
	}

	public function getLib()
	{
		return $this->libProduit;
	}


}
?>