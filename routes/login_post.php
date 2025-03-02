<?php
$email = $_POST['email'];
$password = $_POST['password'];
$result = login( $email, $password);
if($result){
    $unix_timestamp = time();
    $_SESSION['timestamp'] = $unix_timestamp;
    $_SESSION['student_id'] = $result['user_id'];
    renderView('main_get', $result);
}else{
    echo'Email or Password invalid';
    renderView('login_get');
    unset($_SESSION['message']);
    unset($_SESSION['timestamp']);
}


