<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;

use Gelarapps\Common\Web\Model\Komunitas;
use Gelarapps\Common\Web\Form\KomunitasForm;

/**
 * @property Di   $di
 * @property View $view
 */
class KomunitasController extends Controller
{
    public function indexAction(){
        echo "index komunitas";
    }

    public function lihatAction(){

    }

    public function listAction(){

    }

    public function buatAction(){
        $form = new KomunitasForm();
        $this->view->setVar('form', $form);
    }

    public function onbuatAction(){
        $form = new KomunitasForm();
        if($form->isValid($_POST)){
            $nama_komunitas = $this->request->getPost('nama');
            $alamat   = $this->request->getPost('username');
            $deskripsi      = $this->request->getPost('email');
            $photo   = $this->security->hash($this->request->getPost('password'));

            $user = new Users();
            $user->nama     = $nama;
            $user->password = $password;
            $user->username = $username;
            $user->email    = $email;

            if($user->create() == true){
                $this->flash->setImplicitFlush(false)->success('Pendaftaran berhasil!');
                $this->view->setVar('form', null);
            }
            else{
                foreach ($user->getMessages() as $message) {
                    $this->flash->setImplicitFlush(false)->error('Terjadi kesalahan. Silahkan coba lagi.');
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
        return $this->dispatcher->forward(['action' => 'signup']);
    }
      
}