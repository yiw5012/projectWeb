<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --hover-color: #1d4ed8;
            --background: #f8fafc;
        }

        body {
            background: var(--background);
            font-family: 'Kanit', sans-serif;
        }

        .form-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .upload-section {
            height: 100%;
            min-height: 400px;
            border-right: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .upload-section:hover {
            background: #f1f5f9;
        }

        .upload-section:hover .upload-icon {
            transform: translateY(-5px);
        }

        #previewImage {
            max-width: 100%;
            max-height: 300px;
            border-radius: 1rem;
            display: none;
            object-fit: cover;
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .upload-text {
            color: #64748b;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #64748b;
        }

        .btn-register {
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-register:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
        }
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
    </style>
</head>
<body">
    <div class="container">
        <div class="form-container">
            <form action="register" method="post" enctype="multipart/form-data">
                <div class="row g-0">
                    <!-- Image Upload Section -->
                    <div class="col-lg-5">
                        <div class="upload-section" onclick="document.getElementById('image').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                อัปโหลดรูปโปรไฟล์<br>
                                <small class="text-muted">(รองรับ JPG, PNG ขนาดไม่เกิน 5MB)</small>
                            </div>
                            <img id="previewImage">
                            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" hidden>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <div class="col-lg-7 p-5">
                        <h2 class="mb-4 text-center fw-bold">สมัครสมาชิก</h2>
                        
                        <!-- Name Inputs -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">ชื่อ - สกุล</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input name="name" type="text" class="form-control ps-5" placeholder="กรอกชื่อ" required>
                                </div>
                            </div>
                        </div>
                        <!-- Email Input -->

                        <!-- Additional Info -->
                        <div class="row g-3 mb-4">
                            <!-- <div class="col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <div class="input-icon">
                                    <i class="fas fa-phone"></i>
                                    <input name="phone" type="tel" class="form-control ps-5" placeholder="081-234-5678" required>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <label class="form-label">อายุ</label>
                                <input name="age" type="number" class="form-control" min="1" max="100" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">เพศ</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">เลือก</option>
                                    <option value="male">ชาย</option>
                                    <option value="female">หญิง</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">อีเมล</label>
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                                <input name="email" type="email" class="form-control ps-5" placeholder="email" required>
                            </div>
                        </div>

                        <!-- Password Inputs -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">รหัสผ่าน</label>
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                    <input name="password" type="password" id="password" class="form-control ps-5"placeholder="password" required>
                                    
                                </div>
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ยืนยันรหัสผ่าน</label>
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                    <input name="confirm_password" type="password" id="confirm_password" class="form-control ps-5"placeholder="password" required>
                                    
                                </div>
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('confirm_password')"></i>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-register w-100">สร้างบัญชีผู้ใช้</button>

                        <!-- Login Link -->
                        <div class="mt-4 text-center">
                            มีบัญชีอยู่แล้ว? 
                            <a href="#" class="text-decoration-none fw-bold" style="color: var(--primary-color);">เข้าสู่ระบบ</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('previewImage');
            const uploadText = document.querySelector('.upload-text');

            reader.onload = function() {
                preview.style.display = 'block';
                preview.src = reader.result;
                uploadText.style.display = 'none';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = passwordField.nextElementSibling;
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>