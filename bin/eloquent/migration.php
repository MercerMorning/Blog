<?php
include "init.php";

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

try {
    Capsule::schema()->dropIfExists('micro_blog');

    Capsule::schema()->create('micro_blog', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email');
        $table->string('password');
        $table->string('name');
        $table->date('register_date');
    });

    Capsule::schema()->dropIfExists('micro_blog_messages');

    Capsule::schema()->create('micro_blog_messages', function (Blueprint $table) {
        $table->increments('id');
        $table->string('text');
        $table->date('date');
        $table->integer('user_id');
        $table->string('isset_image')->nullable();
    });
    echo 'Success!';
} catch (Exception $e) {
    echo 'Fail!', PHP_EOL, $e;
}


