<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 05/10/2015
 * Time: 09:36
 */

namespace TclBundle\Services;


class Outils {

    public function dateConvertor($date, $fr = true)
    {

        if ($fr == true) {
            date_default_timezone_set("Europe/Paris");
        } else {
            date_default_timezone_set("UTC");
        }
        $date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));

        return new \DateTime($date);
    }

}