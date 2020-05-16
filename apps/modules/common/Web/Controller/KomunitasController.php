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
        $this->photo_default = "default.png";
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

        if($tergabung !=null && $tergabung->role ==1){
            $permintaan = $this->modelsManager->createBuilder()
                            -> addFrom(Keanggotaan::class)
                            -> where("id_komunitas = :id:")
                            -> andWhere("verified = 0")
                            -> getQuery() 
                            -> execute(['id' => $id_komunitas]);
            $this->view->setVar('permintaan', $permintaan);
        }


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
        
        $this->response->redirect('/komunitas/lihat/'.$this->request->getPost('id_komunitas'))->send();

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
            if($komunitas->create() == true){
                if($this->request->hasFiles('photo')){
                    $file = $this->request->getUploadedFiles('photo')[0];
                    $filename = $komunitas->id . "." .$file->getExtension();
                    $target_file = $this->data_path . $filename;
                    $file->moveTo($target_file);
                }
                else{
                    $filename = $this->photo_default;
                }
                $komunitas->photo_path = $filename;
                $keanggotaan = new Keanggotaan();
                $keanggotaan->id_user = $this->session->get('auth')['username'];
                $keanggotaan->id_komunitas = $komunitas->id;
                $keanggotaan->verified  = 1;
                $keanggotaan->role = 1; // admin
                $keanggotaan->create();
                $form->clear();
                $this->view->setVar('form', $form);
                $komunitas->update();
                $this->flash->setImplicitFlush(false)
                    ->success('Komunitas berhasil dibuat!');
                    
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

    public function verifikasiAction(){
        if (!$this->request->isPost()){
            return (new Response())->redirect($_SERVER['HTTP_REFERER']);
        }
        $id_komunitas   = $_POST['id_komunitas'];
        $id_user        = $_POST['id_user'];
        $keanggotaan = Keanggotaan::findFirst([
            'id_user = :id_user: and id_komunitas = :id_komunitas:',
            'bind' => [ 'id_user' => $id_user, 'id_komunitas' => $id_komunitas]
        ]);

        if ($keanggotaan){
            if(array_key_exists('terima', $_POST)){ // terima
                $keanggotaan->verified = 1;
                $keanggotaan->tgl_bergabung = date('Y/M/d h:m:s', strtotime("now"));
                if($keanggotaan->update()){
                    $this->flash->setImplicitFlush(False)->success('Sukses: Menerima '.$id_user);
                }
                else{
                    $this->flash->setImplicitFlush(False)->error('Gagal: Menerima '.$id_user);
                }
            }
            else{
                if($keanggotaan->delete()){
                    $this->flash->setImplicitFlush(False)->success('Sukses: Menolak '.$id_user);
                }
                else{
                    $this->flash->setImplicitFlush(False)->error('Gagal: Menolak '.$id_user);
                }
            }
        }

        (new Response())->redirect('/komunitas/lihat/'.$id_komunitas)->send();

    }

    public function anggotaAction($id_komunitas){
        if(!$this->session->has('auth')){
            (new Response())->redirect('/komunitas/lihat/'. $id_komunitas)->send();
        }
        $anggota = $this->modelsManager->createBuilder()
                                    -> addFrom(Keanggotaan::class)
                                    -> where("id_komunitas = :id_komunitas:")
                                    -> orderBy("id_user")
                                    -> getQuery() 
                                    -> execute(['id_komunitas' => (int)($id_komunitas)]);
        
        $this->view->setVar('anggota', $anggota);
    }
      
    public function editAction($id_komunitas){
        $komunitas = Komunitas::findFirst([
            'id=:id_komunitas:', 'bind'=>['id_komunitas'=>$id_komunitas]
            ]);
        $form = new KomunitasForm($komunitas);
        $this->view->setVar('form', $form);
        $this->view->setVar('id_komunitas', (int)$id_komunitas);
    }

    public function onsimpanAction($id_komunitas){
        $form = new KomunitasForm();
        if($form->isValid($_POST)){
            $komunitas = Komunitas::findFirst(['id=:id:', 'bind'=>['id'=>(int)$id_komunitas]]);
            $komunitas->nama_komunitas = $_POST['nama_komunitas'];
            $komunitas->alamat = $_POST['alamat'];
            $komunitas->kategori = $_POST['kategori'];
            $komunitas->deskripsi = $_POST['deskripsi'];
           
            if($komunitas->update() == true){
                $form->clear();
                $this->view->setVar('form', $form);
                $this->flash->setImplicitFlush(false)
                    ->success('Komunitas berhasil diubah.');
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

    public function changephotoAction(){
        $id_komunitas = $_POST['id_komunitas'];
        $komunitas = Komunitas::findFirst([
            'id=:id_komunitas:', 'bind'=>['id_komunitas'=>$id_komunitas]
        ]);

        if($this->request->hasFiles('photo')){
            $file = $this->request->getUploadedFiles('photo')[0];
            $filename = $komunitas->id . "." .$file->getExtension();
            $target_file = $this->data_path . $filename;
            $file->moveTo($target_file);
            $komunitas->photo_path = $filename;
            $komunitas->update();
        }
        $this->response->redirect('/komunitas/lihat/'.$id_komunitas)->send();
    }

    public function deletephotoAction(){
        $id_komunitas = $_POST['id_komunitas'];
        $komunitas = Komunitas::findFirst([
            'id=:id_komunitas:', 'bind'=>['id_komunitas'=>$id_komunitas]
        ]);

        $filename = $komunitas->photo_path;
        $target_file = $this->data_path . $filename;
        unlink($target_file); //delete
        $komunitas->photo_path = $this->photo_default;
        $komunitas->update();

        $this->response->redirect('/komunitas/lihat/'.$id_komunitas)->send();
    }
}