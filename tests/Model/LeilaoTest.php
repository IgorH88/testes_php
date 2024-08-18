<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class LeilaoTest extends TestCase 
{
    /**
     * @dataProvider geraLances 
     */
    public function testLeilaoDeveReceberLances(int $qtdLances, Leilao $leilao, array $valores)
    {
        static::assertCount($qtdLances, $leilao->getLances());
        foreach($valores as $i => $valorEsperado){
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $usuMaria = new Usuario('Maria');
        $leilao = new Leilao('Variante');

        $leilao->recebeLance(new Lance($usuMaria, 1000));
        $leilao->recebeLance(new Lance($usuMaria, 2000));

        static::assertCount(1, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());
    }

    public function testLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
    {
        $leilao = new Leilao('Brasília Amarela');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
    
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));
        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));
        $leilao->recebeLance(new Lance($joao, 6000));
    
        static::assertCount(10, $leilao->getLances());
        static::assertEquals(5500, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());
    }

    public function geraLances()
    {
        $usuJoao = new Usuario('Joao');
        $usuMaria = new Usuario('Maria');

        $leilaoComDoisLance = new Leilao('Fiat 147 0km');
        $leilaoComDoisLance->recebeLance(new Lance($usuJoao, 1000));
        $leilaoComDoisLance->recebeLance(new Lance($usuMaria, 2000));

        $leilaoComUmLance = new Leilao('TESTE');
        $leilaoComUmLance->recebeLance(new Lance($usuJoao, 5000));

        return [
            '2-lances' => [2, $leilaoComDoisLance, [1000, 2000]],
            '1-lance' => [1, $leilaoComUmLance, [5000]]
        ];
    }
}