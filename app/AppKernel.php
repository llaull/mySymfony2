<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

// setting the default time zone for 1and1 server
date_default_timezone_set('Europe/Paris');

class AppKernel extends Kernel
{


    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Commun\UserBundle\CommunUserBundle(),
            new Debril\RssAtomBundle\DebrilRssAtomBundle(),
            new CarnetsBundle\CarnetsBundle(),
            new TclBundle\TclBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new ProgrammeTvBundle\ProgrammeTvBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new FM\ElfinderBundle\FMElfinderBundle(),
            new Domotique\bundle\TaskBundle\DomotiquebundleTaskBundle(),
            new Domotique\bundle\ModuleBundle\DomotiquebundleModuleBundle(),
            new Ras\Bundle\FlashAlertBundle\RasFlashAlertBundle(),
            new Commun\ToDoBundle\CommunToDoBundle(),
            new Domotique\bundle\FrontBundle\DomotiquebundleFrontBundle(),
            new CarnetApp\BlogBundle\CarnetAppBlogBundle(),
            new CarnetApp\CarnetBundle\CarnetAppCarnetBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();

        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
