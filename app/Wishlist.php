<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
     protected $fillable = [
         'pid', 'userid',
    ];
}
