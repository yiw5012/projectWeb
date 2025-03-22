

<section class=" container my-5">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <h2 class="text-primary mb-3">คำขอเข้าร่วมกิจกรรม</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="bg-warning text-white">
                <tr>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ</th>
                    <th>เพศ</th>
                    <th>กิจกรรม</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $data['statistics']) {}?>

    
            <?php while ($row = $data['result']->fetch_object()): ?>
                <tr>
                        <td><?= $row->name ?></td>
                        <td><?= $row->age ?></td>
                        <td><?= $row->gender ?></td>
                        <td><?= $row->title_event ?></td>
                        <td>
                            <!-- <a href="/Accept_user?user_id=<?= $row->user_id  ?>"
                                onclick="return confirmSubmission()"
                                class="btn btn-success btn-sm">
                                อนุมัติ
                            </a> -->
                            <form action="accept" method="post">
                            <input type="hidden" value="<?= $row->event_id?>" name="event_id">
                            <input type="hidden" value="<?= $row->user_id?>" name="user_id">
                            <button type="submit" name="case" value="1" class="btn btn-success btn-sm" onclick="return confirmSubmission()">ยอมรับ</button>
                            <button type="submit" name="case" value="2" class="btn btn-danger btn-sm" onclick="return confirmSubmission()">ปฏิเสธ</button>

                            </form>
                            <!-- <a href="/Cancel_user?user_id=<?= $row->user_id ?>"
                                onclick="return confirmSubmission()"
                                class="btn btn-danger btn-sm">
                                ปฏิเสธ
                            </a> -->
                        </td>

                    </tr>
                    <?php endwhile; ?>
                    </tbody>
        </table>
    </div>

    <div class="container mt-4">
    <canvas id="barChart"></canvas>
    </div>


</section>

<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Male', 'Female', 'old_avg'],
            datasets: [{
                label: 'Number of People',
                data: [<?= $$statistics[0] ?>, <?= $$statistics[1] ?>, <?= $$statistics[2] ?>],
                backgroundColor: ['blue', 'pink', 'red'] // change color here
                
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

<script>
    function confirmSubmission() {
        return confirm("คุณยืนยันจะทำรายการต่อไปนี้ ใช่ไหม?");
    }
</script>
