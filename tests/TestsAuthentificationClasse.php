<?php

use PHPUnit\Framework\TestCase;
require("model/client.php");

class TestsAuthentificationClasse extends TestCase
{
    public function testInscriptionClient()
    {
        $client = new client();
        $testClientDejaInscrit = $client->estDejaInscrit("arnaud.bourgoin@outlook.com");
        $this->assertSame(true,$testClientDejaInscrit);

        $testClientDejaInscrit2 = $client->estDejaInscrit("arnaud.bourgo@outlook.com");
        $this->assertSame(false,$testClientDejaInscrit2);



        $testClientInscription = $client->inscriptionClient("Divine","Tom","tom.divine@gmail.com","azerty","56 rue des fou","95862","Nancy",null);
        $this->assertSame(true,$testClientInscription);

    }

    public function testConnexionClient()
    {
        $client = new client();
        $testClientConnexion = $client->connexion("donald.duck@gmail.com","azerty");
        $this->assertSame(true,$testClientConnexion);

        $testClientConnexion2 = $testClientConnexion = $client->connexion("dona.du@gmail.com","aze");
        $this->assertSame(false,$testClientConnexion2);
    }

    public function testAdminConnexion()
    {
        $client = new client();
        $testAdmin = $client->testAdmin("arnaud.bourgoin@outlook.com");
        $this->assertSame(true,$testAdmin);

        $this->assertSame(1,(int)$_SESSION["admin"]);

        $_SESSION["admin"] = null;

        $testAdmin2 = $client->testAdmin("test@orange.com");
        $this->assertSame(false,$testAdmin2);
        $this->assertSame(0,(int)$_SESSION["admin"]);
    }
}
?>