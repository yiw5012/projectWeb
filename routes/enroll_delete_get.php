<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /profile');
    exit;
} else {
    $id = (int)$_GET['id'];
    $res = deleteEnroll($id);

    if ($res) {
        $_SESSION['message_D'] = 'ลบสำเร็จ';
        header('Location: /profile');
        exit;
    } else {
        
    }
}

?>
