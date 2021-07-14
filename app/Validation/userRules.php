<?php

namespace App\Validation;

use App\Models\UserModel;

class userRules
{

    public function validateUser(string $str, string $fields, array $data)
    {
        $bdd = new UserModel();
        $user = $bdd->where('email', $data['email'])
            ->first();

        if (!$user)
            return false;

        return password_verify($data['password'], $user['password']);
    }
}