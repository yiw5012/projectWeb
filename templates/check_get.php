<?php
echo 'fsfs'; // แก้ไขโดยเพิ่ม semicolon (;) ปิดท้าย
?>

<form action="check" method="post">
    <label for="registration_id">Registration ID:</label>
    <input type="text" id="registration_id" name="registration_id">        
    
    <label for="otp">OTP:</label>
    <input type="text" id="otp" name="otp">

    <button type="submit">Submit</button> <!-- เพิ่มข้อความในปุ่ม Submit -->
</form>