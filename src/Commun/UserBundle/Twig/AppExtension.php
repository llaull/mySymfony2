<?php
namespace Commun\UserBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('menuActive', array($this, 'testRoute')),
        );
    }

    public function testRoute($name, $route)
    {
//        $r = explode(",", $name);
        $rb = explode("\\", $route);
//var_dump($rb[0]);
//        if (in_array($rb[0], $r)) {
        if ($rb[0] == $name) {
            $out = "active";
        } else {
            $out = "".$rb[0];
        }

        return $out;
    }

    public function getName()
    {
        return 'app_extension';
    }
}