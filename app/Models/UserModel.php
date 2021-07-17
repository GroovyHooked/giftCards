<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = ['firstname', 'lastname', 'email', 'password', 'created_at', 'updated_at', 'token', 'token_exp', 'company'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }

    public function getUserData($var)
    {
        return $this->where('email', $var)
                    ->first();
    }

    public function getUserDataById($var)
    {
        return $this->where('id', $var)
            ->first();
    }

    public function checkIfUserExist($var)
    {
        $query = $this->where('email', $var)
            ->get()
            ->getResult();
        foreach ($query as $row) {
            if (!empty($row->email))
                return true;
        }
        return false;
    }

    public function insertTokenData($token, $dateTime, $email)
    {
        return $this->set('token', $token)
            ->set('token_exp', $dateTime)
            ->where('email', $email)
            ->update();
    }

    public function verifyTokenExp($token)
    {
        $query = $this->where('token', $token)
            ->get()
            ->getResult();
        foreach ($query as $row) {
            if (!empty($row->token))
                return true;
        }
        return false;
    }

    public function getTimeToken($token)
    {
        $query = $this->select('token_exp')
            ->where('token', $token)
            ->first();
        return $query['token_exp'];
    }

    public function getUserDataFromToken($var)
    {
        return $this->where('token', $var)
            ->first();
    }

    public function updatePassword($password, $userMail)
    {
        return $this->set('password', $password)
            ->where('email', $userMail)
            ->update();
    }
    public function updateProfile($id, $company, $lastName, $firstName, $email)
    {
        return $this->set('company', $company)
            ->set('lastname', $lastName)
            ->set('firstname', $firstName)
            ->set('email', $email)
            ->where('id', $id)
            ->update();
    }
}