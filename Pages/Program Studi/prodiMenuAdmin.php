<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
</head>
<style>
    #title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    #title h1 {
        color: #273c53;
        font-weight: normal;
    }

    .button {
        background-color: #27b0b1;
        color: white;
        padding: 10px 24px;
        border-radius: 24px;
        text-decoration: none;
    }

    .button:hover {
        color: #27b0b1;
        background-color: white;
    }

    .container {
        background-color: white;
        width: 100%;
        height: 350px;
        border-radius: 12px;
        box-shadow: 0 2px 10px 5px rgb(204, 204, 204, 0.5);
        padding: 12px 24px;
        box-sizing: border-box;
        overflow: auto;
    }

    table {
        width: 100%;
        font-size: 15px;
        border-collapse: collapse;
    }

    th {
        font-weight: normal;
        text-align: left;
        font-size: 18px;
        height: 50px;
        vertical-align: top;
    }

    .actionIcon img {
        width: 20px;
        height: 20px;
    }

    .actionIcon {
        text-decoration: none;
    }

    #tableActions {
        display: flex;
        width: 100%;
        justify-content: center;
        gap: 10px;
        align-items: center;
    }

    tr {
        height: 50px;
        border-radius: 12px;
    }

    td:nth-child(1) {
        border-radius: 6px 0 0 6px;
        padding-left: 8px;
    }

    td:nth-last-child(1) {
        border-radius: 0 6px 6px 0;
    }

    tr:nth-child(even) {
        background-color: rgba(232, 239, 245);
    }

    th:nth-last-child(1) {
        text-align: center;
    }
</style>

<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Manajemen Program Studi</h1>
            <a href="" class="button">Tambah Prodi</a>
        </div>

        <div class="container">
            <table>
                <tr>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Fakultas</th>
                    <th>Nama Ketua Prodi</th>
                    <th>Total Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
                <!-- ======================echo 1 <tr> ini untuk setiap prodi========================= -->
                <tr>
                    <td>[Kode Prodi]</td>
                    <td>[Nama Prodi]</td>
                    <td>[Fakultas]</td>
                    <td>[Nama Ketua Prodi]</td>
                    <td>[Total mhs]</td>
                    <td>
                        <div id="tableActions">
                            <a class="actionIcon" href="">
                                <img src="../../Assets/Icons/editIcon.png" alt="">
                            </a>
                            <a class="actionIcon" href="">
                                <img src="../../Assets/Icons/deleteIcon.png" alt="">
                            </a>
                        </div>
                    </td>
                </tr>
                <!-- ====================================================================================== -->
            </table>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(3) {
        background-color: #2886ea;
    }
</style>

</html>