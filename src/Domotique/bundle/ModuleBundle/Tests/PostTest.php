<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 04/02/2016
 * Time: 17:12
 */

namespace Domotique\bundle\ModuleBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostTest extends WebTestCase {


    public function testIndex()
    {
        $client = static::createClient();



        $dados = array(
            'nome' => 'Entidade TESTE 01',
            'ativo' => 0,
            '_token' => $this->csrfDefaultToken
        );

        $crawler = $client->request(
            'POST',
            'm/g/coucou/values',
            array(),
            array(),
            array(
                'CONTENT_TYPE'          => 'application/json',
                'HTTP_X-Requested-With' => 'XMLHttpRequest'
            ),
            json_encode(array('cartorio_servico_entidade'=>$dados))
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());



//        $client->request(
//            'POST',
//            '/m/g/coucou/values',
//            array(),
//            array(),
//            array('CONTENT_TYPE' => 'application/json'),
//            '{"name":"Fabien"}'
//        );
//
//        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }
}
