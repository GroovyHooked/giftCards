<?php

namespace App\Controllers;

use App\Models\UserModel;
/* Used to create expiration date for the forgotPass method  */
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\Request;
/********************
 *   SOMMAIRE
 *  method index            l26
 *  method setUserSession   l55
 *  method forgotPass       l69
 *  method register         l115
 *  method resetpass        l153
 *  method logout           l214
 *
 * */

class Controller extends BaseController
{
    public function __construct()
    {
        helper(['html', 'form']);
    }

    public function index()
    {
        helper(['html', 'form']);
        $data['title'] = "Accueil";
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[mail, password]',
            ];
            $errors = [
                'password' => [
                    'validateUser' => 'L\'identifiant et le mot de passe ne sont pas corrects'
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;

            } else {
                $bdd = new UserModel();
                $user = $bdd->getUserData($this->request->getVar('email'));
                $this->setUserSession($user);
                return redirect()->to('dashboard');
            }
        }
        echo view('templates/header', $data);
        echo view('site/login', $data);
        echo view('templates/footer');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'company' => $user['company'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }

    public function forgotPass()
    {
        helper('date');
        $data['title'] = "Mot de passe oubli??";

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email'
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $user_email = $this->request->getVar('email');
                $bdd = new UserModel();
                $exist = $bdd->checkIfUserExist($user_email);
                if (!$exist) {
                    $session = session();
                    $session->setFlashdata('fail', 'Vous n\'etes pas inscrit');
                    return redirect()->to('forgotPass');
                } else {
                    $session = session();
                    $session->setFlashdata('successRest', 'Mail de r??initialisation envoy??');
                    $token = uniqid();
                    $time = Time::parse('now + 10 minute', 'Europe/Paris');
                    $token_exp = $time->toDateTimeString();
                    $bdd = new UserModel();
                    $user_email = $this->request->getVar('email');
                    $bdd->insertTokenData($token, $token_exp, $user_email);
                    /* Class called at the beginning of the file */
                    $email = \Config\Services::email();
                    $email->setFrom('thomascariot@gmail.com', 'Thomas Cariot');
                    $email->setTo($user_email);
                    $email->setSubject('R??initialisation de mot de passe');
                    $email->setMessage('Rendez vous ?? cette adresse pour la r??initialisation de votre mot de passe. http://gift-cards.ddns.net/resetpass?token=' . $token);
                    $email->send();

                    echo view('templates/header', $data);
                    echo view('site/newpass', $data);
                    echo view('templates/footer');
                }
            }
        }
        echo view('templates/header', $data);
        echo view('site/newpass', $data);
        echo view('templates/footer');
    }

    public function register()
    {
        $data['title'] = "Inscription";

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'company' => 'required|min_length[3]|max_length[50]',
                'lastname' => 'required|alpha|min_length[3]|max_length[20]',
                'firstname' => 'required|alpha|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|alpha_numeric_punct|min_length[8]|max_length[255]',
                'password2' => 'matches[password]'
            ];
            if (!$this->validate($rules)) {

                $data['validation'] = $this->validator;

            } else {
                $bdd = new UserModel();
                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'company' => $this->request->getVar('company')
                ];
                $bdd->save($newData);

                $session = session();
                $session->setFlashdata('successRegist', 'Inscription r??ussie');
                return redirect()->to('index');
            }
        }
        echo view('templates/header', $data);
        echo view('site/register');
        echo view('templates/footer');
    }

    public function resetpass()
    {
        /* Token recovery in URL */
        $request = \Config\Services::request();
        $token = $request->getGet();
        $data['token'] = $token;
        $data['title'] = "R??initialisation du mot de passe";

        $bdd = new UserModel();
        $user = $bdd->getUserDataFromToken($token);
        $this->setUserSession($user);
        $tokenExist = $bdd->verifyTokenExp($token);

        $timeGen = Time::parse('now', 'Europe/Paris');
        $time = $timeGen->toDateTimeString();
        $tokenTime = $bdd->getTimeToken($token);

        if ($tokenExist && $tokenTime > $time) {
            $data = [
                'title' => "R??initialisation du mot de passe",
                'token' => $token,
                'tokenExist' => $tokenExist,
                'tokenTime' => $tokenTime
            ];

            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'password' => 'required|min_length[8]|max_length[255]',
                    'passwordConfirm' => 'matches[password]'
                ];
                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $bdd = new UserModel();
                    $user = $bdd->getUserDataFromToken($token);
                    $this->setUserSession($user);
                    $userMail = session()->get('email');
                    $password = $this->request->getVar('password');
                    $bdd->updatePassword($password, $userMail);

                    $session = session();
                    $session->setFlashdata('successModif', 'Mot de passe modifi??');
                    return redirect()->to('index');
                }
            }
            echo view('templates/header', $data);
            echo view('site/resetpass');
            echo view('templates/footer');

        } else {
            $data = [
                'messageAlert' => 'Le lien de r??initialisation n\'est plus actif, veuillez red??marrer la proc??dure de r??initialisation.',
                'title' => "R??initialisation du mot de passe"
            ];
            echo view('templates/header', $data);
            echo view('site/resetpass');
            echo view('templates/footer');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('index');
    }
}