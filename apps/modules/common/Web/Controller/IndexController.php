<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;

use Gelarapps\Common\Web\Model\Users;
use Gelarapps\Common\Web\Model\Komunitas;
use Gelarapps\Common\Web\Model\Kategori;
use Gelarapps\Common\Web\Model\Pagelaran;

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
        $komunitas = $this->modelsManager->createBuilder()
                        -> addFrom(Komunitas::class, 'ko')
                        -> columns("ko.id, ko.nama_komunitas, ko.kategori as id_kat, ka.kategori")
                        -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                        -> limit(5)
                        -> orderBy("ko.nama_komunitas")
                        -> getQuery() 
                        -> execute();
        $pagelaran = $this->modelsManager->createBuilder()
                        -> addFrom(Pagelaran::class, 'pa')
                        -> columns("pa.*, ko.nama_komunitas as nama_komunitas, ka.id as id_kat, ka.kategori as nama_kategori")
                        -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                        -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                        -> orderBy("pa.waktu_mulai")
                        -> limit(5)
                        -> getQuery() 
                        -> execute();
        $this->view->setVar('komunitases', $komunitas);
        $this->view->setVar('pagelarans', $pagelaran);
    }

    public function userAction(){
        $komunitas = $this->modelsManager->createBuilder()
                        -> addFrom(Komunitas::class, 'ko')
                        -> columns("ko.id, ko.nama_komunitas, ko.kategori as id_kat, ka.kategori")
                        -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                        -> limit(5)
                        -> orderBy("ko.nama_komunitas")
                        -> getQuery() 
                        -> execute();
        $pagelaran = $this->modelsManager->createBuilder()
                        -> addFrom(Pagelaran::class, 'pa')
                        -> columns("pa.*, ko.nama_komunitas as nama_komunitas, ka.id as id_kat, ka.kategori as nama_kategori")
                        -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                        -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                        -> orderBy("pa.waktu_mulai")
                        -> limit(5)
                        -> getQuery() 
                        -> execute();
        $this->view->setVar('komunitases', $komunitas);
        $this->view->setVar('pagelarans', $pagelaran);
    }
}