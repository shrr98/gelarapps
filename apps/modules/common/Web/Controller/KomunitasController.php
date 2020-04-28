<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use Gelarapps\Common\Web\Model\Komunitas;
use Gelarapps\Common\Web\Model\Kategori;
use Gelarapps\Common\Web\Model\Keanggotaan;
use Gelarapps\Common\Web\Form\KomunitasForm;

/**
 * @property Di   $di
 * @property View $view
 */
class KomunitasController extends Controller
{
    public function initialize(){
        $this->data_path = BASE_PATH . "/public/data/komunitas/";
    }
    public function indexAction(){
        echo "index komunitas";
    }

    public function lihatAction($id_komunitas){
        if(!$this->session->has('auth')){
            (new Response())->redirect('/error/login')->send();
        }

        $item = $this->modelsManager->createBuilder()
                                    -> addFrom(Komunitas::class, 'ko')
                                    -> columns("ko.*, ka.kategori as nama_kategori")
                                    -> where("ko.id = :id:")
                                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                    -> orderBy("ko.nama_komunitas")
                                    -> getQuery() -> execute(['id' => $id_komunitas]);

        $tergabung = Keanggotaan::findFirst(
            [
                'conditions' => 'id_user = :id_user: and id_komunitas=:komunitas:',
                'bind'       => [
                    'id_user' => $this->session->get('auth')['username'],
                    'komunitas' => $id_komunitas,
                ]
            ]
        );

        $this->view->setVar('item', $item[0]);
        $this->view->setVar('tergabung', $tergabung);
    }

    public function listAction($currentpage){
        if(!$this->session->has('auth')){
            (new Response())->redirect('/error/login')->send();
        }
        $items = $this->modelsManager->createBuilder()
                                    -> addFrom(Komunitas::class, 'ko')
                                    -> columns("ko.id, ko.nama_komunitas, ko.kategori as id_kat, ka.kategori")
                                    -> where("ko.id = ke.id_komunitas")
                                    -> andWhere("ke.id_user = :username:")
                                    -> join(Keanggotaan::class, 'ke.id_komunitas = ko.id', 'ke')
                                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                    -> orderBy("ko.nama_komunitas")
                                    -> getQuery() 
                                    -> execute(['username' => $this->session->get('auth')['username']]);
        $this->view->setVar('items', $items);
    

    }

    public function cariAction(){
        $items = Kategori::find();
        $this->view->setVar('items', $items);
    }


    public function kategoriAction($id_kategori){
        $kategori = Kategori::findFirst((int)$id_kategori)->kategori;
        $items = $this->modelsManager->createBuilder()
                    -> addFrom(Komunitas::class, 'ko')
                    -> columns("ko.id, ko.nama_komunitas")
                    -> where('ko.kategori = :id:')
                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                    -> orderBy("ko.nama_komunitas")
                    -> getQuery() 
                    -> execute(['id' => (int)$id_kategori]);
        $this->view->setVar('items', $items);
        $this->view->setVar('kategori', $kategori);
    }

    public function gabungAction(){
        if(!$this->request->isPost()){ // method = GET
            (new Response())->redirect()->send();
        }

        $keanggotaan = new Keanggotaan();
        $keanggotaan->id_user = $this->session->get('auth')['username'];
        $keanggotaan->id_komunitas = $this->request->getPost('id_komunitas');
        $keanggotaan->role = 0;
        $keanggotaan->verified = 0;

        if($keanggotaan->create()){
            $this->flash->success('Berhasil bergabung!');
        }
        
        $this->response->redirect('/komunitas/lihat/'.$this->request->getPost('id_komunitas'));

    }

    public function buatAction(){
        $form = new KomunitasForm();
        $this->view->setVar('form', $form);
    }

    public function onbuatAction(){
        $form = new KomunitasForm();
        if($form->isValid($_POST)){
            $komunitas = new Komunitas();
            $komunitas->assign($_POST);
            $komunitas->owner = $this->session->get('auth')['username'];
            $komunitas->photo = null;
            if($komunitas->create() == true){    
                $this->flash->setImplicitFlush(false)
                    ->success('Komunitas berhasil dibuat!');
                $keanggotaan = new Keanggotaan();
                $keanggotaan->id_user = $this->session->get('auth')['username'];
                $keanggotaan->id_komunitas = $komunitas->id;
                $keanggotaan->verified  = 1;
                $keanggotaan->role = 1; // admin
                $keanggotaan->create();
                $form->clear();
                $this->view->setVar('form', $form);
            }
            else{
                    $this->flash->setImplicitFlush(false)
                        ->error('Terjadi kesalahan. Silahkan coba lagi.');
            }
        }
        else{
            // form tidak valid
            $errmsg =[];
            foreach($form->getMessages() as $m){
                $errmsg[$m->getField()] = $m->getMessage();
            }
            $this->view->setVar('errmsg', $errmsg);
        }

        return $this->dispatcher->forward(['action' => 'buat']);
    }
      
}