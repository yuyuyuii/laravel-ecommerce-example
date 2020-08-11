<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function presentPrice()
  {
    return money_format('$%i', $this->price / 100); //14999 -> $149.99
  }

  // レコメンドをメソッド化
  public function scopeMightAlsoLike($query)
  {
    return $query->inRandomOrder()->take(4);
  }

  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }  

  protected $fillable = [
    'quantity'
  ];
}
