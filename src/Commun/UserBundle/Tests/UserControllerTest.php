<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 06/01/2016
 * Time: 11:08
 */

namespace CarnetsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserControllerTest extends WebTestCase
{

    public function testCompleteScenario($username = 'test', $password = 'test')
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username' => $username,
            '_password' => $password,
        ));
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());

    }

}