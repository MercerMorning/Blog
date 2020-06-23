<?php

namespace App\Models;

use App\Services\MessageImage;
use Intervention\Image\ImageManager;

class Image extends Base
{
    /**
     * Добавление картинки к сообщению
     * @param $file
     */
    public function add($file)
    {
        if (!file_exists($file)) {
            return 0;
        }
        $result = $this->microBlogMessagesTable
            ->newQuery()
            ->select('id')
            ->where('isset_image', '<>', '0')
            ->orderByDesc('id')
            ->get()
            ->toArray();
        $imageManager = new MessageImage();
        move_uploaded_file ($file, PROJECT_PATH . "/public_html/images/" . $result[0]['id'] . ".jpg");
        $imageManager->watermark(PROJECT_PATH . "/public_html/images/" . $result[0]['id'] . ".jpg");
    }
}