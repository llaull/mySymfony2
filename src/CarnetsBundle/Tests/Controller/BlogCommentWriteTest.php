<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 06/01/2016
 * Time: 10:08
 */

namespace CarnetsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BlogCommentWriteTest extends WebTestCase{

    public function testCompleteScenario()
    {
        $client = static::createClient();

        $client->request('GET', "/carnet/le-lounge/bienvenue");
        $this->assertEquals(200 , $client->getResponse()->getStatusCode());


        //        // Fill in the form and submit it
//        $form = $crawler->selectButton('Create')->form(array(
//            'carnetsbundle_blogcomment[authorName]' => 'Test',
//            'carnetsbundle_blogcomment[authorMail]' => 'Test@test.fr',
//            'carnetsbundle_blogcomment[contenu]' => 'Test Test',
////            'carnetsbundle_blogcomment[arcticle]' => '1',
////            'carnetsbundle_blogcomment[reply]' => NULL

//        ));

//        $client->submit($form);
//        $client->followRedirect();

//        die(var_dump($crawler));


    }
}