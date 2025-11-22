<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="icon" href="../../Assets/Icons/pageIcon.png" type="image/png">\
    <link rel="stylesheet" href="mahasiswaMenu.css">
</head>
<body>
    <?php
    include "../../Assets/Global Components/navbar.php";
    ?>
    <div id="main">
        <div id="title">
            <h1>Edit Mahasiswa</h1>
            <a href="" class="button">Edit Profile</a>
        </div>

        <div class="container">
            <form method="post">
                <div id="inputFields">
                    <div id="field">
                        <label>Nama :</label> 
                        <input type="text" name="" value="" readonly>
                    </div>
                    <div id="field">
                        <label>Alamat :</label>
                        <input type="text" name="" value="" required>
                    </div>
                    <div id="field">
                        <label>Password :</label>
                        <input type="password" name="" value="" placeholder = "Enter new password" required>
                    </div>
                    <div id="field">
                        <label>Prodi :</label>
                        <input type = "text" name = "" value="" required>
                    </div>
                    <input type="submit" class="button" value="Update">
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    .navList:nth-child(3) {
        background-color: #2886ea;
    }
    .mahasiswa {
        display: flex;
    }
</style>
</html>