<?php
namespace TclBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

 
class CurlCurling {
    

    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function curling($url,$proxy=false)
    {
        $proxyAdress = $this->container->getParameter('ext_proxy');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($proxy == true){
            curl_setopt($ch, CURLOPT_PROXY, $proxyAdress);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
 
}