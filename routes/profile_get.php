<?php


$user = getUserById($_SESSION['student_id']);
$allevent = select_all_Event_if_creater($_SESSION['student_id']);
$everevent = event_ever_regis($_SESSION['student_id']);

renderView('profile_get', array(
    'user' => $user,
    'allevent' => $allevent,
    'everevent' => $everevent
));