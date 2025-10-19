<?php 

switch(get_user_login('type')) {
    case 'superadmin':
        if (isset($_GET['page'])) $page=$_GET['page'];
        else $page="beranda";

        if ($page == "beranda")                             include("pages/beranda.php");
        elseif ($page == "logout")                          include("pages/logout.php");

        //------------------------------------ Pendidikan Madrasah / Pengajuan Kurikulum ------------------------------------
        elseif ($page == 'pengajuan-kurikulum')             include("pages/pengajuan-kurikulum/list.php");

        else include("pages/404.php");
    break;
    default:
        if (isset($_GET['page'])) $page=$_GET['page'];
        else $page="beranda";

        if ($page == "beranda")                     include("pages/beranda.php");
        elseif ($page == "logout")                  include("pages/logout.php");

        //------------------------------------ Pendidikan Madrasah ------------------------------------
        elseif ($page == 'pengajuan-kurikulum')     include("pages/pengajuan-kurikulum/list.php");

        else include("pages/404.php"); 
    break;
}