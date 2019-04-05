<?php

/*

Timestamp handles timestamp related opertions.

Examples of use:

$date = date('2019-04-04 18:05:21');
$diff = Timestamp::diffMinutes($date);
print_r(Timestamp::now());
print_r($diff . "minutes");

*/

  class Timestamp
  {

    //return current timestamp
      public static function now()
      {
          return date('Y-m-d H:i:s', time());
      }

      //Get difference between timestamps in minutes
      public static function diffMinutes($pastDateTime)
      {
          $old = strtotime($pastDateTime);
          $now = strtotime(date('Y-m-d H:i:s', time()));

          $diff = ($now - $old) / 60;

          return $diff;
      }
  }
