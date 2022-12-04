<?php

namespace App\Helper;
use config\DbConfig;

include_once "config/db.php";

class DB {
    public static function select($table, $options = '', array $args = []){
        $sql = /** @lang text */
            "SELECT * FROM $table $options";
        if(count($args) < 1 && empty($options)){
            $result = DbConfig::connect()->query($sql)->fetchAll();
        }
        else if(!empty($options)) {
            $result = DbConfig::connect()->query($sql)->fetch();
        }

        return $result;
    }


    public static function insert($table, array $values){
        try {
            $email = $values['email'];
            $select = self::select($table, "WHERE email = '$email'");

            if($select){

                unset($_SESSION['error']);
                $_SESSION['error']['email']['exists'] = 'Email exists';
                header("Location: /");
                die();
            }
            $sql = /** @lang text */
                "INSERT INTO $table (`first_name`, `last_name`, `date`, `email`, `phone`, `favorites`) VALUES (?,?,?,?,?,?)";
            DbConfig::connect()->prepare($sql)->execute(array_values($values));
            return true;
        }catch (\Exception $exception){
            echo '<pre>';
            print_r($exception->getMessage());
            echo '</pre>';
            return false;
        }
    }

    public static function update($table, array $values, $condition){
        try {
            $sql = /** @lang text */
                "UPDATE $table SET first_name=?, last_name=?, date=?, email=?, phone=?, favorites = ? $condition";
            DbConfig::connect()->prepare($sql)->execute($values);
            return true;
        }catch (\Exception $exception){
            echo __DIR__;
            echo '<pre>';
            print_r($exception->getMessage());
            echo '</pre>';
            die();
        }
    }

    public static function delete($table, $id){
        $sql = /** @lang text */
            "DELETE FROM $table WHERE id=?";
        try {
            DbConfig::connect()->prepare($sql)->execute([$id]);
            return true;
        }catch (\Exception $exception){
            return false;
            echo __DIR__;
            var_dump($exception);
            die();
        }

    }

}