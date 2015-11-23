<?php
namespace  CarnetsBundle\DataFixtures\ORM;

use CarnetsBundle\Entity\Lieu;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class LoadLieuLyonData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $l = new Lieu();
        $l->setCreated(new \DateTime());
        $l->setVille('Lyon');
        $l->setCarnet($this->getReference('carnet-fr'));

        $manager->persist($l);
        $manager->flush();

        $this->addReference('lieu-lyon', $l);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}