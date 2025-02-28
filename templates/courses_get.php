<?php
$courses = $data['courses'];
?>

<section>
    <h2 class="text-center mb-4">รายวิชาที่เปิดให้ลงทะเบียน</h2>
    <div class="container">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th>อาจารย์ผู้สอน</th>
                    <th>ดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['course_code']) ?></td>
                        <td><?= htmlspecialchars($course['course_name']) ?></td>
                        <td><?= htmlspecialchars($course['instructor']) ?></td>
                        <td>
                            <a href="/enroll_add?id=<?= $course['course_id'] ?>" class="btn btn-success" onclick="return confirmSubmission()">ลงทะเบียน</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    function confirmSubmission() {
        return confirm("คุณแน่ใจหรือไม่ว่าต้องการลงทะเบียน?");
    }
</script>

<!-- ลิงก์ไปยัง Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
