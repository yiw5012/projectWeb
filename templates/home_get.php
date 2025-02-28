<section class="container mt-4">
    <div class="text-center">
        <?php if (isset($_SESSION['timestamp'])) { ?>
            <h4 class="alert alert-success">
                สวัสดี, <?= ($data['result']['first_name'].' '.$data['result']['last_name']) ?> 🎉
            </h4>
        <?php } else { ?>
            <h1 class="alert alert-primary">ยินดีต้อนรับ 👋</h1>
        <?php } ?>
    </div>
</section>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
