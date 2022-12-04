<?php
namespace App\Helper;
class Validation {
    public static function validate($data){
        $firstNameLen = strlen ($data["first_name"]);
        $lastNameLen = strlen ($data["last_name"]);
        $email = $data["email"];
        $ErrMsg = [];
        if ( $firstNameLen <= 3) {
            $ErrMsg['firstName']['length'] = "First Name must have 3 digits.";
        }
        if($lastNameLen <= 3){
            $ErrMsg['lastName']['length'] = "Last Name must have 3 digits.";
        }
        if(empty($data["first_name"])){
            $ErrMsg['firstName']['empty'] = "First Name required";
        }
        if(empty($data["last_name"])){
            $ErrMsg['lastName']['empty'] = "Last Name required";
        }
        if(empty($data["date"])){
            $ErrMsg['date']['empty'] = "Date required";
        }
        if(empty($data["email"])){
            $ErrMsg['email']['empty'] = "Email required";
        }

        $patternPhone = "^((\+0?1\s)?)\(?\d{3}\)?[\s.\s]\d{3}[\s.-]\d{4}$^";
        if(empty($data["phone"])){
            $ErrMsg['phone']['empty'] = "Phone required";
        }
        if (!preg_match ($patternPhone, $data["phone"]) ){
            $ErrMsg['phone']['notValid'] = "Phone is not valid. Example (999) 999-9999";
        }

        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match ($pattern, $email) ){
            $ErrMsg['email']['notValid'] = "Email is not valid. Example example@gmail.com";
        }

        if(empty($data["favorites"])){
            $ErrMsg['favorites']['empty'] = "Favorites required";
        }

        if(!is_array($data["favorites"])){
            $ErrMsg['favorites']['isArray'] = "Favorites its not type of array";
        }

        return $ErrMsg;
    }
}