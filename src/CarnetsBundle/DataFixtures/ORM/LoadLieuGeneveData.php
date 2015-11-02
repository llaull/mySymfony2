<?php
namespace  CarnetsBundle\DataFixtures\ORM;

use CarnetsBundle\Entity\Lieu;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class LoadLieuGeneveData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $l = new Lieu();
        $l->setCreated(new \DateTime());
        $l->setVille('Geneves');
        $l->setCarnet($this->getReference('carnet-sh'));


        $manager->persist($l);
        $manager->flush();

        $this->addReference('lieu-gene', $l);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}