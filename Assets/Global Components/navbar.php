<script src="../Assets/Library/jquery.js"></script>
<link rel="stylesheet" href="../Assets/Global Components/navbar.css">

<div id="header">
    <div id="title">
        <a href=""><img class="icons" src="../Assets/Icons/academic.png" alt=""></a>
        <h1>Academic Management System</h1>
    </div>
    <div id="drawerMenu">
        <a href = "#" class="drawerMenuList">
            <div class="drawerMenuListWrapper">
                <h2>My Account</h2>
                <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/profile.png" alt="">
            </div>
        </a>
        <a href = "#" class="drawerMenuList">
            <div class="drawerMenuListWrapper">
                <h2>Logout</h2>
                <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/logout.png" alt="">
            </div>
        </a>
    </div>
    <img id="drawerIcon" style="width: 26px; height: 26px;" class="icons" src="../Assets/Icons/drawer.png" alt="">
</div>

<div id="sidebar">
    <a href="#" class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/home.png" alt="">
        <h2>Dashboard</h2>
    </a>
    <a href="#" class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/student.png" alt="">
        <h2>Mahasiswa</h2>
    </a>
    <a href="#" class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/prodi.png" alt="">
        <h2>Program Studi</h2>
    </a>
    <a href="#" class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/matkul.png" alt="">
        <h2>Mata Kuliah</h2>
    </a>
    <a href="#" class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Assets/Icons/nilai.png" alt="">
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
                height: "80px"
            }, 0.5)
            drawerOpened = true;
        }
    });
</script>