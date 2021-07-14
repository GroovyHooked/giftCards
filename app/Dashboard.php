<?php

namespace App\Controllers;

use App\Models\Cards;
use App\Models\GiftedClient;
use App\Models\UserClient;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

class Dashboard extends BaseController
{
    public function __construct()
    {
        helper(['form', 'number', 'date', 'telegram']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        echo view('templates/header', $data);
        echo view('site/dashboard', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'création';
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'user_lastname' => 'required|min_length[3]|max_length[50]',
                'client_lastname' => 'required|min_length[3]|max_length[50]',
                'user_firstname' => 'required|min_length[3]|max_length[50]',
                'client_firstname' => 'required|min_length[3]|max_length[50]',
                'user_email' => 'required|valid_email',
                'client_email' => 'required|valid_email',
                'user_address' => 'required',
                'client_address' => 'required',
                'user_phone' => 'required|alpha_numeric_punct|min_length[8]|max_length[255]',
                'client_phone' => 'required|alpha_numeric_punct|min_length[8]|max_length[255]',
                'value' => 'required|numeric',
            ];
            if (!$this->validate($rules)) {

                $data['validation'] = $this->validator;
            } else {

                $qrcodeId = uniqid();
                $user_email = session()->get('email');
                $company = session()->get('company');

                $clientEmail = $this->request->getVar('user_email');
                $clientLastname = $this->request->getVar('user_lastname');
                $clientFirstname = $this->request->getVar('user_firstname');
                $clientAddress = $this->request->getVar('user_address');
                $clientPhone = $this->request->getVar('user_phone');
                $giftedEmail = $this->request->getVar('client_email');
                $giftedLastname = $this->request->getVar('client_lastname');
                $giftedFirstname = $this->request->getVar('client_firstname');
                $giftedAddress = $this->request->getVar('client_address');
                $giftedPhone = $this->request->getVar('client_phone');
                $value = $this->request->getVar('value');
                $status = 'N';
                $isSent = 0;

                $qrCode = new QrCode('http://projetcertification.ddns.net/codeqr/' . $qrcodeId /*.' Carte cadeau de Mr ou Mme ' . $giftedLastname . ' ' . $giftedFirstname . ', d\'une valeur de ' . $value . ' €. L\'identifiant de cette carte cadeau est le: ' . $qrcodeId*/);
                $qrCode->setSize(300);
                $qrCode->setMargin(10);
                $qrCode->writeFile('qrcode/' . $qrcodeId . '.png');
                $qrCodeUrl = 'qrcode/' . $qrcodeId . '.png';

                $clientData = [
                    'lastname' => $clientLastname,
                    'firstname' => $clientFirstname,
                    'email' => $clientEmail,
                    'address' => $clientAddress,
                    'phone' => $clientPhone,
                    'user_email' => $user_email
                ];
                $bd_client = new UserClient();
                $bd_client->insert($clientData);

                $giftedData = [
                    'lastname' => $giftedLastname,
                    'firstname' => $giftedFirstname,
                    'email' => $giftedEmail,
                    'address' => $giftedAddress,
                    'phone' => $giftedPhone,
                    'user_email' => $user_email,
                    'client_email' => $clientEmail
                ];
                $bd_gifted = new GiftedClient();
                $bd_gifted->insert($giftedData);

                $cardData = [
                    'value' => $value,
                    'card_uniqid' => $qrcodeId,
                    'card_url' => $qrCodeUrl,
                    'user_email' => $user_email,
                    'client_email' => $clientEmail,
                    'gifted_email' => $giftedEmail,
                    'clientLastname' => $clientLastname,
                    'clientFirstname' => $clientFirstname,
                    'clientAddress' => $clientAddress,
                    'clientPhone' => $clientPhone,
                    'giftedLastname' => $giftedLastname,
                    'giftedFirstname' => $giftedFirstname,
                    'giftedAddress' => $giftedAddress,
                    'giftedPhone' => $giftedPhone,
                    'status' => $status,
                    'company' => $company,
                    'isSent' => $isSent
                ];
                $bd_cards = new Cards();
                $bd_cards->insert($cardData);

                $message = 'Une carte d\un montant de ' . $value . ' vient d\'être générée';
                send_telegram_callmebot($message);

                #$data['test'] = d($clientData, $giftedData, $cardData);
                $session = session();
                $session->setFlashdata('successCard', 'Carte créée');
                return redirect()->to('dashboard');
            }
        }

        echo view('templates/header', $data);
        echo view('site/create', $data);
        echo view('templates/footer');
    }

    public function read()
    {
        $data['title'] = 'Lecture';

        echo view('templates/header', $data);
        echo view('site/read', $data);
        echo view('templates/footer');
    }

