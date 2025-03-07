<?php
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        <form action="register" method="post" enctype="multipart/form-data">
            <div class="row g-5 align-items-center">
                <!-- ส่วนซ้าย - อัปโหลดรูปภาพ -->
                <div class="col-lg-4">
                    <div class="upload-section" onclick="document.getElementById('image').click()">
                        <img id="previewImage" class="img-fluid">
                        <div id="uploadText" class="text-center text-muted">
                            <i class="bi bi-cloud-upload fs-1"></i><br>
                            คลิกเพื่ออัปโหลดรูปภาพ
                        </div>
                    </div>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" hidden>
                </div>

                <!-- ส่วนขวา - ฟอร์มสมัครสมาชิก -->
                <div class="col-lg-8">
                    <h1 class="mb-4 text-center">Sign Up</h1>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">ชื่อ</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">นามสกุล</label>
                            <input name="lastname" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">อีเมล</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">เบอร์โทรศัพท์</label>
                            <input name="phone" type="tel" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">อายุ</label>
                            <input name="age" type="number" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">เพศ</label>
                            <select name="gender" class="form-select" required>
                                <option value="">เลือกเพศ</option>
                                <option value="male">ชาย</option>
                                <option value="female">หญิง</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">รหัสผ่าน</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ยืนยันรหัสผ่าน</label>
                            <input name="confirm_password" type="password" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2">ลงทะเบียน</button>

                    <div class="mt-3 text-center">
                        มีบัญชีอยู่แล้ว? <a href="#" class="text-decoration-none">Login</a>
                    </div>
                </div>
            </div>
        </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>