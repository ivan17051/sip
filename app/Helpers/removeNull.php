<?php

if(!function_exists('removeNull')){
   function removeNull(&$validated) {
      array_walk($validated, function($val,$key) use(&$validated){
         if(!isset($val)) unset($validated[$key]);
         else $validated[$key] = trim($val);
      });
   }
}