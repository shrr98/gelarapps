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
        $query = new Query(
            'SELECT * FROM ' . Users::class,
            $this->di
        );

        $users = $query->execute();
        
        $this->view->setVar('users',  $users);
    }
}