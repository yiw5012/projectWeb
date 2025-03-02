<?php
?>
<!DOCTYPE html>
<html lang="th">

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
        <div class="row g-5">
            <?php while ($row = $data['result']->fetch_object()): ?>

                <div class="col-lg-4">
                    <div class="upload-section" onclick="document.getElementById('fileInput').click()">
                        <img id="previewImage" class="img-fluid">
                        <div id="uploadText" class="text-center text-muted">
                            <i class="bi bi-cloud-upload fs-1"></i><br>
                            คลิกเพื่ออัปโหลดรูปภาพ
                        </div>
                    </div>
                    <input type="file" id="fileInput" hidden accept="image/*" onchange="previewImage(event)">
                </div>

                <div class="col-lg-8">
                    <h1 class="mb-4 text-center">แก้ไขกิจกรรม</h1>
                    <form>

                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label class="form-label">ชื่อกิจกรรม</label>
                                <input type="text" class="form-control" value="<?= $row->title_event ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">รายละเอียด</label>
                            <input
                                type="text"
                                class="form-control"
                                value="<?= $row->description ?>" ;
                                rows="5"
                                style="min-height: 120px; resize: vertical;">
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">สถานที่จัดกิจกรรม</label>
                                <input value="<?= $row->location ?>" ;
                                    type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">วันที่จัดกิจกรรม</label>
                                <input value="<?= $row->date_time ?>" ;
                                    type="date" class="form-control" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">data_for_register</label>
                                <input type="" value="<?= $row->date_reg ?>" ;
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">จำนวที่รับ</label>
                                <input value="<?= $row->max_capacity ?>" ;
                                    type="number" class="form-control" required>
                            </div>
                        </div>

                    <?php endwhile; ?>


                    <button type="submit" class="btn btn-success w-100 py-2">ยืนยันการแก้ไข้</button>

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