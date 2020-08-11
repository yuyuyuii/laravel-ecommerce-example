<?php

function presentPrice( $price)
{
    return money_format('$%i', $price / 100); //14999 -> $149.99
}

function setActiveCategory($category, $output = 'active')
{
  return request()->category == $category ? $output : '';
}

function productImage($path)
  {
    return $path  && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/noimage.png'); //
    // if($path) 
    //   return  asset('storage/'.$path);
    // else
    //   return asset('img/noimage.png');
  }

function getStock($quantity)
{ 
  //アラートを出す個数
  $stock_Num = 5;

  //商品の在庫が5こ以上あったら
  if($quantity > $stock_Num){
    $stock = '<div class="badge badge-success">在庫あり</div>';

  }elseif($quantity <= $stock_Num && $quantity > 0 ){// 少ししかなかったら
    $stock = '<div class="badge badge-warning">残りわずか</div>';

  }else{
  // 在庫がなかったら
  $stock = '<div class="badge badge-danger">在庫なし</div>';        
  }

  return $stock;
}  

?>