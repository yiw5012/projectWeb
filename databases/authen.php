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


function walkin_check($regis_id, $otp, $event_id) {
    $conn = getConnection();
    $sql = 'SELECT * 
    FROM attendance 
    INNER JOIN registration ON attendance.registration_id = registration.registration_id
            WHERE attendance.registration_id = ? 
            AND attendance.otp_used = ? 
            AND registration.event_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isi', $regis_id, $otp, $event_id);
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
function walkin_update_regis($regis_id) {
    $conn = getConnection();
    $sql = 'UPDATE registration SET status = ? WHERE  registration_id = ? ';
    $status = 'canceled';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si',$status, $regis_id);
    $stmt->execute();
    return $stmt->affected_rows > 0;

    

}