    public function created()
    {
        $user_email = session()->get('email');
        $bdd = new Cards();

        //$test = $bdd->getSumCreated($user_email);
        $data = [
            'users' => $bdd->whereIn('user_email', [$user_email])->paginate(5),
            'pager' => $bdd->pager,
            'user_email' => session()->get('email'),
            'title' => 'Carte émises',
        ];
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getVar('personnalId');

            $bdd = new Cards();
            $cardData = $bdd->getInfoFromId($id);
            $data['test'] = $cardData;
            $bdd->updateIsSentStatus($id);
            foreach ($cardData as $row) {
                $giftedEmail = $row->gifted_email;
                $giftedLastname = $row->giftedLastname;
                $giftedFirstname = $row->giftedFirstname;
                $giftedValue = $row->value;
                $client_email = $row->client_email;
                $company = $row->company;
                $clientFirstname = $row->clientFirstname;
                $clientLastname = $row->clientLastname;

                $email = \Config\Services::email();
                $email->setFrom('thomascariot@gmail.com', 'Thomas Cariot');
                $email->setTo($giftedEmail);
                $email->setSubject('Carte Cadeau à l\'attention de ' . $giftedFirstname . ' ' . $giftedLastname . ' .');
                $email->setMessage('Carte cadeau de l\'établissement '.$company.' d\'une valeur de ' . $giftedValue . ' €. Cette carte cadeau vous a été offerte par ' . $clientFirstname . ' '.$clientLastname.'. Voici son adresse mail: '. $client_email. ' ');
                $email->send();
                #$test1 = $email->send();
                #$data['test1'] = $test1;
            }
            $session = session();
            $session->setFlashdata('successMail', 'Carte envoyée par mail');
            echo view('templates/header', $data);
            echo view('site/created', $data);
            echo view('templates/footer');
        } else {
            echo view('templates/header', $data);
            echo view('site/created', $data);
            echo view('templates/footer');
        }
    }

    public function used()
    {
        $bdd = new Cards();
        $data = [
            'title' => 'Cartes utilisées',
            'used' => $bdd->whereIn('status', ['U'])->paginate(5),
            'pager' => $bdd->pager,
        ];

        echo view('templates/header', $data);
        echo view('site/used', $data);
        echo view('templates/footer');
    }

    public function pending()
    {
        $bdd = new Cards();
        $data = [
            'title' => 'Cartes en circulation',
            'pending' => $bdd->whereIn('status', ['N'])->paginate(5),
            'pager' => $bdd->pager,
        ];
        echo view('templates/header', $data);
        echo view('site/pending', $data);
        echo view('templates/footer');
    }

    public function clients()
    {
        $user_email = session()->get('email');
        $bdd = new UserClient();
        $data = [
            'title' => 'Clients',
            'clients' => $bdd->whereIn('user_email', [$user_email])->paginate(5),
            'pager' => $bdd->pager,
        ];

        echo view('templates/header', $data);
        echo view('site/clients', $data);
        echo view('templates/footer');
    }


    public function codeqr($qrId)
    {

        $data['title'] = 'codeQR';
        $bdd = new Cards();
        $data['codeqr'] = $bdd->getCardCodeQr($qrId);
        $status = $bdd->verifyCardStatus($qrId);
        $data['status'] = $status;
        if ($status == 'N') {
            if ($this->request->getMethod() == 'post') {

                $bdd = new Cards();
                $bdd->updateCardStatus($qrId);
                $session = session();
                $session->setFlashdata('success', 'Carte Utilisée');
            }
            echo view('templates/header', $data);
            echo view('site/codeqr');
            echo view('templates/footer');
        } elseif ($status == 'U') {
            echo view('templates/header', $data);
            echo view('site/usedCards');
            echo view('templates/footer');
        } elseif ($status == NULL) {
            echo view('templates/header', $data);
            echo view('errors/invalidCard');
            echo view('templates/footer');
        }
    }

    public function giftedclients()
    {
        $bdd = new GiftedClient();
        $user_email = session()->get('email');
        $data = [
            'title' => 'Bénéficiaires',
            'clients' => $bdd->whereIn('user_email', [$user_email])->paginate(5),
            'pager' => $bdd->pager,
        ];
        echo view('templates/header', $data);
        echo view('site/giftedclients', $data);
        echo view('templates/footer');
    }

    public function usedCard()
    {
        $data['title'] = 'Used';

        echo view('templates/header', $data);
        echo view('site/usedCards', $data);
        echo view('templates/footer');
    }

    public function invalidCard()
    {
        $data['title'] = 'Carte non valide';
        echo view('templates/header', $data);
        echo view('errors/invalidCard');
        echo view('templates/footer');
    }

    public function test()
    {
        #helper(['whatsapp', 'form']);
        $data['title'] = 'test';
        if ($this->request->getMethod() == 'post') {
            $message = $this->request->getVar('test');
            #send_whatsapp_callmebot($message);
            send_telegram_callmebot($message);
            $session = session();
            $session->setFlashdata('successTelBot', 'Message envoyé');

        }
        echo view('templates/header', $data);
        echo view('site/test', $data);
        echo view('templates/footer');
    }

    public function newcreate()
    {
        $data['title'] = 'creation';
        echo view('templates/Header', $data);
        echo view('site/newcreate');
        echo view('templates/footer');
    }

    public function accounting()
    {
        $user_email = session()->get('email');
        $bdd = new Cards();
        $total = $bdd->getSumCreated($user_email);
        $totalUsed = $bdd->getSumUsed($user_email);
        $totalPending = $bdd->getSumPending($user_email);
        $nbOfCards = $bdd->howManyCardsSold($user_email);
        #$data['test'] = d($total, $totalUsed, $totalPending);
        $data = [
            'title' => 'Comptabilité',
            'total' => $total,
            'totalUsed' => $totalUsed,
            'totalPending' => $totalPending,
            'nbOfCards' => $nbOfCards
            #'test' => d($total, $totalUsed, $totalPending)
        ];
        echo view('templates/Header', $data);
        echo view('site/accounting');
        echo view('templates/footer');
    }
}
