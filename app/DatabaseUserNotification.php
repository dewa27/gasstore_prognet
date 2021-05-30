<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class DatabaseUserNotification extends DatabaseNotification
{
    protected $table = 'user_notifications';
    protected $guarded = [];
}
