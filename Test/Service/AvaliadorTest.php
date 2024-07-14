<?php

    namespace Alura\Leilao\Model\Test\Service;
    use Alura\Leilao\Model\Lance;
    use Alura\Leilao\Model\Leilao;
    use Alura\Leilao\Model\Usuario;
    use Alura\Leilao\Model\Service\Avaliador;
    use PHPUnit\Framework\TestCase;

    class AvaliadorTest extends TestCase
    {
        public static function leilaoEmOrdemCrescente()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
            $usuAna = new Usuario('Ana');
            $usuJose = new Usuario('Jose');

            $leilao->recebeLance(new Lance($usuJose, 1500));
            $leilao->recebeLance(new Lance($usuAna, 1700));
            $leilao->recebeLance(new Lance($usuMaria, 2000));
            $leilao->recebeLance(new Lance($usuJoao, 2500));

            return [
                [$leilao]
            ];
        }

        public static function leilaoEmOrdemDecrescente()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
            $usuAna = new Usuario('Ana');
            $usuJose = new Usuario('Jose');
        
            $leilao->recebeLance(new Lance($usuJoao, 2500));
            $leilao->recebeLance(new Lance($usuMaria, 2000));
            $leilao->recebeLance(new Lance($usuAna, 1700));
            $leilao->recebeLance(new Lance($usuJose, 1500));

            return [
                [$leilao]
            ];
        }
    
        public static function leilaoEmOrdemAleatoria()
        {
            $leilao = new Leilao('Computador gamer');
        
            $usuMaria = new Usuario('Maria');
            $usuJoao = new Usuario('João');
            $usuAna = new Usuario('Ana');
            $usuJose = new Usuario('Jose');
        
            $leilao->recebeLance(new Lance($usuMaria, 2000));
            $leilao->recebeLance(new Lance($usuJoao, 2500));
            $leilao->recebeLance(new Lance($usuJose, 1500));
            $leilao->recebeLance(new Lance($usuAna, 1700));

            return [
                [$leilao]
            ];
        }

        /**
         * @dataProvider leilaoEmOrdemAleatoria
         * @dataProvider leilaoEmOrdemCrescente
         * @dataProvider leilaoEmOrdemDecrescente
         */
    
        public function testAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao)
        {
            $leiloeiro = new Avaliador();        
            $leiloeiro->avalia($leilao);
            $maiorValor = $leiloeiro->getMaiorValor();        
            self::assertEquals(2500, $maiorValor);
        }

        /**
         * @dataProvider leilaoEmOrdemAleatoria
         * @dataProvider leilaoEmOrdemCrescente
         * @dataProvider leilaoEmOrdemDecrescente
         */
        public function testAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao)
        {       
            $leiloeiro = new Avaliador();        
            $leiloeiro->avalia($leilao);
            $menorValor = $leiloeiro->getMenorValor();        
            self::assertEquals(1500, $menorValor);
        }

        /**
         * @dataProvider leilaoEmOrdemAleatoria
         * @dataProvider leilaoEmOrdemCrescente
         * @dataProvider leilaoEmOrdemDecrescente
         */
        public function testPegaOsTresMelhoresValoresDosLances(Leilao $leilao)
        {
            $leiloeiro = new Avaliador();

            $leiloeiro->avalia($leilao);

            $melhoresLaces = $leiloeiro->getMelhoresLances();

            self::assertCount(3, $melhoresLaces);
            self::assertEquals(2500, $melhoresLaces[0]->getValor());
            self::assertEquals(2000, $melhoresLaces[1]->getValor());
            self::assertEquals(1700, $melhoresLaces[2]->getValor());
        }
    }