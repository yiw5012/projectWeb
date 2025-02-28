<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลนักเรียน</title>

    <!-- ลิงก์ไปยัง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- การกำหนดสไตล์สำหรับตารางและการจัดตำแหน่ง -->
    <style>
        body {
            background-color: #f8f9fa; /* สีพื้นหลังของหน้าเว็บ */
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
        }

        section {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        table th {
            background-color: #f8f9fa;
            color: #343a40;
        }

        table td {
            background-color: #ffffff;
        }

        a {
            color: #dc3545;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <section>
        <h2>ข้อมูลนักเรียน</h2>
        <table>
            <tr>
                <th>ชื่อ</th>
                <td><?= $data['result']['first_name'] ?></td>
            </tr>
            <tr>
                <th>นามสกุล</th>
                <td><?= $data['result']['last_name'] ?></td>
            </tr>
            <tr>
                <th>วันเกิด</th>
                <td><?= $data['result']['date_of_birth'] ?></td>
            </tr>
            <tr>
                <th>เบอร์โทรศัพท์</th>
                <td><?= $data['result']['phone_number'] ?></td>
            </tr>
        </table>

        <h2>วิชาที่ลงทะเบียนเรียน</h2>
        <table>
            <thead>
                <tr>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th>อาจารย์ผู้สอน</th>
                    <th>วันที่ลงทะเบียน</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['enrollments'] as $enrollment): ?>
                    <tr>
                        <td><?= $enrollment['course_code'] ?></td>
                        <td><?= $enrollment['course_name'] ?></td>
                        <td><?= $enrollment['instructor'] ?></td>
                        <td><?= $enrollment['enrollment_date'] ?></td>
                        <td><a href="/enroll_delete?id=<?=$enrollment['course_id']?>" onclick="return confirmSubmission()">ลบข้อมูล</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <script>
        function confirmSubmission() {
            return confirm("Are you sure you want to delete?");
        }
    </script>

    <!-- สคริปต์สำหรับ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
