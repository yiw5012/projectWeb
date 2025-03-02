<?php
$result = get_registered_users_by_creator($_SESSION['student_id']);


renderView("Request_get",array('result' => $result));
