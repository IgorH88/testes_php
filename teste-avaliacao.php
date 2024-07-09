<?php
    use Alura\Leilao\Model\Lance;
    use Alura\Leilao\Model\Leilao;
    use Alura\Leilao\Model\Usuario;
    use Alura\Leilao\Model\Service\Avaliador;

    require 'vendor/autoload.php';

    $leilao = new Leilao('Computador gamer');

    $usuMaria = new Usuario('Maria');
    $usuJoao = new Usuario('João');

    $leilao->recebeLance(new Lance($usuMaria, 2000));
    $leilao->recebeLance(new Lance($usuJoao, 2100));

    $leiloeiro = new Avaliador();

    $leiloeiro->avalia($leilao);
    $maiorValor = $leiloeiro->getMaiorValor();

    echo $maiorValor;
?>