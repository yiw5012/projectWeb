<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .upload-section {
            height: 300px;
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: #f8f9fa;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .upload-section:hover {
            border-color: #0d6efd;
            background: #f1f8ff;
        }

        .preview-container img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 10px;
        }

        .carousel-item img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <?php while ($row = $data['result']->fetch_object()): ?>

                <div class="col-lg-8">
                    <h1 class="mb-4 text-center text-primary">แก้ไขกิจกรรม</h1>
                    <form action="EditAct" method="post" enctype="multipart/form-data" class="p-4 shadow bg-white rounded">

                        <!-- อัปโหลดรูปภาพ -->
                        <div class="mb-3 text-center">
                            <div class="upload-section" onclick="document.getElementById('image').click()">
                                <div id="uploadText" class="text-muted">
                                    <i class="bi bi-cloud-upload fs-1"></i><br>
                                    คลิกเพื่ออัปโหลดรูปภาพ
                                </div>
                            </div>
                            <input type="file" id="image" name="images[]" accept="image/*" multiple onchange="previewImage(event)" hidden>
                            <input type="hidden" name="old_image" value="<?= $row->images ?>">

                            <div class="preview-container">
                                <img id="previewImage" src="" style="display: none;">
                            </div>
                        </div>

                        <!-- แสดงภาพทั้งหมดเป็นแกลเลอรี -->
                        <?php $images = explode(',', $row->images); ?>
                        <div id="imageCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($images as $index => $image): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= $image ?>" class="d-block w-100">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>

                        <!-- ฟอร์มข้อมูลกิจกรรม -->
                        <div class="mb-3">
                            <label class="form-label">ชื่อกิจกรรม</label>
                            <input name="title" type="text" class="form-control" value="<?= $row->title_event ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">รายละเอียด</label>
                            <textarea name="detil" class="form-control" rows="4"><?= $row->description ?></textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">สถานที่จัดกิจกรรม</label>
                                <input name="localion" type="text" class="form-control" value="<?= $row->location ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">วันที่จัดกิจกรรม</label>
                                <input name="date_time" id="date_time" type="text" class="form-control" value="<?= $row->date_time ?>" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label class="form-label">วันที่เปิดลงทะเบียน</label>
                                <input type="text" class="form-control" value="<?= $row->date_reg ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">จำนวนที่รับ</label>
                                <input name="max" type="number" class="form-control" value="<?= $row->max_capacity ?>" required>
                            </div>
                        </div>

                        <input name="id" type="hidden" value="<?= $row->event_id ?>">

                        <button type="submit" class="btn btn-success w-100 mt-4">ยืนยันการแก้ไข</button>
                    </form>
                </div>

            <?php endwhile; ?>
        </div>
    </div>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // ฟังก์ชันแสดงตัวอย่างรูปภาพ
        function previewImage(event) {
            var files = event.target.files;
            var preview = document.getElementById('previewImage');
            var uploadText = document.getElementById('uploadText');

            if (files.length > 0) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    uploadText.style.display = 'none';
                };
                reader.readAsDataURL(files[0]);
            }
        }

        // ใช้ Flatpickr เพื่อเลือกวันที่และเวลา
        flatpickr("#date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            locale: "th"
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
