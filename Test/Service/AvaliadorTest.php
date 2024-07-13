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

        public function testPegaOsTresMelhoresValoresDosLances()
        {
            $leilao = new Leilao('Computar');

            $usuJoao = new Usuario('Joao');
            $usuMaria = new Usuario('Maria');
            $usuAna = new Usuario('Ana');
            $usuJose = new Usuario('Jose');

            $leilao->recebeLance(new Lance($usuAna, 1700));
            $leilao->recebeLance(new Lance($usuMaria, 2000));
            $leilao->recebeLance(new Lance($usuJoao, 1000));
            $leilao->recebeLance(new Lance($usuJose, 1500));

            $leiloeiro = new Avaliador();

            $leiloeiro->avalia($leilao);

            $melhoresLaces = $leiloeiro->getMelhoresLances();

            self::assertCount(3, $melhoresLaces);
            self::assertEquals(2000, $melhoresLaces[0]->getValor());
            self::assertEquals(1700, $melhoresLaces[1]->getValor());
            self::assertEquals(1500, $melhoresLaces[2]->getValor());

        }
    }