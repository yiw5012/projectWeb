<?php
// รับค่าจากฟอร์ม และใช้ trim() เพื่อลบช่องว่าง
$actname = trim($_POST["actname"] ?? "");
$detailact = trim($_POST["detailact"] ?? "");
$location = trim($_POST["location"] ?? "");
$dateevent = trim($_POST["dateevent"] ?? "");
// $dateregisterend = trim($_POST["dateregisterend"] ?? "");
$maxregister = isset($_POST["maxregister"]) ? (int)$_POST["maxregister"] : 0;

// ตรวจสอบว่าค่าที่จำเป็นมีหรือไม่

$id = $_SESSION['student_id'];

// ตรวจสอบว่าฟังก์ชัน ADDEnroll มีอยู่หรือไม่

// ส่งค่าที่ตรวจสอบแล้วไปที่ ADDEnroll
$res = createAct($id, $actname, $detailact, $location, $dateevent, $maxregister);

if ($res) {

    $_SESSION['message'] = 'การลงทะเบียนสำเร็จ';
    header('Location: /home');
    exit;
} else {
    $_SESSION['message'] = 'คุณได้ลงทะเบียนกิจกรรมนี้แล้ว หรือเกิดข้อผิดพลาด';
    header('Location: /');
    exit;
}
// $_POST["actname"];
// $_POST["detailact"];
// $_POST["location"];
// $_POST["dateevent"];
// $_POST["actname"];
// $_POST["dateregisterend"];
// $_POST["maxregister"];
// echo ($_POST["actname"] . $_POST["detailact"] . $_POST["location"] . $_POST["detailact"] . $_POST["dateevent"] . $_POST["actname"] . $_POST["dateregisterend"] . $_POST["maxregister"]);

if (insertEvent(getmax_eventid(), $_POST["actname"], $_POST["detailact"],  $_POST["dateevent"], $_POST["location"], $_POST["maxregister"], $_SESSION['student_id'], $_POST['image'])) {
    header('Location: /');
} else {
    echo "<script>
    alert('Can not add Event Please try again.');
</script>";
    return;
}
// insertEvent(getmax_eventid(), $_POST["actname"], $_POST["detailact"],  $_POST["dateevent"], $_POST["location"], $_POST["maxregister"], $_SESSION['student_id'], $_POST['image']);

// *** sessint['student_id'] == sesstion['user_id'] fix later!!!