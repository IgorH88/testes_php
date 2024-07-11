<?php

    namespace Alura\Leilao\Model\Test\Service;
    use Alura\Leilao\Model\Lance;
    use Alura\Leilao\Model\Leilao;
    use Alura\Leilao\Model\Usuario;
    use Alura\Leilao\Model\Service\Avaliador;
    use PHPUnit\Framework\TestCase;

    class AvaliadorTest extends TestCase
    {
    
        public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCecrescente()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
        
            $leilao->recebeLance(new Lance($usuMaria, 2000));
            $leilao->recebeLance(new Lance($usuJoao, 2500));
        
            $leiloeiro = new Avaliador();
        
            $leiloeiro->avalia($leilao);
            $maiorValor = $leiloeiro->getMaiorValor();
        
            self::assertEquals(2500, $maiorValor);
        }

        public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCecrescente()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
        
            $leilao->recebeLance(new Lance($usuMaria, 2000));
            $leilao->recebeLance(new Lance($usuJoao, 2500));
        
            $leiloeiro = new Avaliador();
        
            $leiloeiro->avalia($leilao);
            $menorValor = $leiloeiro->getMenorValor();
        
            self::assertEquals(2000, $menorValor);
        }

        public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOremDecrescente()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
        
            $leilao->recebeLance(new Lance($usuJoao, 2500));
            $leilao->recebeLance(new Lance($usuMaria, 2000));
        
            $leiloeiro = new Avaliador();
        
            $leiloeiro->avalia($leilao);
            $maiorValor = $leiloeiro->getMaiorValor();
        
            self::assertEquals(2500, $maiorValor);
        }

        public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOremDecrescente()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
        
            $leilao->recebeLance(new Lance($usuJoao, 2500));
            $leilao->recebeLance(new Lance($usuMaria, 2000));
        
            $leiloeiro = new Avaliador();
        
            $leiloeiro->avalia($leilao);
            $menorValor = $leiloeiro->getMenorValor();
        
            self::assertEquals(2000, $menorValor);
        }
    }