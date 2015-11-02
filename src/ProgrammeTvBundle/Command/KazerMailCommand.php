<?php


namespace ProgrammeTvBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KazerMailCommand extends ContainerAwareCommand{


    protected function configure()
    {
        $this
            ->setName('xml:tv:mail')
            ->setDescription('programme télé avec kazer comme sources');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $channels = $em->getRepository('ProgrammeTvBundle:Channel')
            ->findAll();

        $programmes = $em->getRepository('ProgrammeTvBundle:Programme')
            ->getToday();

//        die(var_dump($programmes));

        $mailPerso = $this->getContainer()->getParameter('mon_mail');
        $message = \Swift_Message::newInstance()
            ->setSubject('programme tv')
            ->setFrom('Gargamail@llovem.eu')
            ->setTo($mailPerso)
            ->setCharset('UTF-8')
            ->setContentType('text/html')
            ->setBody($this->getContainer()->get('templating')->render('ProgrammeTvBundle:Email:default.html.twig', array('channels' => $channels, 'programmes' => $programmes)));
        $this->getContainer()->get('mailer')->send($message);
    }

}