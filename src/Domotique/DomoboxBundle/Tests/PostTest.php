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
            // {"mac":"18fe349d958b","ipv4":"10.0.112.2","iterator":"1932","debug txt":"sucess","sensors":[{"sensor Id":"1","sensor type Id":"1","sensor unit Id":"7","sensor value":"1"},{"sensor Id":"1","sensor type Id":"3","sensor unit Id":"2","sensor value":"22.60"},{"sensor Id":"1","sensor type Id":"3","sensor unit Id":"3","sensor value":"44.90"}]}
        );

        $client->request(
            'POST',
            '/module/esp8266/post/json/',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode(array('data' => $datas))
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
