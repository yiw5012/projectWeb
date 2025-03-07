<?php

if (editEvent_if_creater($_GET['event_id'], $_SESSION['student_id'])) {
    $result = getEventby_id($_GET['event_id']);
    renderView('editact_get', array('result' => $result));
    echo "<script>
    alert('ขอให้สนุกกับการปรับแต่งกิจกรรมของคุณ');
    </script>";
} else {
    echo "<script>
    alert('คุณไม่ใช่ผู้สร้างกิจกรรมนี้ คุณจึงไม่สามารถปรับแต่งกิจกกรมนี้ได้');
     </script>";
  header('Location: /home');
}
