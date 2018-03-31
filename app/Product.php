<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
         'img', 'brand','ptype', 'link', 'title','description', 'price-previous', 'section-title',
    ];
}
