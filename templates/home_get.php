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

        .input {
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

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card img,
        .carousel-inner img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            /* ป้องกันภาพผิดสัดส่วน */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            flex-grow: 1;
            /* ทำให้การ์ดขยายเท่ากัน */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .btn {
            width: 48%;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['timestamp'])): ?>
        <section>
            <h2 class="text-center mb-4">กิจกรรมที่เข้าร่วมได้</h2>
            <form action="home" method="get" style="display: flex; align-items: center;  max-width: 500px; margin-left: 20px; border: 1px solid #ddd; border-radius: 5px; padding: 5px;">
                <select  name="search_type" style="border: none; background: transparent; padding: 5px;">
                    <option value="title">ค้นหาตามชื่อกิจกรรม</option>
                    <option value="date">ค้นหาตามเวลากิจกรรม</option>
                </select>
                <input type="text" name="keyword" placeholder="ค้นหา..." style="flex: 1; border: none; padding: 5px; outline: none;">
                <button type="submit" style="background: orange; border: none; padding: 5px 10px; cursor: pointer;">
                    🔍
                </button>
            </form>
            <br>
            <div class="container">
                <div class="row">
                    <?php while ($row = $data['events']->fetch_object()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-lg">
                                <?php
                                $images = explode(',', $row->images); // แยกภาพ
                                ?>
                                <div id="carousel<?= $row->event_id ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($images as $index => $image): ?>
                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                <img src="<?= $image ?>" class="d-block w-100 img-thumbnail" alt="Event Image">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if (count($images) > 1): ?>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?= $row->event_id ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?= $row->event_id ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
                                    <?php endif; ?>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title"><?= $row->title_event ?></h5>
                                    <p class="card-text"><?= $row->description ?></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>รหัสกิจกรรม:</strong> <?= $row->event_id ?></li>
                                        <li class="list-group-item"><strong>เวลากิจกรรม:</strong> <?= $row->date_time ?></li>
                                        <li class="list-group-item"><strong>สถานที่:</strong> <?= $row->location ?></li>
                                        <li class="list-group-item"><strong>จำนวนคน:</strong> <?= $row->max_capacity ?></li>
                                        <li class="list-group-item"><strong>ผู้สร้าง:</strong> <?= $row->created_by ?></li>
                                    </ul>
                                    <div class="mt-3 d-flex justify-content-between">
                                        <a href="/registration?event_id=<?= $row->event_id ?>" class="btn btn-primary">เข้าร่วมกิจกรรม</a>
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
                <button onclick="window.location.href='/login'" class="btn-custom">Loginn</button>
                <button onclick="window.location.href='/register'" class="btn-custom">Register</button>
            </div>
        </section>
    <?php endif; ?>

    <footer class="footer">
        <p>© 2025 เว็บไซต์ของเรา</p>
    </footer>
</body>

</html>