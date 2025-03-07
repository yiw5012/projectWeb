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
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }
        .user-info-section {
            background-color: #f8f9fa;
            position: relative;
            padding-bottom: 50px;
        }
        .student-tag {
            position: absolute;
            bottom: 15px;
            right: 15px;
            font-size: 0.9rem;
        }
        .section-title {
            color: #2d3436;
            border-bottom: 2px solid #74b9ff;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .activity-list {
            list-style-type: '- ';
            padding-left: 1.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row g-4">
            <!-- ข้อมูลผู้ใช้ -->
            <div class="col-md-4">
                <div class="section-card user-info-section p-4">
                <img src="https://c.files.bbci.co.uk/16F65/production/_107335049_epahi054463889.jpg" alt="Profile Picture" class="img-fluid w-100 mb-3" style="border-radius: 8px;">
                    <div class="row">
                        <div class="col-md-8">
                            <dl class="row mb-0">
                                <dt class="col-sm-5">ชื่อ: </dt>
                                <dd class="col-sm-7">-----</dd>

                                <dt class="col-sm-5">อีเมล:</dt>
                                <dd class="col-sm-7">------</dd>

                                <dt class="col-sm-5">เบอร์โทร:</dt>
                                <dd class="col-sm-7">-------</dd>

                                <dt class="col-sm-5">อายุ:</dt>
                                <dd class="col-sm-7">-------</dd>

                                <dt class="col-sm-5">เพศ:</dt>
                                <dd class="col-sm-7">-------</dd>
                            </dl>
                        </div>
                    </div>
                    <button class="student-tag badge bg-primary">แก้ไข้</button>
                </div>
            </div>

            <!-- กิจกรรมที่เข้าร่วม -->
            <div class="col-md-4">
                <div class="section-card p-4 bg-white">
                    <h3 class="section-title">กิจกรรมที่เข้าร่วม</h3>
                    <!-- <ul class="activity-list">
                        <li class="mb-2"><strong>ดนตรีในสวน H.M. Song</strong></li>
                        <li><strong>อว.บรรเลขเพลชออฟต์</strong></li>
                    </ul> -->
                </div>
            </div>

            <!-- กิจกรรมที่สร้าง -->
            <div class="col-md-4">
                <div class="section-card p-4 bg-white">
                    <h3 class="section-title">กิจกรรมที่สร้าง</h3>
                    <!-- <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action border-0 py-2">“โครงการร่วมบริษัทโลหิ��”</a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-2">รายละเอียดที่ของผู้จัด</a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-2 text-danger">แก้ไข</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
