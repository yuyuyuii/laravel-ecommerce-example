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
    // return file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/noimage.png'); //
    if($path) 
      return  asset('storage/'.$path);
    else
      return asset('img/noimage.png');
  }

?>