<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 04/02/2016
 * Time: 17:12
 */

namespace Domotique\bundle\ModuleBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        // données simulé
        $datas = array(
            'mac' => "01:80:C2:00:00:00",
            'ipv4' => "192.168.15.15",
            'iteration' => 1,
            "texte test" => "lorem ussu"
        );

        $client->request(
            'POST',
            '/m/g/coucou/values',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode(array('data' => $datas))
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
