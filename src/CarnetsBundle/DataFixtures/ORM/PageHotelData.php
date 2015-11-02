<?php
namespace  CarnetsBundle\DataFixtures\ORM;

use CarnetsBundle\Entity\Lieu;
use CarnetsBundle\Entity\Page;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class PageHotelData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $p = new Page();
        $p->setCreated(new \DateTime());
        $p->setContenu('lorem hotel');
        $p->setLieu($this->getReference('lieu-lyon'));
        $p->setTitre('Hotel');

        $manager->persist($p);
        $manager->flush();

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
