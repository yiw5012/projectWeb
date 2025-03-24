<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --hover-color: #1d4ed8;
        }

        body {
            background: #f8fafc;
            font-family: 'Kanit', sans-serif;
        }

        .form-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .upload-section {
            height: 300px;
            border: 2px dashed #cbd5e1;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .upload-section:hover {
            border-color: var(--primary-color);
            background: #f1f5f9;
        }

        .upload-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .preview-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
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

        .btn-submit {
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-submit:hover {
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

<body>
    <div class="container">
        <div class="form-container">
            <form action="createact" method="post" enctype="multipart/form-data">
                <div class="row g-0">
                    <!-- Image Upload Section -->
                    <div class="col-lg-5">
                        <div class="upload-section" onclick="document.getElementById('images').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="text-center text-muted">
                                คลิกเพื่ออัปโหลดรูปภาพ<br>
                                <small>(รองรับ JPG, PNG ขนาดไม่เกิน 5MB)</small>
                            </div>
                            <input type="file" id="images" name="images[]" multiple hidden
                                accept="image/*" onchange="previewImages(event)">
                        </div>
                        <div class="image-preview-container" id="imagePreview"></div>
                    </div>

                    <!-- Event Details -->
                    <div class="col-lg-7 p-5">
                        <h2 class="mb-4 text-center fw-bold">สร้างกิจกรรม</h2>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">ชื่อกิจกรรม</label>
                                <input type="text" class="form-control" name="actname" required
                                    placeholder="กรอกชื่อกิจกรรม">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">รายละเอียดกิจกรรม</label>
                                <textarea class="form-control" name="detailact" rows="4"
                                    placeholder="อธิบายรายละเอียดกิจกรรม..."
                                    style="resize: vertical"></textarea>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">สถานที่จัดกิจกรรม</label>
                                <input type="text" class="form-control" name="location" required
                                    placeholder="กรอกสถานที่">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">วันที่จัดกิจกรรม</label>
                                <input type="date" class="form-control" name="dateevent" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">จำนวนที่รับ</label>
                            <input type="number" class="form-control" name="maxregister" required
                                placeholder="กรอกจำนวนผู้เข้าร่วม">
                        </div>


                        <input type="hidden" name="user_id" value="<?= $_SESSION['student_id'] ?>">

                        <button type="submit" class="btn-submit w-100 mt-4">
                            <i class="fas fa-plus-circle me-2"></i>สร้างกิจกรรม
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImages(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';

            const files = event.target.files;
            for (const file of files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-image');
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>