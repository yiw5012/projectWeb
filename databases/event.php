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

function getEventby_keyword($keyword):mysqli_result|bool {

    $conn = getConnection();
    $sql = 'select * from events where title_event like ?';
    $stmt = $conn->prepare($sql);
    $keyword = '%'. $keyword .'%';
    $stmt->bind_param('s',$keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}