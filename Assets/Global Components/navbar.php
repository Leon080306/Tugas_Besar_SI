<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    #header {
        position: fixed;
        z-index: 1;
        top: 0;
        width: 100%;
        background-color: #273c53;
        height: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-inline: 32px;
        box-sizing: border-box;
        color: white;
        box-shadow: 0 2px 10px 5px #CCCCCC;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
    }

    #header h1 {
        font-weight: 300;
    }

    #header #title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 38%;
        font-size: 14px;
    }

    .icons {
        width: 40px;
        height: 40px;
    }

    #header .icons {
        cursor: pointer;
    }

    #sidebar {
        position: fixed;
        left: 0;
        bottom: 0;
        height: 100%;
        background-color: #273c53;
        width: 240px;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
        color: white;
        box-shadow: 0 15px 10px 5px #CCCCCC;
        box-sizing: border-box;
        padding-top: 100px;
    }

    .navList {
        width: 100%;
        height: 60px;
        display: flex;
        align-items: center;
        font-size: 10px;
    }

    .navList:hover {
        background-color: #2886ea;
    }

    .navList h2 {
        font-weight: 300;
    }

    .navList .icons {
        margin-left: 20px;
        margin-right: 10px;
    }

    #drawerMenu {
        position: absolute;
        right: 0;
        top: 80px;
        height: 0;
        display: flex;
        overflow: hidden;
        flex-direction: column;
        background-color: #273c53;
        width: 200px;
        color: white;
        box-shadow: 0 0 10px -1px rgba(0, 0, 0, 0.4);
        box-sizing: border-box;
        transition: height 0.5s ease-out;
    }

    .drawerMenuList {
        position: relative;
        right: 0;
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        font-size: 10px;
    }

    .drawerMenuList:hover {
        background-color: #2886ea;
    }

    .drawerMenuList h2 {
        font-weight: 300;
    }

    .drawerMenuList .icons {
        margin-left: 20px;
        margin-right: 10px;
    }

    .drawerMenuListWrapper {
        display: flex;
        width: 87%;
        flex-direction: row-reverse;
        align-items: center;
    }
</style>

<script src="../Library/jquery.js"></script>

<div id="header">
    <div id="title">
        <a href=""><img class="icons" src="../Icons/academic.png" alt=""></a>
        <h1>Academic Management System</h1>
    </div>
    <div id="drawerMenu">
        <div class="drawerMenuList">
            <div class="drawerMenuListWrapper">
                <h2>My Account</h2>
                <img style="width: 24px; height: 24px;" class="icons" src="../Icons/profile.png" alt="">
            </div>
        </div>
        <div class="drawerMenuList">
            <div class="drawerMenuListWrapper">
                <h2>Logout</h2>
                <img style="width: 24px; height: 24px;" class="icons" src="../Icons/logout.png" alt="">
            </div>
        </div>
    </div>
    <img id="drawerIcon" style="width: 26px; height: 26px;" class="icons" src="../Icons/drawer.png" alt="">
</div>

<div id="sidebar">
    <div class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Icons/home.png" alt="">
        <h2>Dashboard</h2>
    </div>
    <div class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Icons/student.png" alt="">
        <h2>Mahasiswa</h2>
    </div>
    <div class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Icons/prodi.png" alt="">
        <h2>Program Studi</h2>
    </div>
    <div class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Icons/matkul.png" alt="">
        <h2>Mata Kuliah</h2>
    </div>
    <div class="navList">
        <img style="width: 24px; height: 24px;" class="icons" src="../Icons/nilai.png" alt="">
        <h2>Transkrip Nilai</h2>
    </div>
</div>
<script>
    var drawerOpened = false;
    $("#drawerIcon").click(function() {
        if(drawerOpened) {
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