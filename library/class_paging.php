<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 08/11/2015
 * Time: 21:07
 */

class Paging{

    /**
     * Fungsi untuk mencek halaman dan posisi data
     * @param $batas
     * @return int
     */
    function cariPosisi($batas){
        if(empty($_GET['halaman'])) {
            $posisi=1;
            $_GET['halaman']=1;
        }
        else {
            $posisi = $_GET['halaman'];//* $batas;
        }
        return $posisi;
    }

    /**
     * Fungsi untuk menghitung total halaman
     * @param $jmldata
     * @param $batas
     * @return float
     */
    function jumlahHalaman($jmldata, $batas){
        $jmlhalaman = ceil($jmldata/$batas);
        return $jmlhalaman;
    }

    /**
     * Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
     * @param $halaman_aktif
     * @param $jmlhalaman
     * @param $link_param
     * @return string
     */
    function navHalaman($halaman_aktif, $jmlhalaman, $link_param){
        $link_halaman = "";
        // Link First dan Previous

        if ($halaman_aktif > 1) {
            $link_halaman .= "<li><a href=$link_param&halaman=1 id=1>First</a></li>";
        }
        else {
            $link_halaman .= "<li class='active'><a href='#'>First</a><li>";
        }


        if (($halaman_aktif-1) > 0) {
            $previous = $halaman_aktif-1;
            $link_halaman .= "<li><a href=$link_param&halaman=$previous id=$previous>Prev</a><li>";
        }
        else {
            $link_halaman .= "<li class='active'><a href='#'>Prev</a></li>";
        }

        // Link halaman 1,2,3, ...
        for($i=$_GET['halaman']-2;$i<$_GET['halaman'];$i++) {
            if ($i < 1)continue;
            $link_halaman .= "<li><a href=$link_param&halaman=$i id=$i>$i</a></li>";
        }

        $link_halaman .= "<li class='active'><a href='#'>$halaman_aktif</a></li>";
        for($i=$_GET['halaman']+1;$i<($_GET['halaman']+5);$i++) {
            if ($i > $jmlhalaman)break;
            $link_halaman .= "<li><a href=$link_param&halaman=$i id=$i>$i</a></li>";
        }

        // Link Next dan Last
        if ($halaman_aktif < $jmlhalaman) {
            $next=$halaman_aktif+1;
            $link_halaman .= "<li><a href=$link_param&halaman=$next id=$next>Next</a></li>";
        }
        else {
            $link_halaman .= "<li class='active'><a href='#'>Next</a></li>";
        }


        if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0)) {
            $link_halaman .= "<li><a href=$link_param&halaman=$jmlhalaman id=$jmlhalaman>Last</a></li>";
        }
        else {
            $link_halaman .= "<li class='active'><a href='#'>Last</a></li>";
        }
        return $link_halaman;
    }

}

?>