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
        if(!$this->session->has('auth')){
            (new Response())->redirect('/pagelaran/list/semua')->send();
        }    
    }

    public function lihatAction($id_pagelaran){
        try{
            $item = $this->modelsManager->createBuilder()
                                        -> addFrom(Pagelaran::class, 'pa')
                                        -> columns("pa.*, ko.nama_komunitas as nama_komunitas, ka.id as id_kat, ka.kategori as nama_kategori")
                                        -> where("pa.id = :id:")
                                        -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                                        -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                        -> getQuery() -> execute(['id' => $id_pagelaran]);
            $this->view->setVar('item', $item[0]);
                                        
        }
        catch(Exception $e){
            (new Response())->redirect('/error/notFound')->send();
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    }

    public function listAction($mode){
        if($mode=='saya'){
            $items = $this->listSaya();
        }
        else if($mode=='semua'){
            $items = $this->listSemua();
        }
        else{
            $items = $this->listKomunitas($mode);
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
                                    -> where("pa.creator = :id_user:")
                                    -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                    -> orderBy("pa.waktu_mulai")
                                    -> getQuery() 
                                    -> execute(['id_user' => $this->session->get('auth')['username']]);
        
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

    public function listKomunitas($id_komunitas){
        if(!$this->session->has('auth')){
            (new Response())->redirect('/error/forbidden')->send();
        }
        $items = $this->modelsManager->createBuilder()
                                    -> addFrom(Pagelaran::class, 'pa')
                                    -> columns("pa.*, ko.nama_komunitas as nama_komunitas, ka.id as id_kat, ka.kategori as nama_kategori")
                                    -> where("pa.komunitas = :id_komunitas:")
                                    -> join(Komunitas::class, 'pa.komunitas = ko.id', 'ko')
                                    -> join(Kategori::class, 'ko.kategori=ka.id', 'ka')
                                    -> orderBy("pa.waktu_mulai")
                                    -> getQuery() 
                                    -> execute(['id_komunitas' => $id_komunitas]);
        
        return $items;
    }

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

    public function editAction($id_pagelaran){
        $pagelaran = Pagelaran::findFirst([
            'id=:id_pagelaran:', 'bind'=>['id_pagelaran'=>$id_pagelaran]
            ]);
        $form = new PagelaranForm($pagelaran);
        $this->view->setVar('form', $form);
        $this->view->setVar('id_pagelaran', (int)$id_pagelaran);
    }

    public function onsimpanAction($id_pagelaran){
        $form = new PagelaranForm();
        if($form->isValid($_POST)){
            $pagelaran = Pagelaran::findFirst(['id=:id:', 'bind'=>['id'=>(int)$id_pagelaran]]);
            $pagelaran->judul = $_POST['judul'];
            $pagelaran->tempat = $_POST['tempat'];
            $pagelaran->waktu_mulai = $_POST['waktu_mulai'];
            $pagelaran->waktu_selesai = $_POST['waktu_selesai'];
            $pagelaran->deskripsi = $_POST['deskripsi'];
            if($this->request->hasFiles('photo')){
                    $file = $this->request->getUploadedFiles('photo')[0];
                    $filename = $pagelaran->id . "." .$file->getExtension();
                    $target_file = $this->data_path . $filename;
                    $file->moveTo($target_file);
                    $pagelaran->photo_path = $filename;
            }
            if($pagelaran->update() == true){
                $form->clear();
                $this->view->setVar('form', $form);
                $this->flash->setImplicitFlush(false)
                    ->success('Pagelaran berhasil diubah.');
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

        return $this->dispatcher->forward(['action' => 'edit']);
    }

    public function hapusAction(){
        $id_pagelaran = $this->request->getPost('id_pagelaran');
        $pagelaran = Pagelaran::findFirst(
            [
                'id=:id_pagelaran: and creator=:username:',
                'bind' => [ 'id_pagelaran' => $id_pagelaran, 'username'=> $this->session->get('auth')['username'] ]
            ]
            );
        echo $id_pagelaran;
        if($pagelaran){
            echo 'ada';
            $photo_file = $this->data_path . $pagelaran->photo_path;
            unlink($photo_file);
            if($pagelaran->delete())
            $this->flash->setImplicitFlush(false)
                ->success('Pagelaran berhasil dihapus.');
        }
        $this->response->redirect('/pagelaran/list/saya')->send();
    }
      
}