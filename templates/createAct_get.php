<?php
// session_start();
// require_once 'config.php'; // ควรมีไฟล์ config สำหรับเชื่อมต่อฐานข้อมูล
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
        .upload-section:hover {
            border-color: #0d6efd;
            background: #f1f8ff;
        }
        #previewImage {
            max-width: 100%;
            max-height: 280px;
            display: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row g-5">
            <!-- ส่วนซ้าย - อัปโหลดรูปภาพ -->
            <div class="col-lg-4">
                <div class="upload-section" onclick="document.getElementById('fileInput').click()">
                    <img id="previewImage" class="img-fluid">
                    <div id="uploadText" class="text-center text-muted">
                        <i class="bi bi-cloud-upload fs-1"></i><br>
                        คลิกเพื่ออัปโหลดรูปภาพ
                    </div>
                </div>
                <input type="file" id="fileInput" hidden accept="image/*" onchange="previewImage(event)" name="image">
            </div>

            <!-- ส่วนขวา - ฟอร์มสร้างกิจกรรม -->
            <div class="col-lg-8">
                <h1 class="mb-4 text-center">สร้างกิจกรรม</h1>
                <form action="createAct" method="post">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['student_id'] ?>">

                    <!-- ชื่อกิจกรรม -->
                    <div class="mb-3">
                        <label class="form-label h5">ชื่อกิจกรรม</label>
                        <input type="text" class="form-control" name="actname" id="actname" required>
                    </div>

                    <!-- รายละเอียด -->
                    <div class="mb-3">
                        <label class="form-label h5">รายละเอียดกิจกรรม</label>
                        <textarea 
                            class="form-control" 
                            name="detailact" 
                            id="detailact"
                            rows="5"
                            style="min-height: 120px; resize: vertical;"
                            required
                        ></textarea>
                    </div>

                    <!-- สถานที่และวันที่ -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label h5">สถานที่จัดกิจกรรม</label>
                            <input type="text" class="form-control" name="location" id="location" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label h5">วันที่จัดกิจกรรม</label>
                            <input type="date" class="form-control" name="dateevent" id="dateevent" required>
                        </div>
                    </div>

                    <!-- ข้อมูลลงทะเบียน -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label h5">ข้อมูลการลงทะเบียน</label>
                            <input type="text" class="form-control" name="dateregisterend" id="dateregisterend" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label h5">จำนวนที่รับ</label>
                            <input type="number" class="form-control" name="maxregister" id="maxregister" required>
                        </div>
                    </div>

                    <!-- ปุ่มส่งฟอร์ม -->
                    <button type="submit" class="btn btn-primary w-100 py-2">สร้างกิจกรรม</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('previewImage');
            const uploadText = document.getElementById('uploadText');

            reader.onload = function() {
                preview.style.display = 'block';
                preview.src = reader.result;
                uploadText.style.display = 'none';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>