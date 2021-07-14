<?php namespace App\Models;

use CodeIgniter\Model;

class UserClient extends Model
{
    protected $table = 'user_clients';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_email','firstname', 'lastname', 'email', 'address', 'phone'];

    public function getUserClients($var){
        return $this->select()
                    ->where('user_email', $var)
                    ->get()
                    ->getResult();
    }
}