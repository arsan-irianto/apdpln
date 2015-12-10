<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 06/11/2015
 * Time: 22:22
 */
?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li <?php if($_GET['modules']=='dashboard') echo "class='active'";?> >
                <a href="?modules=dashboard">
                    <i class="fa fa-home"></i> <span>Home</span></i>
                </a>
            </li>
            <li <?php if( ($_GET['modules']=='fgtm') || ($_GET['modules']=='saidi') ||
                ($_GET['modules']=='logsheet')) echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-table"></i> <span>Rekap Laporan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='fgtm') echo "class='active'";?>><a href="?modules=fgtm"><i class="fa fa-angle-double-right"></i> Rekap FGTM</a></li>
                    <li <?php if($_GET['modules']=='saidi') echo "class='active'";?>><a href="?modules=saidi"><i class="fa fa-angle-double-right"></i> Rekap Saidi</a></li>
                    <li <?php if($_GET['modules']=='logsheet') echo "class='active'";?>><a href="?modules=logsheet"><i class="fa fa-angle-double-right"></i> Rekap Logsheet</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>