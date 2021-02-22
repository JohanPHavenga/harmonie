<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('wts')) 
{
    function wts($seq = '', $die = false)
    {
        echo "<pre>";
        print_r($seq);
        echo "</pre>";
        if ($die) {
            die();
        }
    }
}

    