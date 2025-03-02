<section class=" container my-5">
    <h2 class="text-primary mb-3">คำขอเข้าร่วมกิจกรรม</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="bg-warning text-white">
                <tr>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ</th>
                    <th>เพศ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['user'] as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['age']) ?></td>
                        <td><?= htmlspecialchars($user['gender']) ?></td>
                        <td>
                            <a href="/Accept_user?user_id=<?= htmlspecialchars($data['result']['user_id']) ?>"
                                onclick="return confirmSubmission()"
                                class="btn btn-danger btn-sm">
                                อนุมัติ
                            </a>
                            <a href="/Cancel_user?user_id=<?= htmlspecialchars($data['result']['user_id']) ?>"
                                onclick="return confirmSubmission()"
                                class="btn btn-danger btn-sm">
                                ปฏิเสธ
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    function confirmSubmission() {
        return confirm("คุณต้องการถอนรายวิชานี้หรือไม่?");
    }
</script>
