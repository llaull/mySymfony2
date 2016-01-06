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

    public function logIn($client, $username = 'test', $password = 'test')
    {
//        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username' => $username,
            '_password' => $password,
        ));
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
    }

    protected function createAuthorizedClient()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $session = $container->get('session');
        /** @var $userManager \FOS\UserBundle\Doctrine\UserManager */
        $userManager = $container->get('fos_user.user_manager');
        /** @var $loginManager \FOS\UserBundle\Security\LoginManager */
        $loginManager = $container->get('fos_user.security.login_manager');
        $firewallName = $container->getParameter('fos_user.firewall_name');

        $user = $userManager->findUserBy(array('username' => 'test'));
        $loginManager->loginUser($firewallName, $user);

        // save the login token into the session and put it in a cookie
        $container->get('session')->set('_security_' . $firewallName,
            serialize($container->get('security.context')->getToken()));
        $container->get('session')->save();
        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));

        return $client;
    }

    public function testCompleteScenario()
    {

        $client = static::createClient();
        $this->logIn($client);

//        $crawler = $client->request('GET', "/admin/carnet/blog/article/");
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());

//        $client->click($crawler->selectLink('Create a new entry')->link());

    }

}