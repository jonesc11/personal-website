<?php
    $date = date("Y-m-d H:i:s");
    $time = strtotime($date);
    $time = $time - (180 * 60);
    
    $hour   = date('H', $time);
    $minute = date('i', $time);
    $day    = date('d', $time);
    $month  = date('m', $time);
    $year   = date('Y', $time);
?>