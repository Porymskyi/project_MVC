<?php

namespace App\Controller;

class MainController {
    public function indexAction(){
        echo  __CLASS__ . '::'. __METHOD__;
    }

    public function veiwAction() {
        return "Hello world Acton";
    }
}