<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;

use Gelarapps\Common\Web\Model\Users;

/**
 * @property Di   $di
 * @property View $view
 */
class IndexController extends Controller
{
    public function indexAction(){

    }

    public function berandaAction(){
        if($this->session->has('auth')){
            $this->dispatcher->forward(['action'=>'user']);
        }
        else{
            $this->dispatcher->forward(['action'=>'guest']);
        }
    }

    public function guestAction(){
        echo "GUEST";
    }

    public function userAction(){
        echo "USER";
    }
}