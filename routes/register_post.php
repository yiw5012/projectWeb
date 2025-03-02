<?php
// รับค่าจากฟอร์ม และใช้ trim() เพื่อลบช่องว่าง
$fileInput = trim($_POST["fileInput"] ?? "");
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$age = trim($_POST["age"] ?? "");
$gender = trim($_POST["gender"] ?? "");
// ตรวจสอบว่าฟังก์ชัน ADDEnroll มีอยู่หรือไม่
// ส่งค่าที่ตรวจสอบแล้วไปที่ ADDEnroll
$res = insertuser($name, $email, $password, $gender, $age);

if ($res) {
    $_SESSION['message'] = 'การลงทะเบียนสำเร็จ';
    header('Location: /home');
    exit;
} else {
    $_SESSION['message'] = 'เกิดข้อผิดพลาด';
    header('Location: /');
    exit;
}
