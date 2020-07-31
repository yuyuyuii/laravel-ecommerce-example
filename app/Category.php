<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  //categoriesからcategoryにテーブル名を変更する必要があるっぽい 
  protected $table = 'category';
  public function products()
  {
    return $this->belongsToMany('App\Product');
  }
}
