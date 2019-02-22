<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Recipe extends Model
{
    use Sortable;


    protected $fillable = [ 'name', 'category' ];


	public $sortable = ['id', 'name', 'category'];
}
