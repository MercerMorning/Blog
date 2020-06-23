<?php

namespace App\Models;


class Message extends Base
{
    public function getAllIdWithImages()
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->select('id')
            ->where('isset_image', '<>', '0')
            ->get()
            ->toArray();
        return $result;
    }

    /**
     * Получение всех сообщений
     * @return array
     */
    public function getAll()
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->join('micro_blog', 'micro_blog.id', '=', 'micro_blog_messages.user_id')
            ->select('micro_blog_messages.id', 'text', 'date', 'name')
            ->orderByDesc('id')
            ->limit(3)
            ->get()
            ->toArray();
        return $result;
    }

    /**
     * Добавление сообщения
     * @param $user
     * @param $text
     * @return bool
     */
    public function add($userId, $isSetImage, $text)
    {
        $lastInsertID = $this->microBlogMessagesTable
            ->newQuery()
            ->select('id')
            ->orderByDesc('id')
            ->limit(1)
            ->get()
            ->toArray();
        $this->microBlogMessagesTable->text = $text;
        $this->microBlogMessagesTable->date = date("y.m.d");
        $this->microBlogMessagesTable->isset_image = $isSetImage ? '/images/' . ++$lastInsertID[0]["id"] . '.jpg' : 0;
        $this->microBlogMessagesTable->user_id = $userId;
        $result = $this->microBlogMessagesTable->save();
        return $result;
    }

    /**
     * Удаление сообщения
     * @param $id
     */
    public function delete($id)
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->where('id', '=', $id)
            ->delete();
        return $result;
    }

    /**
     * Получение массива со всеми сообщениями пользователя с определенным id в json формате
     * @param $id
     * @return false|string
     */
    public function getAllById($id)
    {
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->select('text')
            ->where('user_id', '=', $id)
            ->get()
            ->toArray();
        return json_encode($result);

//        $sql = "SELECT text FROM `micro_blog_messages` WHERE user_id=:user_id";
//        $statement = $this->getConnect()->prepare($sql);
//        $statement->execute(["user_id" => $id]);
//        return json_encode($statement->fetchAll(\PDO::FETCH_ASSOC));
    }
}