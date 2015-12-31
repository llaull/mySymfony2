<?php


namespace ProgrammeTvBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KazerMailCommand extends ContainerAwareCommand
{


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


        $mailPerso = $this->getContainer()->getParameter('mon_mail');
        $message = \Swift_Message::newInstance();


        // cree si n'existe pas les fichiers image converti depuis bas64
        function base64_to_jpeg($base64_string, $output_file)
        {
            $path = 'tmp/image-chaines-mail/';

            if (!file_exists($path)) {
                mkdir($path, 0700);
            }

            if (!file_exists($path . $output_file)) {
                $ifp = fopen($path . $output_file, "wb");

                $data = explode(',', $base64_string);

                fwrite($ifp, base64_decode($data[1]));
                fclose($ifp);
            }

            return $path . $output_file;
        }


        // recréation du tableau chaine pour y inclure les images dans le mail
        // le CID
        //
        foreach ($channels as $value) {

            $channelsCorrect[$value->getIdKazer()]['name'] = $value->getName();

            if ($value->getImageB64() != "") {
                $channelsCorrect[$value->getIdKazer()]['imageB64'] =
                    $message->embed(\Swift_Image::fromPath(base64_to_jpeg($value->getImageB64(), $value->getIdKazer() . '.png')));
            } else {
                $channelsCorrect[$value->getIdKazer()]['imageB64'] = null;
            }
        }

        // cree le mail et l'envoie
        $message->setSubject('programme tv du ' . date("j F Y"))
            ->setFrom('Gargamail@llovem.eu')
            ->setTo($mailPerso)
            ->setCharset('UTF-8')
            ->setContentType('text/html')
            ->setBody($this->getContainer()->get('templating')->render('ProgrammeTvBundle:Email:default.html.twig',
                array('channels' => $channelsCorrect, 'programmes' => $programmes)));
        $this->getContainer()->get('mailer')->send($message);
    }

}
