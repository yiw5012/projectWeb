<?php
// รับค่าจากฟอร์ม และใช้ trim() เพื่อลบช่องว่าง
$title = trim($_POST["title"] ?? "");
$detil = trim($_POST["detil"] ?? "");
$location = trim($_POST["localion"] ?? "");
$date_time = trim($_POST["date_time"] ?? "");
$max = trim($_POST["max"] ?? "");
$id = trim($_POST["id"] ?? "");

// ตรวจสอบว่าฟังก์ชัน ADDEnroll มีอยู่หรือไม่
// ส่งค่าที่ตรวจสอบแล้วไปที่ ADDEnroll
$res = update_byid($title, $detil, $date_time,$max,$location,$id);

if ($res) {
    $_SESSION['message'] = 'การแก้ไขนสำเร็จ';
    header('Location: /home');
    exit;
} else {
    $_SESSION['message'] = 'เกิดข้อผิดพลาด';
    header('Location: /');
    exit;
}
