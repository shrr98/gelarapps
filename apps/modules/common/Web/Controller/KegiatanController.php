<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use Gelarapps\Common\Web\Model\Kegiatan;
use Gelarapps\Common\Web\Model\Komunitas;
use Gelarapps\Common\Web\Model\Komentar;
use Gelarapps\Common\Web\Model\Notifikasi;
use Gelarapps\Common\Web\Model\Notif_Konten;
use Gelarapps\Common\Web\Form\KegiatanForm;

/**
 * @property Di   $di
 * @property View $view
 */

class KegiatanController extends Controller
{
    public function initialize(){

    }

    public function lihatAction($id_kegiatan){
        if(!$this->session->has('auth')){
            $this->response->redirect('/error/login')->send();
        }
        try{
            $item = $this->modelsManager->createBuilder()
                                        -> from(Kegiatan::class)
                                        -> where("id = :id:")
                                        -> getQuery() -> execute(['id' => $id_kegiatan]);
            $komentar = $this->modelsManager-> createBuilder()
                                            -> from(Komentar::class)
                                            -> where("id_kegiatan = :id:")
                                            -> getQuery() -> execute(['id' => $id_kegiatan]);
            $komunitas = Komunitas::findFirst($id_komunitas);
            $this->view->setVar('item', $item[0]);
            $this->view->setVar('komentar', $komentar);
            $this->view->setVar('komunitas', $komunitas);
                                        
        }
        catch(Exception $e){
            (new Response())->redirect('/error/notfound')->send();
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    }

    public function listAction($id_komunitas){
        if(!$this->session->has('auth')){
            $this->response->redirect('/error/login')->send();
        }
        $items = Kegiatan::find([
            'id_komunitas=:id_komunitas:',
            'bind'=> ['id_komunitas' => $id_komunitas]
        ]);
        $komunitas = Komunitas::findFirst($id_komunitas);

        $this->view->setVar('items', $items);
        $this->view->setVar('komunitas', $komunitas);
    }


    public function buatAction($id_komunitas){
        $form = new KegiatanForm();
        $this->view->setVar('form', $form);
        $this->view->setVar('id_komunitas', $id_komunitas);
    }

    
    public function onbuatAction($id_komunitas){
        $form = new KegiatanForm();
        if($form->isValid($_POST)){
            $kegiatan = new Kegiatan();
            $kegiatan->assign($_POST);
            $kegiatan->id_komunitas = $id_komunitas;
            $kegiatan->creator = $this->session->get('auth')['username'];
            if($kegiatan->create() == true){
                $form->clear();
                $this->view->setVar('form', $form);
                $this->flash->setImplicitFlush(false)
                    ->success('Kegiatan berhasil dibuat.');
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

    public function editAction($id_kegiatan){
        $kegiatan = Kegiatan::findFirst([
            'id=:id_kegiatan:', 'bind'=>['id_kegiatan'=>$id_kegiatan]
            ]);
        $form = new KegiatanForm($kegiatan);
        $this->view->setVar('form', $form);
        $this->view->setVar('id_kegiatan', (int)$id_kegiatan);
    }

    public function onsimpanAction($id_kegiatan){
        $form = new KegiatanForm();
        if($form->isValid($_POST)){
            $kegiatan = Kegiatan::findFirst(['id=:id:', 'bind'=>['id'=>(int)$id_kegiatan]]);
            $kegiatan->judul = $_POST['judul'];
            $kegiatan->tempat = $_POST['tempat'];
            $kegiatan->waktu_mulai = $_POST['waktu_mulai'];
            $kegiatan->waktu_selesai = $_POST['waktu_selesai'];
            $kegiatan->deskripsi = $_POST['deskripsi'];
            if($kegiatan->update() == true){
                $form->clear();
                $this->view->setVar('form', $form);
                $this->flash->setImplicitFlush(false)
                    ->success('Kegiatan berhasil diubah.');
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
        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $kegiatan = Kegiatan::findFirst(
            [
                'id=:id_kegiatan: and creator=:username:',
                'bind' => [ 'id_kegiatan' => $id_kegiatan, 'username'=> $this->session->get('auth')['username'] ]
            ]
            );
        if($kegiatan){
            if($kegiatan->delete())
            $this->flash->setImplicitFlush(false)
                ->success('Kegiatan berhasil dihapus.');
        }
        $this->response->redirect('/kegiatan/list')->send();
    }

    public function komentarAction(){
        if(!$this->session->has('auth')){
            $this->response->redirect('/error/login')->send();
        }
        $komentar = new Komentar();
        $komentar->assign($_POST);
        $komentar->author = $this->session->get('auth')['username'];
        if($komentar->save()){
            $this->flash->setImplicitFlush(false)
                ->success('Komentar berhasil dikirim.');
        }
        else{
            $this->flash->setImplicitFlush(false)
                ->error('Terjadi kesalahan saat mengirim komentar.');
        }

        $this->response->redirect('/kegiatan/lihat/'.$_POST['id_kegiatan'])->send();
    }
}