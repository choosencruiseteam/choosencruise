<?php
class Validate{

    /*
      Test all given data points
      If result=true, all matching fields are Valid
      else if result=false, at least one field is not valid
    */
    public static function all($formData){

      $result = array('status'=>true,'data'=>array());

      foreach($formData as $key=>$value){

        if($key == "username"){
          $testedValue = self::username($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'username','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "fname"){
          $testedValue = self::fname($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'fname','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "lname"){
          $testedValue = self::lname($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'lname','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "street"){
          $testedValue = self::street($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'street','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "city"){
          $testedValue = self::city($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'city','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "state"){
          $testedValue = self::state($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'state','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "zip"){
          $testedValue = self::zip($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'zip','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }

        if($key == "phone"){
          $testedValue = self::phone($value);
           if($testedValue['result'] == false){
             $invalidField = array('field'=>'phone','msg'=>$testedValue['msg']);
             array_push($result['data'],$invalidField);
           }
        }
      }

      if(sizeof($result['data']) > 0){
        $result['status'] = false;
      }

      return $result;
    }

    public static function username($data){
      $pattern = "/^(?=.{2,32}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";
      $regexResult = preg_match($pattern,$data);

      if($regexResult == true){
        $result = array('result'=>true);
      }else{
        $errorMsg = 'Username Format: 2 to 32 length,[a-zA-Z0-9\.\_], cannot use \'_.\' at beginning or end of username';
        $result = array('result'=>false,'msg'=>$errorMsg);
      }

      return $result;
    }

    public static function password($data){
      $pattern = "/^(?=.{2,32}$)[a-zA-Z0-9._!@#$%^&*]+$/";
      $regexResult = preg_match($pattern,$data);

      if($regexResult == true){
        $result = array('result'=>true);
      }else{
        $errorMsg = 'password Format: 2 to 32 length, [a-zA-Z0-9._!@#$%^&*]';
        $result = array('result'=>false,'msg'=>$errorMsg);
      }

      return $result;
    }

    public static function fname($data){
      $pattern = '/^(?=.{2,32}$)[a-zA-Z]+$/';
      $regexResult = preg_match($pattern,$data);

      if($regexResult == true){
        $result = array('result'=>true);
      }else{
        $errorMsg = 'First name Format: 2 to 32 length, [a-zA-Z]';
        $result = array('result'=>false,'msg'=>$errorMsg);
      }

      return $result;
    }

    public static function lname($data){
      $pattern = '/^(?=.{2,32}$)[a-zA-Z]+$/';
      $regexResult = preg_match($pattern,$data);

      if($regexResult == true){
        $result = array('result'=>true);
      }else{
        $errorMsg = 'Last name Format: 2 to 32 length, [a-zA-Z]';
        $result = array('result'=>false,'msg'=>$errorMsg);
      }

      return $result;
    }

    public static function street($data){
      $pattern = '/^(?=.{2,64}$)[a-zA-Z0-9. ]+$/';
      $regexResult = preg_match($pattern,$data);

      if($regexResult == true){
        $result = array('result'=>true);
      }else{
        $errorMsg = 'Street Format: 2 to 64 length, [a-zA-Z0-9.]';
        $result = array('result'=>false,'msg'=>$errorMsg);
      }

      return $result;
    }

    public static function city($data){
      $pattern = '/^(?=.{2,32}$)[a-zA-Z ]+$/';
      $regexResult = preg_match($pattern,$data);

      if($regexResult == true){
        $result = array('result'=>true);
      }else{
        $errorMsg = 'City Format: 2 to 32 length, [a-zA-Z]';
        $result = array('result'=>false,'msg'=>$errorMsg);
      }

      return $result;
    }

      public static function state($data){
        $states = array("AK","AL","AR","AS","AZ","CA","CO","CT","DC","DE","FL","GA",
                   "GU","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME",
                   "MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV",
                   "NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX","UT",
                   "VA","VI","VT","WA","WI","WV","WY");
        $result = in_array($data,$states);

        if($result == true){
          $result = array('result'=>true);
        }else{
          $errorMsg = 'State Format: Ex.; TX, LA';
          $result = array('result'=>false,'msg'=>$errorMsg);
        }

        return $result;
      }

      public static function zip($data){
        $pattern = '/^[0-9]{5}$/';
        $regexResult = preg_match($pattern,$data);

        if($regexResult == true){
          $result = array('result'=>true);
        }else{
          $errorMsg = 'Zip Format: 5 length, [0-9]';
          $result = array('result'=>false,'msg'=>$errorMsg);
        }

        return $result;
      }

      public static function phone($data){
        $pattern = '/^[0-9]{10}$/';
        $regexResult = preg_match($pattern,$data);

        if($regexResult == true){
          $result = array('result'=>true);
        }else{
          $errorMsg = 'Phone Format: 10 length, [0-9], \'XXXXXXXXXX\'';
          $result = array('result'=>false,'msg'=>$errorMsg);
        }

        return $result;
      }
}

?>
