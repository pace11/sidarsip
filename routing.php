<?php 

switch(get_user_login('type')) {
    case 'superadmin':
    case 'admin':
        if (isset($_GET['page'])) $page=$_GET['page'];
        else $page="beranda";

        if ($page == "beranda")                      include("pages/beranda.php");
        elseif ($page == "logout")                   include("pages/logout.php");

        // Pendidikan Madrasah
        elseif ($page == 'pengajuan-kurikulum')      include("pages/pengajuan-kurikulum/list.php");
        
        // Institusi
        elseif ($page == 'institusi')                include("pages/institusi/list.php");

        // Users
        elseif ($page == 'users')                    include("pages/users/list.php");

        // Files Upload
        elseif ($page == 'files-upload')             include("pages/files-upload/list.php");

        else include("pages/404.php");
    break;
    default:
        if (isset($_GET['page'])) $page=$_GET['page'];
        else $page="beranda";

        if ($page == "beranda")                      include("pages/guest/beranda.php");
        elseif ($page == "logout")                   include("pages/logout.php");

        // Pendidikan Madrasah
        elseif ($page == 'pengajuan-kurikulum')      include("pages/pengajuan-kurikulum/list.php");

        else include("pages/404.php"); 
    break;
}