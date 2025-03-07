<?php
session_start(); // ต้องมี session_start() ก่อนใช้ $_SESSION

// ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์: " . $_FILES['image']['error']);
}

// รับค่าจากฟอร์ม
$fileInput = trim($_POST["fileInput"] ?? "");
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$age = trim($_POST["age"] ?? "");
$gender = trim($_POST["gender"] ?? "");

// ตั้งค่าโฟลเดอร์อัปโหลด
$uploadDir = 'uploads/';

// ตรวจสอบว่ามีโฟลเดอร์อยู่หรือไม่ ถ้าไม่มีให้สร้างใหม่
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// ตรวจสอบสิทธิ์ในการเขียนไฟล์
if (!is_writable($uploadDir)) {
    die("โฟลเดอร์อัปโหลดไม่มีสิทธิ์เขียนไฟล์!");
}

// ตั้งชื่อไฟล์ใหม่
$fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$uploadFile = $uploadDir . uniqid() . '.' . $fileExtension;

// ย้ายไฟล์ไปยังโฟลเดอร์อัปโหลด
if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
    // บันทึกลงฐานข้อมูล
    $res = insertuser($name, $email, $password, $gender, $age, $uploadFile);

    if ($res) {
        $_SESSION['message'] = 'การลงทะเบียนสำเร็จ';
        header('Location: /home');
        exit;
    } else {
        $_SESSION['message'] = 'เกิดข้อผิดพลาด';
        header('Location: /');
        exit;
    }
} else {
    die("เกิดข้อผิดพลาดในการย้ายไฟล์!");
}
