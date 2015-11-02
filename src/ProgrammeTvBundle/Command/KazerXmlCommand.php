<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 05/10/2015
 * Time: 10:19
 */

namespace ProgrammeTvBundle\Command;


use ProgrammeTvBundle\Entity\Channel;
use ProgrammeTvBundle\Entity\Programme;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Filesystem\Filesystem;

class KazerXmlCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('xml:tv')
            ->setDescription('programme télé avec kazer comme sources');
    }

    protected function curlPlus($localPath, $sources)
    {

        set_time_limit(0);
        $fp = fopen($localPath, 'w+');
        $ch = curl_init($sources);
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp); // write curl response to file
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch); // get curl response
        curl_close($ch);
        fclose($fp);
    }

    /**
     * @param $file
     * @param $output
     */
    protected function lecteurXml($file, $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);


        $data = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);


        if ($data === false) {
            $output->writeln("Failed loading XML: ");

            foreach (libxml_get_errors() as $error) {
                $output->writeln($error->message);
            }
        }

        if (!$data === false) {

            //ajout des chaines dans la DB
            foreach ($data->channel as $value) {

               $this->channels($em, $value['id'], $value->{'display-name'});

            }

            //ajoute les programmes dans la DB
            foreach ($data->programme as $value) {

                $programmeDebut = new \DateTime($value['start']);
                $programmeFin = new \DateTime($value['stop']);

                $today = date("Y-m-d");

                //si c'est le programme du jour
                if ($programmeDebut->format('Y-m-d') == $today) {

                    //si le programme commence à 20 et est plus long que 40min (pour eviter la meteo)
                    if (($programmeDebut->format('H') >= '20') AND ($value->length > 40)) {

                        $this->programmes($em,$programmeDebut, $programmeFin, $value['channel'], $value->title, $value->{'sub-title'}, $value->desc, $value->category,$output);
                    }
                }

            }

        }

    }

    /**
     * @param $em
     * @param $id
     * @param $name
     */
    protected function channels($em, $id, $name)
    {

        $newChannel = $em->getRepository('ProgrammeTvBundle:Channel')
            ->findOneByIdKazer($id);

        if (!is_object($newChannel)) {
            $newChannel = new Channel();
            $newChannel->setIdKazer($id);
            $newChannel->setName($name);
            $em->persist($newChannel);
        }

        $em->flush();
        $em->clear();
    }


    /**
     * @param $em
     * @param $debut
     * @param $fin
     * @param $channel
     * @param $title
     * @param $ssTitre
     * @param $desc
     * @param null $category
     */
    protected function programmes($em,$debut, $fin, $channel, $title, $ssTitre, $desc, $category = NULL,$output)
    {

        $Channel = $em->getRepository('ProgrammeTvBundle:Channel')
            ->findOneByIdKazer($channel);

        $programme = new Programme();
        $programme->setCategory($category);
        $programme->setIdChannel($Channel);
        $programme->setDescription($desc);
        $programme->setStart($debut);
        $programme->setStop($fin);
        $programme->setTitle($title);
        $programme->setSubTitle($ssTitre);


        $em->persist($programme);
        $em->flush();
        $em->clear();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //va chercher le fichier xml
        $localPath = 'tmp/programmeTV.tmp';

        $kazerId = $this->getContainer()->getParameter('kazer_id');
        $sources = "http://www.kazer.org/tvguide.xml?u=" . $kazerId;

        $fs = new Filesystem();

        //si le repertoire tmp n'existe pas on le creer
        if (!$fs->exists('tmp/')) {
            $fs->mkdir('tmp/', 0700);
        }

        //si le fichier temporaite n'existe pas on le creer
        if (!$fs->exists($localPath)) {
            $output->writeln("copy 0 ");
            $this->curlPlus($localPath, $sources);
        }

        //si le fichier temporaite existe on regarde l'anciennete du fichier
        if ($fs->exists($localPath)) {

            $diff = date_diff(new \DateTime(), new \DateTime(date("Y-m-d H:i:s", filemtime($localPath))), true);
            $output->writeln("-> " . $diff->d);

            //si le fichier à plus d'un jour
            if ($diff->d >= '4') {
                $output->writeln("copy");
                $this->curlPlus($localPath, $sources);
            }
        }


        $this->lecteurXml($localPath, $output);


        //change la db pour la semaine

    }

}