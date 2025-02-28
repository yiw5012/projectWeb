<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /courses');
    exit;
} else {
    $id = (int)$_GET['id'];

    $res = ADDEnroll($id);

    if ($res) {
        $_SESSION['message'] = 'การลงทะเบียนสำเร็จ';
        header('Location: /profile');
        exit;
    } else {
        // หากการลงทะเบียนซ้ำหรือเกิดข้อผิดพลาด
        $_SESSION['message'] = 'คุณได้ลงทะเบียนวิชานี้แล้ว.';
        header('Location: /courses');
        exit;
    }
}

?>
