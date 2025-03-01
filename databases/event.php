<?php
function getEvent():mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from events';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result;
}