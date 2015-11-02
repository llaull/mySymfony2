<?php

namespace TclBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use TclBundle\Entity\Feed;
use Domotique\bundle\TaskBundle\Entity\Log;
use Domotique\bundle\TaskBundle\Entity\Task;

class XmlTclCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('xml:tcl')
            ->setDescription('tcl en xml');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->plup($output);

    }

    protected function plup(OutputInterface $output){

        //sql init
        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        //log task
        $task = $em->getRepository('DomotiquebundleTaskBundle:Task')
            ->findOneByTitle("xml:tcl");

        $newTaskLog = new Log();
        $newTaskLog->setSource("cron");
        $newTaskLog->setDestination("Command");
        $newTaskLog->setIdTask($task);

        throw new \Exception('Something went wrong!');

        // Showing when the script is launched
        $now = new \DateTime();
        $start = $now->format('d-m-Y G:i:s');
//        $output->writeln('<comment>Start : ' . $start . ' ---</comment>');

        $sources = "http://www.tcl.fr/rss2/feed/infos-trafic";

        $converter = $this->getContainer()->get('curling.cool');
        $outils = $this->getContainer()->get('outils.date');
        $data = $converter->curling($sources);


        $data = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($data === false) {
            $e = "Failed loading XML";
            $newTaskLog->setReponse($e);
            $output->writeln($e);


            foreach (libxml_get_errors() as $error) {
                $output->writeln($error->message);
            }
        } else {

            $myFavoris = array('31', '43', 'métro D', 'métro B', 'métro A', 'T2', 'T4');
            $i = 0; //itérateur de neauvou accident


            foreach ($data->channel->item as $value) {
                if ($value->pubDate != "") {

                    //cherche les alert avec la date du flux
                    $newFeed = $em->getRepository('TclBundle:Feed')
                        ->findOneByCreated($outils->dateConvertor($value->pubDate));

                    if (!is_object($newFeed)) {
                        $i++;

                        $newFeed = new Feed();
                        $newFeed->setCreated($outils->dateConvertor($value->pubDate));

//                        $output->writeln('nouvelle accident : ' . $value->title);


                        $newFeed->setAdded(new \DateTime);
                        $newFeed->setTitle(rtrim(ltrim($value->title)));
                        $newFeed->setDescription(rtrim(ltrim($value->description)));

                        //pour chaque bus utiliser
                        foreach ($myFavoris as $v) {
                            if (strpos($value->title, $v)) {
                                $newFeed->setUsed(true);

                                $formData = array(
                                    'title' => rtrim(ltrim($value->title)),
                                    'description' => rtrim(ltrim($value->description)),
                                    'date' => $outils->dateConvertor($value->pubDate),
                                );

                                //si $newFeed n'est pas un objet (non present en base)
                                $mailPerso = $this->getContainer()->getParameter('mon_mail');
                                $message = \Swift_Message::newInstance()
                                    ->setSubject('TCL alert : ' . rtrim(ltrim($value->title)) . '')
                                    ->setFrom('Gargamail@llovem.eu')
                                    ->setTo($mailPerso)
                                    ->setCharset('UTF-8')
                                    ->setContentType('text/html')
                                    ->setBody($this->getContainer()->get('templating')->render('TclBundle:Email:default.html.twig', $formData));
                                $this->getContainer()->get('mailer')->send($message);

                            }
                        }
                    }

                    $em->persist($newFeed);

                }
            }


        }
        // Showing when the script is over
        $now = new \DateTime();
        $end = $now->format('d-m-Y G:i:s');
//        $output->writeln('<comment>End : ' . $end . ' ---</comment>');
        $output->writeln('<comment>' .$i . ' ajout en ' . abs(strtotime($start) - strtotime($end)) . 'sec'. '</comment>');
        $newTaskLog->setReponse($i . ' ajout en ' . abs(strtotime($start) - strtotime($end)) . 'sec');
        $em->persist($newTaskLog);

        // Flushing and clear data on queue
        $em->flush();
        $em->clear();


        // die(var_dump($output));

    }

}
