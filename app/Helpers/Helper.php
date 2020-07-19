<?php

if(! function_exists('show_order_status')) {
  function show_order_status($value){
    switch($value){
      case 0:
       return 'Active';
       break;
      case 1:
       return 'Closed';
       break;
    }
  }
}

if(! function_exists('is_active')) {
  function is_active($value){
    switch($value){
      case 0:
       return '<span style="color: red; font-weight: bold;">NE</span>';
       break;
      case 1:
       return '<span style="color: #343a40; font-weight: bold;">DA</span>';
       break;
    }
  }
}



if(! function_exists('show_role')) {
  function show_role($value){
    switch($value){
      case 1:
       return 'Radnik';
       break;
      case 2:
       return 'Administrator';
       break;
    }
  }
}

if(! function_exists('filterDate')) {
  function filterDate($value){
      $date= explode(" ", $value);
      $newDate = explode("-", $date[0]);
      $year = $newDate[0];
      $month = $newDate[1];
      $day = $newDate[2];
      switch ($month) {
      case "1":
          $month = 'Januar';
          break;
      case "2":
          $month = 'Februar';
          break;
      case "3":
          $month = 'Mart';
          break;
      case "4":
          $month = 'April';
          break;
      case "5":
          $month = 'Maj';
          break;
      case "6":
          $month = 'Juni';
          break;
      case "7":
          $month = 'Juli';
          break;
      case "8":
          $month = 'August';
          break;
      case "9":
          $month = 'Septembar';
          break;
      case "10":
          $month = 'Oktobar';
          break;
      case "11":
          $month = 'Novembar';
          break;
      case "12":
          $month = 'Decembar';
          break;
      default:
          $month = 'Greska!';
  }
      echo $day.'.'.$month.'.'.$year;
    }
} 
?>
