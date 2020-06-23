<?php

namespace App\Models;

class User extends Base
{
    public function edit($post)
    {
        $result = $this->microBlogTable
            ->newQuery()
            ->where('id', '=', $post['id_change'])
            ->update(['name' => $post['name_change'],
                'email' => $post['email_change'],
                'password' => password_hash($post['password_change'], PASSWORD_BCRYPT)]
            );
        return $result;
    }

    public function delete($id)
    {
        $result = $this->microBlogTable
            ->newQuery()
            ->where('id', '=', $id)
            ->delete();
        return intval($result);
    }

    public function getAll()
    {
        $result = $this->microBlogTable->newQuery()->select()->get()->toArray();
        return $result;
    }

    public function getById($id) //DELETE
    {
        $id = str_replace('_edit', '', $id);
        $result = $this->microBlogTable->newQuery()->select()->where('id', '=', $id)->get()->toArray();
        return $result[0];
    }

    /**
     * Запрос пользователя по email
     * @param $email
     * @return bool
     */
    public function getByEmail($email)
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
