<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','image','description','price','additional_info','category_id','sub_category_id'];

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function subCategory() {
        return $this->hasOne('App\SubCategory', 'id', 'sub_category_id');
    }
}
