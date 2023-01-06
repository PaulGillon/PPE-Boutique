<?php

use PHPUnit\Framework\TestCase;
require("classes/devis.php");

class TestsDevisClasse extends TestCase
{
    /** @test */
    public function TestFaireDevis()
    {
        $devis = new devis();
        $demandeDevis = $devis->DemandeDevis(6,7);
        $this->assertSame(false,$demandeDevis);

        $demandeDevis2 = $devis->DemandeDevis(6,5);
        $this->assertSame(true,$demandeDevis2);


    }
}
?>