<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Studi</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">
    <link rel="stylesheet" href="prodiMenu.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Program Studi</h1>
        </div>

        <div class="container">
            <form method="post">
                <div id="inputFields">
                    <div id="field">
                        <label>Kode Prodi :</label> 
                        <input type="text" name="" value="" readonly>
                    </div>
                    <div id="field">
                        <label>Nama Prodi :</label>
                        <input type="text" name="" value="" readonly>
                    </div>
                    <div id="field">
                        <label>Fakultas Prodi :</label>
                        <input type="password" name="" value="" readonly>
                    </div>
                    <div id="field">
                        <label>Ketua Prodi :</label>
                        <input type = "text" name = "" value="" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(4) {
        background-color: #2886ea;
    }
    .mahasiswa {
        display: flex;
    }
</style>
</html>