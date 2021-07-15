<?php namespace App\Models;

use CodeIgniter\Model;

class Cards extends Model
{
    protected $table = 'cards';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'user_email',
        'value',
        'client_email',
        'gifted_email',
        'card_uniqid',
        'card_url',
        'clientLastname',
        'clientFirstname',
        'clientAddress',
        'clientPhone',
        'giftedLastname',
        'giftedFirstname',
        'giftedAddress',
        'giftedPhone',
        'status',
        'company',
        'isSent'
    ];
    public function howManyResultPerUser($var){
        return  $this->select('card_url')
                     ->whereIn('user_email', [$var])
                     ->countAllResults();
    }
    public function isSentInfo($var){
        $query = $this->select('isSent')
                      ->where('id', $var)
                      ->get()
                      ->getResult();
        foreach ($query as $row){
            if ($row->isSent == 0){
                return false;
            } elseif($row->isSent == 1) {
                return true;
            }
        }
    }
    public function updateIsSentStatus($var)
    {
        return $this->set('isSent', 1)
                    ->where('id', $var)
                    ->update();
    }
    public function showUserCards($var)
    {
        $query = $this->where('user_email', $var)
                      ->get()
                      ->getResult();
        $result = json_encode($query);
        $object = json_decode($result);
        return $object;
    }
    public function getInfoFromId($var){
        return $this->where('id', $var)
                    ->get()
                    ->getResult();
    }

    public function getCardCodeQr($varU, $varC)
    {
        return $this->where('user_email', $varU)
                    ->where('card_uniqid', $varC)
                    ->get()
                    ->getResult();
    }

    public function updateCardStatus($var)
    {
        return $this->set('status', 'U')
                    ->where('card_uniqid', $var)
                    ->update();
    }

    public function verifyCardStatus($var)
    {
        $result = $this->select('status')
                        ->where('card_uniqid', $var)
                        ->get()
                        ->getResult();
        foreach ($result as $row) {
            return $row->status;
        }
        return NULL;
    }

    public function getSumCreated($var)
    {
        return $this->selectSum('value')
                    ->where('user_email', $var)
                    ->get()
                    ->getResult();
    }

    public function getSumUsed($var)
    {
        return $this->selectSum('value')
                    ->where('user_email', $var)
                    ->where('status', 'U')
                    ->get()
                    ->getResult();
    }

    public function getSumPending($var)
    {
        return $this->selectSum('value')
                    ->where('user_email', $var)
                    ->where('status', 'N')
                    ->get()
                    ->getResult();
    }

    public function howManyCardsSold($var)
    {
        return $this->selectCount('user_email')
                    ->where('user_email', $var)
                    ->get()
                    ->getResult();
    }
    
}
