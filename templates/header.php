<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบลงทะเบียนเรียน</title>

    <!-- ลิงก์ไปยัง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- การกำหนดสไตล์ของ navbar -->
    <style>
        a {
            color: white;
            /* สีของลิงก์เป็นสีขาว */
        }

        /* สีของลิงก์เมื่อมีการ hover */
        a:hover {
            color: yellow;
            /* เปลี่ยนสีเมื่อ hover */
        }

        body {
            background-color: white;
        }

        /* กำหนดสีของ navbar */
        .navbar-custom {
            background-color: #343a40;
            /* สีพื้นหลังของ navbar */
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-link {
            color: white;
            /* สีของลิงก์ใน navbar */
        }

        /* เพิ่มลักษณะการแสดงผลที่เหมาะสม */
        .navbar-nav .nav-link:hover {
            color: cyan;
            /* สีเมื่อ hover */
        }
    </style>
</head>

<body>

    <!-- ส่วนหัวของเว็บไซต์ -->


    <!-- Navbar (เมนู) -->
    <nav class="navbar navbar-expand-lg navbar-custom w-100">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="/">ACTVITY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['timestamp'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/">หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/createAct">สร้างกิจกรรม</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Request">Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/logout">ออกจากระบบ</a>
                        </li>
                    <?php else: ?>
                        <nav class="navbar navbar-expand-lg navbar-ligth">
                            <div class="container-fluid">
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a class="nav-link " href="/">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- สคริปต์สำหรับ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>