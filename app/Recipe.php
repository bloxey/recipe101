<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // Table name
    protected $table = 'recipes';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = true;
}
