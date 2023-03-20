<?php

function checkEmail($email) {
  $string = "hetic.eu";
  if((substr($email, -8) == $string)) 
  {
    return true;
  } 
  else 
  {
    return false;
  }
}

?>