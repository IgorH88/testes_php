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