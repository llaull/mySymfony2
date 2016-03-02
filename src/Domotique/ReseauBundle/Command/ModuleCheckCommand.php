<?php

namespace Domotique\ReseauBundle\Command;


use Domotique\ReseauBundle\Entity\ModuleNotify;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ModuleCheckCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('domotique:reseau:module:check')
            ->setDescription('check si les modules envoient leurs flux dans l\'heure sinon envoie un mail');
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $now = new \DateTime();

        //doctrine
        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        //charge tout les modules
        $entities = $em->getRepository('DomotiqueReseauBundle:Module')->findAll();


        // pour chaque module
        foreach ($entities as $value) {

            //on va chercher son dernier envoie
            $entities = $em->getRepository('DomotiqueReseauBundle:Log')->findOneBy(array('module' => $value->getId()), array('created' => 'DESC'));

            // si source
            if ($entities) {

                $last = $entities->getCreated();
                $diff = $last->diff($now);


                $output->writeln("id du module " . $value->getId());
                $output->writeln("id du log " . $entities->getId() . ' -> ' . $last->format('d/m/Y H:i:s'));
                $output->writeln($diff->format('%R%d days et : %R%h heure'));
                $output->writeln($diff->format('%Y-%M-%D %H:%I:%S'));
                $output->writeln("_________________");

                //on regarde si la notification à deja été generé
                $checkNotifiy= $em->getRepository('DomotiqueReseauBundle:ModuleNotify')->findOneBy(array('log' => $entities->getId()));

                //sinon on cree la notification
                if (!$checkNotifiy) {
                    $notif = new ModuleNotify();
                    $notif->setLog($entities);
                    $notif->setStatus("lost");
                    $em->persist($notif);
                    $em->flush();

                    //il faut envoyer le mail ici
                }


            }

        }

        $formData = array(
            'date' => "eeq",
        );

        //si $newFeed n'est pas un objet (non present en base)
        $mailPerso = $this->getContainer()->getParameter('mon_mail');
        $message = \Swift_Message::newInstance()
            ->setSubject('alert !')
            ->setFrom('Gargamail@llovem.eu')
            ->setTo($mailPerso)
            ->setCharset('UTF-8')
            ->setContentType('text/html')
            ->setBody($this->getContainer()->get('templating')->render('DomotiqueReseauBundle:Email:default.html.twig', $formData));

        try {
//            $this->getContainer()->get('mailer')->send($message);
        } catch (\Swift_TransportException $e) {
            $output->writeln($e->getMessage());
        }

    }

}
