<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&family=Prompt:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- เชื่อมโยง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
    /* การตั้งค่าพื้นหลังของหน้า */
    body {
        background: url('https://i.pinimg.com/originals/89/dd/d5/89ddd54255e578c5402519868f438c0b.png');
        background-size: cover;
        background-position: center;
        font-family: 'Prompt', sans-serif;
    }

    /* ปรับสไตล์ของ Navbar */
    .navbar {
        background-color: rgba(0, 0, 0, 0);
    }

    .navbar-brand,
    .nav-link {
        color: white !important;
    }

    /* การตั้งค่าสไตล์ของ Section */
    .hero-section {
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 40px;
        background: rgba(0, 0, 0, 0);
    }

    .hero-section h1 {
        font-size: 50px;
        font-weight: bold;
    }

    .hero-section p {
        font-size: 20px;
        font-weight: lighter;
    }

    .btn-custom {
        background-color: rgb(45, 126, 231);
        color: white;
        border-radius: 20px;
        padding: 10px 30px;
        text-decoration: none;
        margin: 10px;
    }

    /* การตั้งค่า Footer */
    .footer {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        text-align: center;
        padding: 20px 0;
    }

    button {
        width: 200px;
    }
</style>
<?php if (isset($_SESSION['timestamp'])):
    while ($row = $data['result']->fetch_object()) { ?>
        <h2>สวัสดีคุณ <?= $row->name ?> <?= $row->email ?></h2>
    <?php
    }?>
<?php else: ?>

    <body>
        <section class="hero-section">
            <div>
                <h1>ยินดีต้อนรับสู่เว็บไซต์ของเรา!</h1>
                <p>เราพร้อมที่จะให้บริการคุณด้วยประสบการณ์ที่ดีที่สุด</p>
                <button onclick="window.location.href='/login'" class="btn-custom">Login</button>
                <!-- ลิงก์ไปที่หน้าสมัครสมาชิก -->
                <button onclick="window.location.href='/register'" class="btn-custom">Register</button>
            </div>
        </section>
    </body>
<?php endif; ?>