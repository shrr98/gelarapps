<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use Gelarapps\Common\Web\Model\Pagelaran;
use Gelarapps\Common\Web\Model\Komunitas;
use Gelarapps\Common\Web\Model\Kategori;
use Gelarapps\Common\Web\Form\PagelaranForm;

/**
 * @property Di   $di
 * @property View $view
 */
class PagelaranController extends Controller
{
    public function initialize(){
        $this->data_path = BASE_PATH . "/public/data/pagelaran/";
    }

    public function indexAction(){
    
    }

    // public function lihatAction($id_pagelaran){
    //     if(!$this->session->has('auth')){
    //         (new Response())->redirect('/error/login')->send();
    //     }

    //     $item = $this->modelsManager->createBuilder()
    //                                 -> addFrom(Komunitas::class, 'ko')
    //                                 -> columns("ko.*, ka.kategori as nama_kategori")
    //                                 -> where("ko.id = :id:")
    //                                 -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
    //                                 -> orderBy("ko.nama_komunitas")
    //                                 -> getQuery() -> execute(['id' => $id_komunitas]);

    //     $this->view->setVar('item', $item[0]);
    //     $this->view->setVar('tergabung', $tergabung);
    // }

    public function listAction($mode){
        if($mode=='saya'){
            $items = $this->listSaya();
        }
        else{
            $items = $this->listSemua();
        }
        $this->view->setVar('items', $items);
    }

    public function listSaya(){
        if(!$this->session->has('auth')){
            (new Response())->redirect('/pagelaran/list/semua')->send();
        }
        $items = $this->modelsManager->createBuilder()
                                    -> addFrom(Pagelaran::class, 'pa')
                                    -> columns("pa.*, ko.nama_komunitas as nama_komunitas, ka.id as id_kat, ka.kategori as nama_kategori")
                                    -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                    -> orderBy("pa.waktu_mulai")
                                    -> getQuery() 
                                    -> execute();
        
        return $items;
    }

    public function listSemua(){
        $items = $this->modelsManager->createBuilder()
                                    -> addFrom(Pagelaran::class, 'pa')
                                    -> columns("pa.*, ko.nama_komunitas as nama_komunitas, ka.id as id_kat, ka.kategori as nama_kategori")
                                    -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                    -> orderBy("pa.waktu_mulai")
                                    -> getQuery() 
                                    -> execute();
        return $items;
    }

    // public function cariAction(){
    //     $items = Kategori::find();
    //     $this->view->setVar('items', $items);
    // }


    // public function kategoriAction($id_kategori){
    //     $kategori = Kategori::findFirst((int)$id_kategori)->kategori;
    //     $items = $this->modelsManager->createBuilder()
    //                 -> addFrom(Komunitas::class, 'ko')
    //                 -> columns("ko.id, ko.nama_komunitas")
    //                 -> where('ko.kategori = :id:')
    //                 -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
    //                 -> orderBy("ko.nama_komunitas")
    //                 -> getQuery() 
    //                 -> execute(['id' => (int)$id_kategori]);
    //     $this->view->setVar('items', $items);
    //     $this->view->setVar('kategori', $kategori);
    // }

    // public function gabungAction(){
    //     if(!$this->request->isPost()){ // method = GET
    //         (new Response())->redirect()->send();
    //     }

    //     $keanggotaan = new Keanggotaan();
    //     $keanggotaan->id_user = $this->session->get('auth')['username'];
    //     $keanggotaan->id_komunitas = $this->request->getPost('id_komunitas');
    //     $keanggotaan->role = 0;
    //     $keanggotaan->verified = 0;

    //     if($keanggotaan->create()){
    //         $this->flash->success('Berhasil bergabung!');
    //     }
        
    //     $this->response->redirect('/komunitas/lihat/'.$this->request->getPost('id_komunitas'));

    // }

    public function buatAction($id_komunitas){
        $form = new PagelaranForm();
        $this->view->setVar('form', $form);
        $this->view->setVar('id_komunitas', $id_komunitas);
    }

    public function onbuatAction($id_komunitas){
        $form = new PagelaranForm();
        if($form->isValid($_POST)){
            if($this->request->hasFiles('photo')){
                $pagelaran = new Pagelaran();
                $pagelaran->assign($_POST);
                $pagelaran->komunitas = $id_komunitas;
                $pagelaran->creator = $this->session->get('auth')['username'];
                if($pagelaran->create() == true){
                    $file = $this->request->getUploadedFiles('photo')[0];
                    $filename = $pagelaran->id . "." .$file->getExtension();
                    $target_file = $this->data_path . $filename;
                    $file->moveTo($target_file);
                    $pagelaran->photo_path = $filename;
                    $pagelaran->update();
                    $form->clear();
                    $this->view->setVar('form', $form);
                    $this->flash->setImplicitFlush(false)
                        ->success('Pagelaran berhasil dibuat.');
                }
                else{
                        $this->flash->setImplicitFlush(false)
                            ->error('Terjadi kesalahan. Silahkan coba lagi.');
                }
                
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