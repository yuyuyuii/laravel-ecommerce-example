<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  public static function findByCode($code)
  {
    return self::where('code', $code)->first();
  }

  public function discount($total)
  {
    if($this->type == 'fixed'){ //固定額
      return $this->value;
    }elseif ($this->type == 'percent'){ //割合
      return round(($this->percent_off / 100 ) * $total); 
    }else{
      return 0;
    }

  }
}
