<?php
    namespace Alura\Leilao\Model\Service;
    use Alura\Leilao\Model\Lance;
    use Alura\Leilao\Model\Leilao;

    class Avaliador {
        private $maiorValor = -INF;
        private $menorValor = INF;
        private $melhoresLances;
        
        public function avalia(Leilao $leilao) :void {

            foreach($leilao->getLances() as $lance) {
                if ($lance->getValor() > $this->maiorValor) {
                    $this->maiorValor = $lance->getValor();
                } 
                if($lance->getValor() < $this->menorValor){
                    $this->menorValor = $lance->getValor();
                }
                $lancesArray = $leilao->getLances();
                usort($lancesArray, function (Lance  $lance1, Lance $lance2) {
                    return $lance2->getValor() - $lance1->getValor();
                });
                $this->melhoresLances = array_splice($lancesArray, 0, 3);
            }

        }

        public function getMaiorValor(): float {
            return $this->maiorValor;
        }

        public function getMenorValor(): float {
            return $this->menorValor;
        }

        public function getMelhoresLances(): array {
            return $this->melhoresLances;
        }

    }
?>