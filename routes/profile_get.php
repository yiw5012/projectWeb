<?php


$user = getUserById($_SESSION['student_id']);
$allevent = select_all_Event_if_creater($_SESSION['student_id']);
$everevent = event_ever_regis($_SESSION['student_id']);
$ever_rejected = event_ever_rejected($_SESSION['student_id']);
$ever_pending = event_ever_pending($_SESSION['student_id']);
$ever_otp = event_ever_otp($_SESSION['student_id']);

renderView('profile_get', array(
    'user' => $user,
    'allevent' => $allevent,
    'everevent' => $everevent,
    'ever_rejected' => $ever_rejected,
    'ever_pending' => $ever_pending,
    'ever_otp' => $ever_otp



));