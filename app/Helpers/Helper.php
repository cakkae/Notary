<?php

if(! function_exists('show_order_status')) {
  function show_order_status($value){
    switch($value){
      case 0:
        return '<span class="badge badge-primary" style="padding: 5px; ">Active</span>';
        break;
      case 1:
        return '<span class="badge badge-secondary" style="padding: 5px; ">Closed</span>';
        break;
      case 2:
        return '<span class="badge badge-danger" style="padding: 5px; ">Cancelled</span>';
        break;
      case 3:
        return '<span class="badge badge-info" style="padding: 5px; ">Re-Sign</span>';
        break;
      case 4:
        return '<span class="badge badge-success" style="padding: 5px; ">Compliance</span>';
        break;
    }
  }
}

if(! function_exists('is_active')) {
  function is_active($value){
    switch($value){
      case 0:
       return '<span style="color: red; font-weight: bold;">No</span>';
       break;
      case 1:
       return '<span style="color: #343a40; font-weight: bold;">Yes</span>';
       break;
    }
  }
}

if(! function_exists('show_request_status')) {
  function show_request_status($value){
    switch($value){
      case 0:
       return '<span class="badge badge-danger">Pending</span>';
       break;
      case 1:
       return '<span class="badge badge-success">Finished</span>';
       break;
    }
  }
}


if(! function_exists('show_role')) {
  function show_role($value){
    switch($value){
      case 1:
       return 'Employeer';
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
          $month = 'January';
          break;
      case "2":
          $month = 'February';
          break;
      case "3":
          $month = 'Mart';
          break;
      case "4":
          $month = 'April';
          break;
      case "5":
          $month = 'May';
          break;
      case "6":
          $month = 'June';
          break;
      case "7":
          $month = 'July';
          break;
      case "8":
          $month = 'August';
          break;
      case "9":
          $month = 'September';
          break;
      case "10":
          $month = 'October';
          break;
      case "11":
          $month = 'November';
          break;
      case "12":
          $month = 'December';
          break;
      default:
          $month = 'Greska!';
  }
      echo $month.'.'.$day.'.'.$year;
    }
} 
?>
