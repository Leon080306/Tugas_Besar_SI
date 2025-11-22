<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="nilaiMenu.css">
    <script src="../../Assets/Library/jquery.js"></script>
</head>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Transkrip Nilai</h1>
        </div>
        <div class="container">
            <table>
                <tr>
                    <th>Kode-MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Jumlah SKS</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                </tr>
                <tr class = "matkul">
                    <td>[Kode MK]</td>
                    <td>[Nama MK]</td>
                    <td>[SKS MK]</td>
                    <td>[Nilai MK]</td>
                    <td>[Grade MK]</td>
                </tr>
                <tbody class="nilai" id="IF">
                    <tr>
                        <td>[Kode MK]</td>
                        <td>[Nama MK]</td>
                        <td>[SKS MK]</td>
                        <td>[Nilai MK]</td>
                        <td>[Grade MK]</td>
                    </tr>
                    <tr>
                        <td>[Kode MK]</td>
                        <td>[Nama MK]</td>
                        <td>[SKS MK]</td>
                        <td>[Nilai MK]</td>
                        <td>[Grade MK]</td>
                    </tr>
                    <tr>
                        <td>[Kode MK]</td>
                        <td>[Nama MK]</td>
                        <td>[SKS MK]</td>
                        <td>[Nilai MK]</td>
                        <td>[Grade MK]</td>
                    </tr>
                    <tr>
                        <td>[Kode MK]</td>
                        <td>[Nama MK]</td>
                        <td>[SKS MK]</td>
                        <td>[Nilai MK]</td>
                        <td>[Grade MK]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(6) {
        background-color: #2886ea;
    }

    .mahasiswa {
        display: flex;
    }

    th:nth-last-child(1) {
        text-align: start;
    }

    .matkul {
        cursor: pointer;
    }

    .nilai tr {
        background-color: rgba(232, 239, 245);
    }

    .nilai tr td {
        border-radius: 0;
    }
</style>

<script>
    $(document).ready(function () {
        $(".nilai").hide();

        $(".matkul").click(function () {
            $(this).toggleClass("opened");
            $("#IF").toggle();
        })
    })
</script>

</html>