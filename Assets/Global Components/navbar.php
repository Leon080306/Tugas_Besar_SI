<script src="../../Assets/Library/jquery.js"></script>
<link rel="stylesheet" href="../../Assets/Global Components/navbar.css">

<div id="header">
    <div id="navTitle">
        <a href="../Dashboard"><img class="icons" src="../../Assets/Icons/academic.png" alt=""></a>
        <h1>Academic Management System</h1>
    </div>
    <div id="drawerMenu">
        <a href = "#" class="drawerMenuList">
            <div class="drawerMenuListWrapper">
                <h2>My Account</h2>
                <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/profile.png" alt="">
            </div>
        </a>
        <a href = "../../Pages/SignUp&Login/logout.php" class="drawerMenuList">
            <div class="drawerMenuListWrapper">
                <h2>Logout</h2>
                <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/logout.png" alt="">
            </div>
        </a>
        <?php if($_COOKIE["user_role"] && $_COOKIE["user_role"] == "A") { ?>
            <a href = "../SignUp&Login/addNewAdmin.php" class="drawerMenuList">
                <div class="drawerMenuListWrapper">
                    <h2>Add new admin</h2>
                    <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/addAccount.png" alt="">
                </div>
            </a>
        <?php } ?>
    </div>
    <img id="drawerIcon" style="width: 26px; height: 26px;" class="icons" src="../../Assets/Icons/drawer.png" alt="">
</div>

<div id="sidebar">
    <a href="../Dashboard" class="admin mahasiswa navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/home.png" alt="">
        <h2>Dashboard</h2>
    </a>
    <a href="../Mahasiswa" class="admin navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/student.png" alt="">
        <h2>Mahasiswa</h2>
    </a>
    <a href="../Mahasiswa" class="mahasiswa navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/student.png" alt="">
        <h2>Profil Saya</h2>
    </a>
    <a href="../Program Studi" class="admin mahasiswa navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/prodi.png" alt="">
        <h2>Program Studi</h2>
    </a>
    <a href="../Mata Kuliah" class="admin navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/matkul.png" alt="">
        <h2>Mata Kuliah</h2>
    </a>
    <a href="../Nilai" class="admin mahasiswa navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../../Assets/Icons/nilai.png" alt="">
        <h2>Transkrip Nilai</h2>
    </a>
</div>
<script>
    var drawerOpened = false;
    $("#drawerIcon").click(function() {
        if (drawerOpened) {
            $("#drawerMenu").animate({
                height: "0px"
            }, 0.5)
            drawerOpened = false;
        } else {
            $("#drawerMenu").animate({
                height: "<?php echo ($_COOKIE["user_role"] && $_COOKIE["user_role"] == "A") ? "120px" : "80px"; ?>"
            }, 0.5)
            drawerOpened = true;
        }
    });
</script>