<?php

namespace Domotique\bundle\FrontBundle\Services;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyCurlService {

    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getToUrl($url,$proxy=false)
    {
        $proxyAdress = $this->container->getParameter('ext_proxy');
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Host: domobox.llovem.eu';
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($proxy == true){
            curl_setopt($ch, CURLOPT_PROXY, $proxyAdress);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        die(var_dump($data));
        return $data;

    }
}