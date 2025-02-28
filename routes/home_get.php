<?php
// echo 'HomePage Work!!!';
$result = getStudentById($_SESSION['student_id']);
renderView('home_get',['result' => $result]);