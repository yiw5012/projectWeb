<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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
            position: relative;
        }

        .delete-image {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(255,0,0,0.7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
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

<body >
    <div class="container">
        <div class="form-container">
            <?php while ($row = $data['result']->fetch_object()): ?>
            <form action="editact" method="post" enctype="multipart/form-data">
                <div class="row g-0">
                    <!-- Image Upload Section -->
                    <div class="col-lg-5">
                        <div class="upload-section" onclick="document.getElementById('images').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="text-center text-muted">
                                คลิกเพื่ออัปโหลดรูปภาพใหม่<br>
                                <small>(รองรับ JPG, PNG ขนาดไม่เกิน 5MB)</small>
                            </div>
                            <input type="file" id="images" name="images[]" multiple hidden 
                                   accept="image/*" onchange="previewImages(event)">
                        </div>
                        <div class="image-preview-container" id="imagePreview">
                            <?php 
                            $images = explode(',', $row->images);
                            foreach ($images as $image): ?>
                                <div class="preview-item">
                                    <img src="<?= $image ?>" class="preview-image">
                                    <div class="delete-image" onclick="deleteExistingImage(this)">×</div>
                                    <input type="hidden" name="existing_images[]" value="<?= $image ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="col-lg-7 p-5">
                        <h1 class="text-center mb-5 fw-bold">แก้ไขกิจกรรม</h1>
                        
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label">ชื่อกิจกรรม</label>
                                <input type="text" class="form-control" name="title" 
                                       value="<?= $row->title_event ?>" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">รายละเอียดกิจกรรม</label>
                                <textarea class="form-control" name="detil" rows="4"><?= $row->description ?></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">สถานที่จัดกิจกรรม</label>
                                <input type="text" class="form-control" name="localion" 
                                       value="<?= $row->location ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">วันที่จัดกิจกรรม</label>
                                <input type="text" class="form-control" id="date_time" 
                                       name="date_time" value="<?= $row->date_time ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">จำนวนที่รับ</label>
                                <input type="number" class="form-control" name="max" 
                                       value="<?= $row->max_capacity ?>" required>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?= $row->event_id ?>">

                        <button type="submit" class="btn-submit w-100 mt-4">
                            <i class="fas fa-save me-2"></i>บันทึกการเปลี่ยนแปลง
                        </button>
                    </div>
                </div>
            </form>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr
        flatpickr("#date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            locale: "th"
        });

        // Image Preview Function
        function previewImages(event) {
            const previewContainer = document.getElementById('imagePreview');
            const files = event.target.files;

            for (const file of files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="preview-image">
                        <div class="delete-image" onclick="deleteImage(this)">×</div>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        }

        // Delete Image Function
        function deleteImage(element) {
            element.parentElement.remove();
        }

        function deleteExistingImage(element) {
            const item = element.closest('.preview-item');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleted_images[]';
            input.value = item.querySelector('img').src;
            document.querySelector('form').appendChild(input);
            item.remove();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>