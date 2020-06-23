<?php

namespace App\Models;
use GUMP;

class Validation
{
    public function gumpAction($post)
    {
        $data = [
            'username' => $post['name'],
            'password' => $post['password'],
            'email' => $post['email']
        ];

        $validated = GUMP::is_valid($data, array(
            'username' => 'required|alpha_numeric|max_len,100|min_len,6',
            'password' => 'required|max_len,100|min_len,6',
            'email' => 'required|valid_email'
        ));

        if ($validated === true) {
            return true;
        }
        return $validated;
    }
}