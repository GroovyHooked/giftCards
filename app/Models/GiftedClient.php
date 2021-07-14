<?php namespace App\Models;

use CodeIgniter\Model;

class GiftedClient extends Model
{
    protected $table = 'gifted_clients';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_email', 'client_email', 'firstname', 'lastname', 'email', 'address', 'phone'];

    public function getGiftedClient($var)
    {
        return $this->select()
            ->where('user_email', $var)
            ->get()
            ->getResult();
    }
}