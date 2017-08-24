<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'reply';
    protected $primaryKey = 'reply_id';
    protected $fillable = ['reply_name', 'reply_content','reply_bind','created_at'];
    public $timestamps = false;
}
