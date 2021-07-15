<?php

namespace App\Controllers;

use App\Models\Cards;
use App\Models\GiftedClient;
use App\Models\UserClient;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

/********************
 *   SOMMAIRE
 *  method index      l36
 *  method create     l45
 *  method read       l151
 *  method created    l160
 *  method used       l210
 *  method pending    l227
 *  method clients    l243
 *  method codeqr     l259
 *  method giftedclients   l298
 *  method usedCard   l312
 *  method invalidCard    l321
 *  method test       l329
 *  method newcreate  l346
 *  method accounting l354
 * */
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

                $qrCode = new QrCode('http://gift-cards.ddns.net/codeqr/' . $qrcodeId);
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

    public function created($var = 5)
    {
        $user_email = session()->get('email');
        $bdd = new Cards();
        $nbResult = $bdd->howManyResultPerUser($user_email);

        $data = [
            'users' => $bdd->whereIn('user_email', [$user_email])->orderBy('id', 'DESC')->paginate($var),
            'pager' => $bdd->pager,
            'user_email' => session()->get('email'),
            'title' => 'Carte émises',
            'nbResult' => $nbResult,

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
                $cardUrl = $row->card_url;

                $email = \Config\Services::email();
                $email->setFrom('macminidethomas@gmail.com', 'Gift Cards Inc');
                $email->setTo($giftedEmail);
                $email->setSubject('Carte Cadeau à l\'attention de ' . $giftedFirstname . ' ' . $giftedLastname . ' .');
                $email->setMessage('Bonjour '.$giftedFirstname . ' ' . $giftedLastname . ', 
Carte cadeau de l\'établissement ' . $company . ' d\'une valeur de ' . $giftedValue . ' €. 
Cette carte cadeau vous a été offerte par ' . $clientFirstname . ' ' . $clientLastname . '. 
Voici son adresse mail: ' . $client_email . '. 
Vous pouvez la télécharger en vous rendant à cette adresse: http://gift-cards.ddns.net/' . $cardUrl . ' ');
                $email->send();

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

    public function qrcode($var)
    {
        $data['title'] = 'Carte Code QR';
        echo view('templates/header', $data);
        echo base_url('qrcode') . '/' . $var;
        echo view('templates/footer');

    }

    public function used($var = 5)
    {
        $bdd = new Cards();
        $userMail = session()->get('email');
        $data = [
            'title' => 'Cartes utilisées',
            'used' => $bdd->whereIn('status', ['U'])
                ->whereIn('user_email', [$userMail])
                ->paginate($var),
            'pager' => $bdd->pager,
            'totalUseds' => $bdd->whereIn('status', ['U'])
                                ->whereIn('user_email', [$userMail])
                                ->get()
                                ->getResult()
        ];

        echo view('templates/header', $data);
        echo view('site/used', $data);
        echo view('templates/footer');
    }

    public function pending($var = 5)
    {
        $bdd = new Cards();
        $userMail = session()->get('email');
        $data = [
            'title' => 'Cartes en circulation',
            'pending' => $bdd->whereIn('status', ['N'])
                ->whereIn('user_email', [$userMail])
                ->orderBy('id', 'DESC')
                ->paginate($var),
            'pager' => $bdd->pager,
            'totalPending' => $bdd->whereIn('status', ['N'])
                ->whereIn('user_email', [$userMail])
                ->get()
                ->getResult()
        ];
        echo view('templates/header', $data);
        echo view('site/pending', $data);
        echo view('templates/footer');
    }

    public function clients($var = 5)
    {
        $user_email = session()->get('email');
        $bdd = new UserClient();
        $data = [
            'title' => 'Clients',
            'clients' => $bdd->whereIn('user_email', [$user_email])
                ->groupBy("lastname")
                ->orderBy('id', 'DESC')
                ->paginate($var),
            'pager' => $bdd->pager,
            'totalClients' => $bdd->whereIn('user_email', [$user_email])
                ->get()
                ->getResult()
        ];

        echo view('templates/header', $data);
        echo view('site/clients', $data);
        echo view('templates/footer');
    }


    public function codeqr($qrId)
    {
        $bdd = new Cards();
        $user = session()->get('email');
        $codeqrVerif = $bdd->getCardCodeQr($user, $qrId);
        $status = $bdd->verifyCardStatus($qrId);
        $data = [
            'codeqr' => $bdd->getCardCodeQr($user, $qrId),
            'status' => $bdd->verifyCardStatus($qrId)
        ];
        if ($status == 'N' && $codeqrVerif) {
            if ($this->request->getMethod() == 'post') {
                $data['title'] = 'codeQR';
                $bdd = new Cards();
                $bdd->updateCardStatus($qrId);
                $session = session();
                $session->setFlashdata('success', 'Carte Utilisée');
            }
            $data['title'] = 'codeQR';
            echo view('templates/header', $data);
            echo view('site/codeqr');
            echo view('templates/footer');

        } elseif ($status == 'U' && $codeqrVerif) {
            $data['title'] = 'codeQR';
            echo view('templates/header', $data);
            echo view('site/usedCards');
            echo view('templates/footer');

        } elseif ($status == NULL || !$codeqrVerif) {
            $data['title'] = 'codeQR';
            echo view('templates/header', $data);
            echo view('errors/invalidCard');
            echo view('templates/footer');
        }
    }

    public function giftedclients($var = 5)
    {
        $bdd = new GiftedClient();
        $user_email = session()->get('email');
        $data = [
            'title' => 'Bénéficiaires',
            'clients' => $bdd->whereIn('user_email', [$user_email])
                ->groupBy("lastname")
                ->orderBy('id', 'DESC')
                ->paginate($var),
            'pager' => $bdd->pager,
            'totalGifteds' => $bdd->whereIn('user_email', [$user_email])
                ->get()
                ->getResult()
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

    public function contact()
    {
        helper(['whatsapp']);
        $data['title'] = 'Contact';
        if ($this->request->getMethod() == 'post') {
            if (session()->get('isLoggedIn')) {
                $rules = [
                    'telnumber' => 'required',
                    'message' => 'required'
                ];
                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $message = $this->request->getVar('message');
                    $phoneNumber = $this->request->getVar('telnumber');
                    $problem = $this->request->getVar('problem');
                    #send_whatsapp_callmebot($message);
                    $global = $problem . ' + ' . $phoneNumber . ' + ' . $message;
                    send_telegram_callmebot($global);
                    $session = session();
                    $session->setFlashdata('successTelBot', 'Votre message a bien été envoyé, un technicien vous contactera dans les plus brefs délais.');
                    return redirect()->to('contact');
                }
            } else {
                $rules = [
                    'telnumber' => 'required',
                    'message' => 'required'
                ];
                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {

                    $email = \Config\Services::email();
                    $message = $this->request->getVar('message');
                    $phoneNumber = $this->request->getVar('telnumber');
                    $problem = $this->request->getVar('problem');
                    $global = $problem . ' + ' . $phoneNumber . ' + ' . $message;
                    $email->setFrom('thomascariot@gmail.com', 'Thomas Cariot');
                    $email->setTo('thomascariot@gmail.com');
                    $email->setSubject('Email de support');
                    $email->setMessage($global);
                    $email->send();
                    $session = session();
                    $session->setFlashdata('successSentMail', 'Votre message a bien été envoyé, un technicien vous contactera dans les plus brefs délais.');
                    return redirect()->to('contact');
                }
            }
            }
            echo view('templates/header', $data);
            echo view('site/contact', $data);
            echo view('templates/footer');
        }


        public
        function accounting()
        {
            $user_email = session()->get('email');
            $bdd = new Cards();
            $total = $bdd->getSumCreated($user_email);
            $totalUsed = $bdd->getSumUsed($user_email);
            $totalPending = $bdd->getSumPending($user_email);
            $nbOfCards = $bdd->howManyCardsSold($user_email);
            $data = [
                'title' => 'Comptabilité',
                'total' => $total,
                'totalUsed' => $totalUsed,
                'totalPending' => $totalPending,
                'nbOfCards' => $nbOfCards
            ];
            echo view('templates/header', $data);
            echo view('site/accounting');
            echo view('templates/footer');
        }
    }
