<?php
    
    function generateToken($num) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $num; $i++) {
          $index = rand(0, strlen($characters) - 1);
          $token .= $characters[$index];
        }
        return $token;
      }

?>