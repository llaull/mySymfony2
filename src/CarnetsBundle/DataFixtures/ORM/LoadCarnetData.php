<?php
namespace  CarnetsBundle\DataFixtures\ORM;

use CarnetsBundle\Entity\Carnet;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class LoadCarnetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //test carnet
        $c = new Carnet();
        $c->setTitle("Matrix");
        $c->setDescription("teste txt description");
        $c->setDestination("France");
        $c->setCreated(new \DateTime());

        // Enregistrment dans la base de données
        $manager->persist($c);
        $manager->flush();

        $this->addReference('carnet-fr', $c);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}