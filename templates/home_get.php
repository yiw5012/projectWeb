<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&family=Prompt:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- เชื่อมโยง Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>เว็บไซต์ของเรา</title>
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
  .button {
            width: 100px;
        background: rgb(255, 255, 255);
        line-height: 40px;
        border-radius: 20px;
        padding: 0px 20px;
        border: none;
        margin: 10px 0px;
    }
    .input{
        background: rgba(255, 255, 255, 0.3);
        height: 40px;
        line-height: 40px;
        border-radius: 20px;
        padding: 0px 20px;
        border: none;
        margin-bottom: 20px;
        color: white;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: white;
    }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['timestamp'])): ?>
        <section>
    <h2 class="text-center mb-4">กิจกรรมที่เข้าร่วมได้</h2>
        <form  style="margin-left: 100px;;" action="home" method="get">
        <input class="input" type="text" name="keyword" />
        <button class="button" type="submit">Search</button>
    </form>
    <br>
    <div class="container">
        <div class="row">
            <?php while ($row = $data['events']->fetch_object()): ?>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title"> <?= $row->title_event ?> </h5>
                            <p class="card-text"> <?= $row->description ?> </p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>รหัสกิจกรรม:</strong> <?= $row->event_id ?></li>
                                <li class="list-group-item"><strong>เวลากิจกรรม:</strong> <?= $row->date_time ?></li>
                                <li class="list-group-item"><strong>สถานที่:</strong> <?= $row->location ?></li>
                                <li class="list-group-item"><strong>จำนวนคน:</strong> <?= $row->max_capacity ?></li>
                                <li class="list-group-item"><strong>ผู้สร้าง:</strong> <?= $row->created_by ?></li>
                            </ul>
                            <div class="mt-3 text-center">
                                <a href="/registration?event_id=<?= $row->event_id ?>" class="btn btn-primary">เข้าร่วมกิจกรรม</a>
                            <a href="/EditAct?event_id=<?= $row->event_id ?>" class="btn btn-primary">แก้ไขกิจกรรม</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

    <?php else: ?>
        <section class="hero-section">
            <div>
                <h1>ยินดีต้อนรับสู่เว็บไซต์ของเรา!</h1>
                <p>เราพร้อมที่จะให้บริการคุณด้วยประสบการณ์ที่ดีที่สุด</p>
                <button onclick="window.location.href='/login'" class="btn-custom">Login</button>
                <button onclick="window.location.href='/register'" class="btn-custom">Register</button>
            </div>
        </section>
    <?php endif; ?>

    <footer class="footer">
        <p>© 2025 เว็บไซต์ของเรา</p>
    </footer>
</body>

</html>
