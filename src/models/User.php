<?php

namespace App\Models;

class User extends Base
{
    /**
     * Запрос пользователя по email
     * @param $email
     * @return bool
     */
    public function get($email)
    {
        $result = $this->microBlogTable->newQuery()->select()->where('email', '=', $email)->get()->toArray();
        return $result[0];
    }

    /**
     * Добавление пользователя в базу
     * @param $user
     * @return bool
     */
    public function add($user)
    {
        $this->microBlogTable->email = $user["email"];
        $this->microBlogTable->password = password_hash($user["password"], PASSWORD_BCRYPT);
        $this->microBlogTable->name = $user["name"];
        $this->microBlogTable->register_date = date("y.m.d");
        $this->microBlogTable->save();
    }
}
