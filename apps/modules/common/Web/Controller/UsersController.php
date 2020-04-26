<?php

namespace Gelarapps\Common\Web\Controller;

use Phalcon\Di;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\View;
use Phalcon\Http\Response;

use Gelarapps\Common\Web\Form\LoginForm;
use Gelarapps\Common\Web\Form\SignupForm;
use Gelarapps\Common\Web\Model\Users;



/**
 * @property Di   $di
 * @property View $view
 */
class UsersController extends Controller
{
    public function loginAction(){
        if ($this->session->has('auth')){
            (new Response())->redirect('/beranda')->send();
        }
        $form = new LoginForm();
        $this->view->setVar('form', $form);
    }

    public function signupAction(){
        $form = new SignupForm();
        $this->view->setVar('form', $form);
    }

    public function onloginAction(){
        $form = new LoginForm();
        if($form->isValid($_POST)){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $remember = $this->request->getPost('remember');
            $user = Users::findFirst("username='$username'");
            if ($user){
                if($this->security->checkHash($password, $user->password))
                {
                    $this->session->set(
                        'auth',
                        [
                            'username' => $user->username,
                            'remember' => $remember,
                        ]
                    );

                    //////////////// COOKIES /////////////////////////
                    if($remember=="1"){
                        $this->cookies->set(
                            'remember-username',
                            $username,
                            time() + 7 * 86400
                        );
        
                        $this->cookies->set(
                            'remember-password',
                            $password,
                            time() + 7 * 86400
                        );
                    }
                    (new Response())->redirect('/beranda')->send();
                }
                else{
                    $msg = 'Username dan Password salah.';
                }
            }
            else{
                $msg = 'Username dan Password salah.';
            }
        }
        else{
            $msg = '';
            foreach($form->getMessages() as $m){
                $msg = $msg . $m . ' ';
            }
        }
        $this->flash->setImplicitFlush(false)->error( $msg);
        $this->view->setVar('msg', 'ini message');
        $this->dispatcher->forward(['controller'=>'users', 'action'=> 'login']);
    }

    public function onsignupAction(){
        $form = new SignupForm();
        if($form->isValid($_POST)){
            $nama       = $this->request->getPost('nama');
            $username   = $this->request->getPost('username');
            $email      = $this->request->getPost('email');
            $password   = $this->security->hash($this->request->getPost('password'));

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

    public function logoutAction(){
        $this->session->destroy();
        (new Response())->redirect()->send();
    }
}