<?php
function login(String $username, String $password): array|bool
{
    $conn = getConnection();
    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        return false; // ไม่มีผู้ใช้งานที่ตรงกับ email
    }
    $row = $result->fetch_assoc();
    // ตรวจสอบว่า password ที่ถูกกรอกตรงกับ password ที่เก็บในฐานข้อมูลหรือไม่
    var_dump($row['password']); // ตรวจสอบค่าของ password ที่เก็บในฐานข้อมูล
    var_dump($password); // ตรวจสอบค่าของ password ที่กรอกเข้ามา

    if (password_verify(($password), $row['password'])) {
        return $row; // ถ้ารหัสผ่านถูกต้อง
    } else {
        return false; // รหัสผ่านไม่ถูกต้อง
    }
    
}


function logout():void
{
    unset($_SESSION['timestamp']);
}


function walkin_check($regis_id, $otp) {
    $conn = getConnection();
    $sql = 'SELECT * FROM attendance WHERE registration_id = ? AND otp_used = ?';
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $regis_id, $otp);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    }else {
		return false;
	}

}

function walkin_update($regis_id) {
    $conn = getConnection();
    $sql = 'UPDATE attendance SET status = ? WHERE  registration_id = ? ';
    $status = 'approved';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si',$status, $regis_id);
    $stmt->execute();
    return $stmt->affected_rows > 0;

}