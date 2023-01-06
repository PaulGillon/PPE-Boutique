<?php

use PHPUnit\Framework\TestCase;
require("model/produit.php");

class TestsPanierClasse extends TestCase
{
    // Cas de la réalisation d'un panier et du passage de la commande

    // 1. Test pour vérifier le stock du/des produit(s) que l'on va ajouter dans le panier
    public function TestStock()
    {
        $panier = [];
        $produit = new produit();
        $produitEnStock = $produit->estDispoEnStock(3,4);
        
    }
    
    
    
    // 2. Faire un test pour vérifier que le panier soit vide
    // 3. Faire un test pour vérifier la suppression d'un article dans le panier
    // 4. Faire un test pour vérifier la quantité de chaque produit que l'on va commander soit toujours disponible
    // lors du passage de la commande
    // 5. Faire un test pour vérifier que la commande est bien passé
}
?>