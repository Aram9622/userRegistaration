<?php

session_start();
include_once 'app/Helper/Validation.php';
include_once 'app/Helper/DB.php';
$action = '';
$ErrMsg = [];
if(isset($_GET) && isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action === 'create'){

    if(isset($_POST) && count($_POST) > 0){
        $ErrMsg = \App\Helper\Validation::validate($_POST);
        if(count($ErrMsg) > 0){
            $_SESSION['error'] = $ErrMsg;
            header('Location: /');
            die();
        }
        $user = \App\Helper\DB::insert('users', [
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "date" => $_POST['date'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone'],
            "favorites" => json_encode($_POST['favorites'])
        ]);

        $user ? header("Location: /") : var_dump('error');
    }else {
        var_dump($_POST);
//        header('Location: /');
    }

}
else if($action === 'update'){
    $ErrMsg = \App\Helper\Validation::validate($_POST);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if(count($ErrMsg) > 0){
        $_SESSION['error'] = $ErrMsg;
        header("Location: /?id=$id");
        die();
    }
    $user = \App\Helper\DB::update('users',[
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['date'],
        $_POST['email'],
        $_POST['phone'],
        json_encode($_POST['favorites'])],"WHERE id='$id'");

    $user ? header("Location: /") : var_dump('error');
}
else if($action === 'delete'){
    $id = $_GET['id'];
    $delete = \App\Helper\DB::delete('users', $id);
    if($delete){
        header("Location: /");
    }
}
else if($action === 'select'){

}
else if($action === 'errorSessionClear'){
    unset($_SESSION['error']);
}