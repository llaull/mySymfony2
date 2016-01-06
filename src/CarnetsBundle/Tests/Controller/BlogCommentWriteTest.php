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

        $crawler = $client->request('GET', "/carnet/le-lounge/bienvenue");
        $this->assertEquals(200 , $client->getResponse()->getStatusCode());


        $form = $crawler->selectButton('CreaEntity/BlogCategoryte')->form(array(
            'carnetsbundle_blogcomment[authorName]' => 'Test'
        ));
        $client->submit($form);



//        $form = $crawler->selectButton('Create')->form(array(
//            'carnetsbundle_blogcomment[authorName]' => 'Test',
//            'carnetsbundle_blogcomment[authorMail]' => 'Test@test.fr',
//            'carnetsbundle_blogcomment[contenu]' => 'Test Test',
//            'carnetsbundle_blogcomment[arcticle]' => '1',
//            'carnetsbundle_blogcomment[reply]' => NULL
//        ));

//        die(var_dump($form));
        $client->submit($form);
        $client->followRedirect();



        $this->assertGreaterThan(0, $crawler->filter('div.comment-text.color-grey:contains("plup")')->count(), 'Missing element td:contains("Test")');

//        die(var_dump($crawler));


    }
}
