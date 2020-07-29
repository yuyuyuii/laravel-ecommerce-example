<?php

function presentPrice( $price)
{
    return money_format('$%i', $price / 100); //14999 -> $149.99
}

function setActiveCategory($category, $output = 'active')
{
  return request()->category == $category ? $output : '';
}

?>