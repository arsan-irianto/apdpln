<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 06/11/2015
 * Time: 22:22
 */
//session_start();
$TYPE = isset($_SESSION['TYPE']) ? $_SESSION['TYPE'] : "";
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
            <?php if ( $TYPE == 1) { ?>
            <li <?php if($_GET['modules']=='users') echo "class='active'";?> >
                <a href="?modules=users">
                    <i class="fa fa-users"></i> <span>Users</span></i>
                </a>
            </li>
            <?php } ?>
            <li <?php if( ($_GET['modules']=='dcc') || ($_GET['modules']=='area') ||
                    ($_GET['modules']=='gi') || ($_GET['modules']=='asuhan') ||
                    ($_GET['modules']=='plbsrecgh') || ($_GET['modules']=='pelanggan')||
                    ($_GET['modules']=='bhp')) echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Data Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='dcc') echo "class='active'";?>><a href="?modules=dcc"><i class="fa fa-angle-double-right"></i> DCC</a></li>
                    <li <?php if($_GET['modules']=='area') echo "class='active'";?>><a href="?modules=area"><i class="fa fa-angle-double-right"></i> Area</a></li>
                    <li <?php if($_GET['modules']=='gi') echo "class='active'";?>><a href="?modules=gi"><i class="fa fa-angle-double-right"></i> GI</a></li>
                    <li <?php if($_GET['modules']=='asuhan') echo "class='active'";?>><a href="?modules=asuhan"><i class="fa fa-angle-double-right"></i> Asuhan</a></li>
                    <li <?php if($_GET['modules']=='plbsrecgh') echo "class='active'";?>><a href="?modules=plbsrecgh"><i class="fa fa-angle-double-right"></i> PLBSRECGH</a></li>
                    <li <?php if($_GET['modules']=='pelanggan') echo "class='active'";?>><a href="?modules=pelanggan"><i class="fa fa-angle-double-right"></i> Pelanggan</a></li>
                    <li <?php if($_GET['modules']=='bhp') echo "class='active'";?>><a href="?modules=bhp"><i class="fa fa-angle-double-right"></i> Beban Harian</a></li>
                </ul>
            </li>

            <li <?php if( ($_GET['modules']=='fgtm') || ($_GET['modules']=='saidi') ||
                ($_GET['modules']=='logsheet') || ($_GET['modules']=='pkb') ||
                ($_GET['modules']=='ufr') || ($_GET['modules']=='transmisi') ||
                ($_GET['modules']=='rbhp'))
                echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-book"></i> <span>Rekap Laporan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='pkb') echo "class='active'";?>><a href="?modules=pkb"><i class="fa fa-angle-double-right"></i> Parameter Hitung Saidi</a></li>
                    <li <?php if($_GET['modules']=='fgtm') echo "class='active'";?>><a href="?modules=fgtm"><i class="fa fa-angle-double-right"></i> Rekap FGTM</a></li>
                    <li <?php if($_GET['modules']=='saidi') echo "class='active'";?>><a href="?modules=saidi"><i class="fa fa-angle-double-right"></i> Rekap Saidi</a></li>
                    <li <?php if($_GET['modules']=='logsheet') echo "class='active'";?>><a href="?modules=logsheet"><i class="fa fa-angle-double-right"></i> Rekap Logsheet</a></li>
                    <li <?php if($_GET['modules']=='ufr') echo "class='active'";?>><a href="?modules=ufr"><i class="fa fa-angle-double-right"></i> Report UFR</a></li>
                    <li <?php if($_GET['modules']=='transmisi') echo "class='active'";?>><a href="?modules=transmisi"><i class="fa fa-angle-double-right"></i> Report Transmisi</a></li>
                    <li <?php if($_GET['modules']=='rbhp') echo "class='active'";?>><a href="?modules=rbhp"><i class="fa fa-angle-double-right"></i> Rekap Beban Harian</a></li>
                </ul>
            </li>

            <li <?php if( ($_GET['modules']=='xtp_area') || ($_GET['modules']=='xtt_area') ||
                ($_GET['modules']=='xtpt_area') || ($_GET['modules']=='xtpir_area') || ($_GET['modules']=='gg_area') ) echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>Grafik Per Area</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='xtp_area') echo "class='active'";?>><a href="?modules=xtp_area"><i class="fa fa-angle-double-right"></i> X Trip Permanen</a></li>
                    <li <?php if($_GET['modules']=='xtt_area') echo "class='active'";?>><a href="?modules=xtt_area"><i class="fa fa-angle-double-right"></i> X Trip Temporer</a></li>
                    <li <?php if($_GET['modules']=='xtpt_area') echo "class='active'";?>><a href="?modules=xtpt_area"><i class="fa fa-angle-double-right"></i> X Trip Permanen & Temporer</a></li>
                    <li <?php if($_GET['modules']=='xtpir_area') echo "class='active'";?>><a href="?modules=xtpir_area"><i class="fa fa-angle-double-right"></i> X Trip Per Indikasi Relay</a></li>
                    <li <?php if($_GET['modules']=='gg_area') echo "class='active'";?>><a href="?modules=gg_area"><i class="fa fa-angle-double-right"></i> Gangguan (FGTM)</a></li>
                </ul>
            </li>

            <li <?php if( ($_GET['modules']=='xtp_gardu') || ($_GET['modules']=='xtt_gardu') ||
                ($_GET['modules']=='xtpt_gardu') || ($_GET['modules']=='xtpir_gardu') ) echo "class='treeview active'";?>>
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i> <span>Grafik Per Gardu Induk</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($_GET['modules']=='xtp_gardu') echo "class='active'";?>><a href="?modules=xtp_gardu"><i class="fa fa-angle-double-right"></i> X Trip Permanen</a></li>
                    <li <?php if($_GET['modules']=='xtt_gardu') echo "class='active'";?>><a href="?modules=xtt_gardu"><i class="fa fa-angle-double-right"></i> X Trip Temporer</a></li>
                    <li <?php if($_GET['modules']=='xtpt_gardu') echo "class='active'";?>><a href="?modules=xtpt_gardu"><i class="fa fa-angle-double-right"></i> X Trip Permanen & Temporer</a></li>
                    <li <?php if($_GET['modules']=='xtpir_gardu') echo "class='active'";?>><a href="?modules=xtpir_gardu"><i class="fa fa-angle-double-right"></i> X Trip Per Indikasi Relay</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>