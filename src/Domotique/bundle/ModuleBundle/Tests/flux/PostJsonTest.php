<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 04/02/2016
 * Time: 17:12
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostJsonTest extends WebTestCase {


    public function testIndex()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/m/g/coucou/values',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name":"Fabien"}'
        );

    }
}