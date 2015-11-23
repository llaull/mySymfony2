<?php
namespace  CarnetsBundle\DataFixtures\ORM;

use CarnetsBundle\Entity\Carnet;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class CarnetSuisse extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //test carnet
        $c = new Carnet();
        $c->setTitle("test 2");
        $c->setDescription("Suisse descript");
        $c->setDestination("Suisse");
        $c->setCreated(new \DateTime());

        // Enregistrment dans la base de données
        $manager->persist($c);
        $manager->flush();

        $this->addReference('carnet-sh', $c);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}