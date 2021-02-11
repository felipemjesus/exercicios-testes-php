<?php

namespace Alura\Leilao\Tests\Integration\Dao;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Infra\ConnectionCreator;
use Alura\Leilao\Model\Leilao;
use PHPUnit\Framework\TestCase;

class LeilaoDaoTest extends TestCase
{
    public function testInsercaoEBuscaDevemFuncionar()
    {
        $leilao = new Leilao('Variante 0KM');
        $leilaoDao = new LeilaoDao(ConnectionCreator::getConnection());

        $leilaoDao->salva($leilao);

        $leiloes = $leilaoDao->recuperarNaoFinalizados();

        self::assertCount(1, $leiloes);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame('Variante 0KM', array_shift($leiloes)->recuperarDescricao());
    }
}