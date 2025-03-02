<?php

function getStudents(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from students';
    $result = $conn->query($sql);
    return $result;
}

function getUserById(int $id):mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from users where user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        return false;
    }
    return $result;
}

function getmax_userid():int {
    $conn = getConnection();
    $sql = 'SELECT MAX(user_id) as max_id FROM users';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $maxid = $result->fetch_object()->max_id ?? 0;

    return $maxid+1;
}

