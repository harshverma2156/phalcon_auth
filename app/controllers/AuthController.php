<?php

use Phalcon\Mvc\Controller;

class AuthController extends Controller
{
    public function loginAction()
    {
        if ($this->request->isPost()) {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                'conditions' => 'email = :email:',
                'bind' => [
                    'email' => $email
                ]
            ]);

            if ($user && password_verify($password, $user->password)) {

                $_SESSION['user'] = $user->email;

                echo 'Login Successful';
            } else {
                echo 'Invalid Email or Password';
            }
        }
    }

    public function registerAction()
    {
        if ($this->request->isPost()) {

            $user = new Users();

            $user->name = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            $user->password = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );

            if ($user->save()) {
                echo 'Registration Successful';
            } else {
                echo 'Registration Failed';
            }
        }
    }
}