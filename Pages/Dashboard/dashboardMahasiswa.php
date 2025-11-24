<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    require_once "../../SQL/connection.php";
    require_once "../../config.php";
    require_once "../../Utils/encryption.php";
    require_once "../../Utils/gradeUtil.php";
    ?>
    <div id="main">
        <div id="overview">
            <a href="../Mahasiswa/" class="cards">
                <h1 class="cardTitle">Jumlah Mahasiswa</h1>
                <h1 class="count">
                    <?php
                    $getTotalMhs = $con->query("SELECT COUNT(*) AS total FROM mahasiswa;");
                    $getTotalMhs = $getTotalMhs->fetch_assoc();
                    echo $getTotalMhs["total"];
                    ?>
                </h1>
                <h1 class="subtitle">Siswa</h1>
                <img src="../../Assets/Icons/cardMahasiswaIcon.png" alt="" class="icon">
            </a>
            <a href="../Program Studi/" class="cards">
                <h1 class="cardTitle">Jumlah Program Studi</h1>
                <h1 class="count">
                    <?php
                    $getTotalProdi = $con->query("SELECT COUNT(*) AS total FROM prodi;");
                    $getTotalProdi = $getTotalProdi->fetch_assoc();
                    echo $getTotalProdi["total"];
                    ?>
                </h1>
                <h1 class="subtitle">Prodi</h1>
                <img src="../../Assets/Icons/cardProdiIcon.png" alt="" class="icon">
            </a>
            <a href="../Mata Kuliah/" class="cards">
                <h1 class="cardTitle">Jumlah Mata Kuliah</h1>
                <h1 class="count">
                    <?php
                    $getTotalMatkul = $con->query("SELECT COUNT(*) AS total FROM matkul;");
                    $getTotalMatkul = $getTotalMatkul->fetch_assoc();
                    echo $getTotalMatkul["total"];
                    ?>
                </h1>
                <h1 class="subtitle">Mata Kuliah</h1>
                <img src="../../Assets/Icons/cardMatkulIcon.png" alt="" class="icon">
            </a>
        </div>

        <div id="dashboardItems">
            <div class="container">
                <h1>Mahasiswa dengan IP Tertinggi</h1>
                <div id="listMahasiswa">
                    <?php
                    $listMahasiswa = [];
                    $getMahasiswa = $con->query("SELECT m.nim, u.nama FROM mahasiswa m INNER JOIN users u ON u.user_id = m.user_id WHERE m.nim IN (SELECT nim FROM nilai);");

                    while ($row = $getMahasiswa->fetch_assoc()) {
                        $row["ip"] = hitungIP($row["nim"]);
                        $listMahasiswa[] = $row;
                    }

                    usort($listMahasiswa, function ($a, $b) {
                        return $b["ip"] <=> $a["ip"];
                    });

                    foreach ($listMahasiswa as $mhs) {
                        echo "<div class = 'mahasiswaRecord'>
                            <span>" . decryptData($mhs["nama"]) . "</span>
                            <span>" . $mhs["ip"] . "</span>
                        </div>";
                    }
                    ?>
                </div>
            </div>

            <div class="container">
                <h1>Mata Kuliah dengan Nilai Rata-rata Tertinggi</h1>
                <div id="barChartWrapper">
                    <canvas id="averageNilaiChart"></canvas>
                </div>
            </div>

            <div class="container" style="display: flex; flex-direction: column; justify-content: space-between;">
                <h1>Matkul paling banyak diambil</h1>
                <div id="pieChartWrapper">
                    <canvas id="matkulAmbilPersentase"></canvas>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
$getMatkulAmbil = $con->query("SELECT m.kode_mk, m.nama_mk, COUNT(n.kode_mk) AS jumlah
                               FROM matkul m INNER JOIN nilai n
                               ON m.kode_mk = n.kode_mk GROUP BY m.kode_mk;");

$label = [];
$persentaseMatkulAmbil = [];
$listMK = [];

while ($row = $getMatkulAmbil->fetch_assoc()) {
    $label[] = "'" . $row["nama_mk"] . "'";
    $persentaseMatkulAmbil[] = $row["jumlah"];
    $listMK[] = $row["kode_mk"];
}

$avgNilaiMatkul = [];

foreach ($listMK as $mk) {
    $getAvgNilai = $con->prepare("SELECT nilai FROM nilai WHERE kode_mk = ?");
    $getAvgNilai->bind_param("s", $mk);
    $getAvgNilai->execute();

    $result = $getAvgNilai->get_result();

    $totalNilai = 0;
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $totalNilai += doubleval(decryptData($row["nilai"]));
        $count++;
    }

    if ($count > 0) {
        $rataRata = $totalNilai / $count;
    } else {
        $rataRata = 0;
    }

    $avgNilaiMatkul[] = $rataRata;
}
?>
<script>
    const pieChart = document.getElementById('matkulAmbilPersentase').getContext('2d');

    new Chart(pieChart, {
        type: 'pie',
        data: {
            labels: [<?php echo implode(", ", $label) ?>],
            datasets: [{
                data: [<?php echo implode(", ", $persentaseMatkulAmbil) ?>],
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: 0
            },
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 8,
                        boxWidth: 18
                    }
                }
            }
        }
    });

    const myLabels = [<?php echo implode(", ", $label) ?>];
    const myData = [<?php echo implode(", ", $avgNilaiMatkul) ?>];
    const barColor = '#2A9D8F';

    const ctx = document.getElementById('averageNilaiChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: myLabels,
            datasets: [{
                label: 'Nilai Rata-rata',
                data: myData,
                backgroundColor: barColor,
                borderColor: barColor,
                borderWidth: 1,
                borderRadius: 5,
                barPercentage: 0.5,
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<style>
    .navList:nth-child(1) {
        background-color: #2886ea;
    }

    .admin {
        display: flex;
    }
</style>

</html>