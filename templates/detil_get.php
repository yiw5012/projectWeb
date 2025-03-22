<?php
// สมมติว่าคุณได้รับข้อมูลจากฐานข้อมูลใน $data['statistics']
$report_data = []; // เริ่มต้นเป็นอาร์เรย์เปล่า

// ตรวจสอบว่ามีข้อมูลสถิติหรือไม่
if (isset($data['statistics']) && is_array($data['statistics'])) {
    $male = $data['statistics']['male'] ?? 0;
    $female = $data['statistics']['female'] ?? 0;
    $avg_age = $data['statistics']['avg_age'] ?? 0;

    // แสดงข้อมูลเบื้องต้น
    echo "<h3>ข้อมูลสถิติ</h3>";
    echo "จำนวนผู้ชาย: " . $male . "<br>";
    echo "จำนวนผู้หญิง: " . $female . "<br>";
    echo "อายุเฉลี่ย: " . $avg_age . "<br>";

    // สร้างข้อมูลสำหรับกราฟ
    // สำหรับตัวอย่างนี้ เราจะใช้ male, female, avg_age เพื่อแสดงในกราฟ
    $report_data[] = "
        {
            name: 'Male',
            y: $male
        },
        {
            name: 'Female',
            y: $female
        },
        {
            name: 'Average Age',
            y: $avg_age
        }
       
    ";
} else {
    echo "ไม่พบข้อมูลสถิติ.";
}

// รวมข้อมูลทั้งหมดที่เก็บในอาร์เรย์
$report_data = implode(",", $report_data);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Column Drilldown Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <hr>
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">.</p>
                </figure>
                <script>
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'ข้อมูลสถิติคนเข้าร่วมกิจกรรม'
                        },
                        subtitle: {
                            text: 'จากข้อมูลที่ได้รับ'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'จำนวน'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.2f}'
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                        },
                        series: [{
                            name: 'ข้อมูลสถิติ',
                            colorByPoint: true,
                            data: [<?= $report_data; ?>]
                        }]
                    });
                </script>
            </div>
        </div>
    </div>
    <p align="center">https://www.highcharts.com/demo/column-drilldown <br> คอร์สออนไลน์ราคาถูก <a href="https://devbanban.com/?cat=250">คลิก.</a></p>
</body>
</html>
