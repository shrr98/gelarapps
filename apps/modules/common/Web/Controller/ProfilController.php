<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;
use Gelarapps\Common\Web\Model\Users;
use Gelarapps\Common\Web\Form\ProfilForm;
use Gelarapps\Common\Web\Form\PasswordForm;


/**
 * @property Di   $di
 * @property View $view
 */
class ProfilController extends Controller
{
    public function meAction(){
        if($this->session->has('auth')){
            $username = $this->session->get('auth')['username'];
            $profil = $this->getProfil($username);

            $profilForm = new ProfilForm($profil);
            $akunForm = new PasswordForm();
            
            $this->view->setVar('profil', $profil);
            $this->view->setVar('profilForm', $profilForm);
            $this->view->setVar('akunForm', $akunForm);
        }
    }

    public function lihatAction($username){
        if($this->session->has('auth') and $this->session->get('auth')['username']==$username){
            $this->response->redirect(['action'=>'me'])->send();
        }
        $profil = $this->getProfil($username);
        if(!$profil){
            $this->response->redirect('/error/notfound')->send();
        }
        $this->view->setVar('profil', $profil);
    }

    private function getProfil($username){
        $profil = Users::findFirst([
            'username=:username:', "bind"=>['username' => $username]
        ]);
        return $profil;
    }

    public function simpanAction(){
        $form = new ProfilForm();
        if($form->isValid($_POST)){
            $nama       = $this->request->getPost('nama');
            $status     = $this->request->getPost('status');

            $user = Users::findFirst([
                'username = :username:',
                'bind' => ['username'=>$this->session->get('auth')['username']]
            ]);
            $user->nama     = $nama;
            $user->status   = $status;


            if($user->update() == true){
                $this->flash->setImplicitFlush(false)->success('Pembaharuan profil berhasil!');
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
        return $this->dispatcher->forward(['action' => 'me']);
    }

    public function changephotoAction(){
        if(!$this->request->isPost())
        {
            return $this->response->redirect('/profil');
        }

        $username = $this->session->get('auth')['username'];
        $user = Users::findFirst(["username=:username:", 'bind'=>['username'=>$username]]);
        if($this->request->hasFiles('photo')){
            $file = file_get_contents($_FILES['photo']['tmp_name']);
            $enc_file = base64_encode($file);
            $user->photo = $enc_file;

            if($user->update()){
                $this->flash->setImplicitFlush(false)->success('Foto Profil berhasil diperbarui!');
            }

            else{
                $this->flash->setImplicitFlush(false)->success('Gagal memperbarui Foto Profil!');
            }
        }
        else{
            $this->flash->setImplicitFlush(false)->notice('Anda belum memilih foto.');
        }
        return $this->dispatcher->forward(['action' => 'me']);
    }

    public function changepasswordAction(){
        $form = new PasswordForm();
        if($form->isValid($_POST)){
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                'username = :username:',
                'bind' => ['username'=>$this->session->get('auth')['username']]
            ]);
            $user->password  = $this->security->hash($password);

            if($user->update() == true){
                $this->flash->setImplicitFlush(false)->success('Password berhasil diperbarui!');
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
        $form->clear();
        $this->view->setVar('akunForm', $form);
        return $this->dispatcher->forward(['action' => 'me']);
    }

}