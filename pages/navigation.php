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

            <li <?php if( ($_GET['modules']=='dcc') || ($_GET['modules']=='area') ||
                    ($_GET['modules']=='gi') || ($_GET['modules']=='asuhan') || ($_GET['modules']=='plbsrecgh') ) echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-table"></i> <span>Data Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='dcc') echo "class='active'";?>><a href="?modules=dcc"><i class="fa fa-angle-double-right"></i> DCC</a></li>
                    <li <?php if($_GET['modules']=='area') echo "class='active'";?>><a href="?modules=area"><i class="fa fa-angle-double-right"></i> Area</a></li>
                    <li <?php if($_GET['modules']=='gi') echo "class='active'";?>><a href="?modules=gi"><i class="fa fa-angle-double-right"></i> GI</a></li>
                    <li <?php if($_GET['modules']=='asuhan') echo "class='active'";?>><a href="?modules=asuhan"><i class="fa fa-angle-double-right"></i> Asuhan</a></li>
                    <li <?php if($_GET['modules']=='plbsrecgh') echo "class='active'";?>><a href="?modules=plbsrecgh"><i class="fa fa-angle-double-right"></i> PLBSRECGH</a></li>
                </ul>
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

            <li <?php if( ($_GET['modules']=='xtp') || ($_GET['modules']=='xtt') ||
                ($_GET['modules']=='xtpt') || ($_GET['modules']=='xtpir') ) echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>Grafik</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='xtp') echo "class='active'";?>><a href="?modules=xtp"><i class="fa fa-angle-double-right"></i> X Trip Permanen</a></li>
                    <li <?php if($_GET['modules']=='xtt') echo "class='active'";?>><a href="?modules=xtt"><i class="fa fa-angle-double-right"></i> X Trip Temporer</a></li>
                    <li <?php if($_GET['modules']=='xtpt') echo "class='active'";?>><a href="?modules=xtpt"><i class="fa fa-angle-double-right"></i> X Trip Permanen & Temporer</a></li>
                    <li <?php if($_GET['modules']=='xtpir') echo "class='active'";?>><a href="?modules=xtpir"><i class="fa fa-angle-double-right"></i> X Trip Per Indikasi Relay</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>