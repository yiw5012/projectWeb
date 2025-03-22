<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: white;
            padding: 20px;
            transition: box-shadow 0.3s ease-in-out;
        }

        .section-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .user-info-section {
            background-color: #f8f9fa;
            text-align: center;
            padding: 30px;
            border-radius: 8px;
        }

        .user-info-section img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .section-title {
            color: #2d3436;
            border-bottom: 2px solid #74b9ff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .activity-list {
            padding-left: 1rem;
        }

        /* ปรับรูปแบบปุ่ม */
        .btn-primary,
        .btn-warning {
            font-size: 1rem;
            padding: 8px 16px;
            width: 100%;
            text-align: center;
        }

        .btn-primary {
            background-color: #0984e3;
            border-color: #0984e3;
        }

        .btn-primary:hover {
            background-color: #74b9ff;
            border-color: #74b9ff;
        }

        .btn-warning {
            background-color: #f39c12;
            border-color: #f39c12;
        }

        .btn-warning:hover {
            background-color: #f1c40f;
            border-color: #f1c40f;
        }

        .list-group-item {
            font-size: 1.1rem;
            padding: 15px;
            border: none;
            background-color: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .button {
            width: 100px;
            background: rgb(248, 236, 5);
            line-height: 40px;
            border-radius: 20px;
            padding: 0px 20px;
            border: none;
            margin: 10px 0px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row g-4">
            <?php while ($row = $data['user']->fetch_object()): ?>
                <div class="col-md-4">
                    <div class="section-card user-info-section">
                        <img src="<?= $row->image ?>" alt="Profile Image">
                        <h5 class="mt-3"><?= $row->name ?></h5>
                        <p class="text-muted">Email: <?= $row->email ?></p>
                        <p class="text-muted">เพศ: <?= $row->gender ?> | อายุ: <?= $row->age ?></p>
                        <button class="btn btn-primary mt-2" name="editprofile" value="<?= $row->user_id ?>">แก้ไขข้อมูล</button>
                        <a class="btn btn-warning mt-2" href="/request">Request</a>

                        <h3 class="section-title mt-4">กิจกรรมที่ขอเข้าร่วม</h3>
                        <ul class="list-group">
                            <?php
                            if ($data['ever_pending'] && $data['ever_pending']->num_rows > 0) {
                                while ($row = $data['ever_pending']->fetch_object()) { ?>
                                    <li class="list-group-item text-danger"><?= $row->title_event ?></li>
                            <?php }
                            } else {
                                echo "<li class='list-group-item text-danger'>ไม่มีข้อมูลกิจกรรมที่ขอเข้าร่วม</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php endwhile; ?>

            <div class="col-md-4">
                <div class="section-card">
                    <h3 class="section-title mt-4">กิจกรรมที่เข้าร่วม</h3>
                    <ul class="list-group">
                    <?php
                        if ($data['everevent'] && $data['everevent']->num_rows > 0) {
                            while ($row = $data['everevent']->fetch_object()) {
                                $s = $row->user_id;
                                $f = $row->event_id;
                                $result = otp_for_user($s, $f);
                        ?>
                                <li class="list-group-item">
                                <?php
                               
                               if (empty($row->images)) {
                                   echo "<p class='text-danger'>ไม่มีรูปภาพ</p>";
                                   $images = []; // กำหนดเป็นอาร์เรย์ว่างเพื่อป้องกันข้อผิดพลาด
                               } else {
                                   $images = explode(',', $row->images);
                               }
                          
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
                                    <strong>✅ <?= $row->title_event ?></strong><br>
                                    📅 <strong>วันที่:</strong> <?= $row->date_time ?><br>
                                    📍 <strong>สถานที่:</strong> <?= $row->location ?><br>
                                    📝 <strong>รายละเอียด:</strong> <?= $row->description ?><br>
                                    [OTP] <?= $result['otp_used'] ?? 'ไม่มี OTP'; ?>
                                </li>
                        <?php
                            }
                        } else {
                            echo "<li class='list-group-item'>ไม่มีข้อมูลกิจกรรมที่เข้าร่วม</li>";
                        }
                        ?>
                    </ul>

                    <h3 class="section-title mt-4">กิจกรรมที่โดนปฎิเสธ</h3>
                    <ul class="list-group">
                        <?php
                        if ($data['ever_rejected'] && $data['ever_rejected']->num_rows > 0) {
                            while ($row = $data['ever_rejected']->fetch_object()) { ?>
                                <li class="list-group-item text-danger">❌ <?= $row->title_event ?></li>
                                 <li class="list-group-item text-danger">
                                 <?php
                               
                               if (empty($row->images)) {
                                   echo "<p class='text-danger'>ไม่มีรูปภาพ</p>";
                                   $images = []; // กำหนดเป็นอาร์เรย์ว่างเพื่อป้องกันข้อผิดพลาด
                               } else {
                                   $images = explode(',', $row->images);
                               }
                          
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
                                    <strong>❌ <?= $row->title_event ?></strong><br>
                                    📅 <strong>วันที่:</strong> <?= $row->date_time ?><br>
                                    📍 <strong>สถานที่:</strong> <?= $row->location ?><br>
                                    📝 <strong>รายละเอียด:</strong> <?= $row->description ?><br>
                                    [OTP] <?= $result['otp_used'] ?? 'ไม่มี OTP'; ?>
                                </li>
                        <?php }
                        } else {
                            echo "<li class='list-group-item text-danger'>ไม่มีข้อมูลกิจกรรมที่โดนปฎิเสธ</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

 <div class="col-md-4">
    <div class="section-card" >
        <h3 class="section-title">กิจกรรมที่สร้าง</h3>
        <ul class="list-group">
            <?php
            if ($data['allevent'] && $data['allevent']->num_rows > 0) {
                while ($row = $data['allevent']->fetch_object()) { ?>
                    <li class="list-group-item" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                        <div>
                            <!-- แสดงภาพกิจกรรม -->
                            <?php
                               
                               if (empty($row->images)) {
                                   echo "<p class='text-danger'>ไม่มีรูปภาพ</p>";
                                   $images = []; // กำหนดเป็นอาร์เรย์ว่างเพื่อป้องกันข้อผิดพลาด
                               } else {
                                   $images = explode(',', $row->images);
                               }
                          
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
                            📌 <?= $row->title_event ?><br>
                            📅 <strong>วันที่:</strong> <?= $row->date_time ?><br>
                            📍 <strong>สถานที่:</strong> <?= $row->location ?><br>
                            📝 <strong>รายละเอียด:</strong> <?= $row->description ?>
                        </div>
                    </li>
                    <div>
                        <a href="/editact?event_id=<?= $row->event_id ?>" class="btn btn-warning button" style="width: 100px;">แก้ไข</a>
                        <a href="/check?event_id=<?= $row->event_id ?>" class="btn btn-warning button" style="width: 100px;">เช็คOTP</a>
                        <a href="/detil?event_id=<?= $row->event_id ?>" class="btn btn-warning button" style="width: 100px;">รายละเอียด</a>


                        </div>

                <?php }
            } else {
                echo "<li class='list-group-item'>ไม่มีข้อมูลกิจกรรมที่สร้าง</li>";
            }
            ?>
        </ul>
    </div>
</div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>