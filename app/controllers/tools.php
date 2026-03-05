<?php

/*
 *
 *  Buluntu no mükerrer kayıt kontrol sayfası
 *  AAS 002 detay sayfası görsel problemi
 * */


/*
 * kullanıcı ekle düzenle
 *
 * envanterlik
 *
 * */

class Tools extends Controller
{

    var $sql;

    function __construct()
    {
        parent::__construct();

        load::library('session');

        if (!@Session::get('oturum')) {
            load::view('giris');
            die();
        }

        $this->sql = Sql::getInstance();

    }

    /* TOOLS */

    function error_oku($pass)
    {
        if ($pass == "ok") {
            echo '<meta charset="utf-8" />';
            include ROOT . '/temp/error_log.msg';
        }
    }

    function kisitlama_olustur(){
        $this->kisitlama('Anakod', 'A');
        $this->kisitlama('Buluntu', 'B');
        $this->kisitlama('Açma Rapor', 'AR');
        $this->kisitlama('Evrak Yönetimi', 'EY');
        $this->kisitlama('Demirbaş Listesi', 'DL');
        $this->kisitlama('Parion Depo', 'PD');
        $this->kisitlama('EK9', 'E');
        $this->kisitlama('Raporlar', 'R');
    }

    function kisitlama($baslik, $kisakod){
        echo '<li>
                <span><i class="fa fa-lg fa-plus-circle"></i> '.$baslik.'</span>
                <ul>
                    <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="'.$kisakod.'0" class="'.$kisakod.'0"><i></i>Görüntüleme</label></span></li>
                    <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="'.$kisakod.'1" class="'.$kisakod.'1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="'.$kisakod.'2" class="'.$kisakod.'2"><i></i>Düzenleme</label> </span></li>
                    <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="'.$kisakod.'3" class="'.$kisakod.'3"><i></i>Silme</label> </span></li>
                </ul>
             </li>';
    }

    function max_anakod($anakod = 'AAA', $sayac = 1){
        load::library('anakod');
        $yeni = Anakod::olustur($anakod);

        $sayac++;
        if($yeni == 'ZZZ'){
            echo $sayac;
        }else{
            $this->max_anakod($yeni, $sayac);
        }

    }

    function test_anakod_olustur(){

        /*$anakod = '';

        $q = @$this->sql->from('anakod')->orderBy('anakod_id DESC')->limit(1)->get(true);
        $anakod = $q['anakod'];*/

        load::library('anakod');
        echo Anakod::olustur('AAA');

    }

    private function anakod_insert(){
        $ret = '';
        while(true){
            if ($ret === 'CKF'){
                break;
            }else{
                $ret = $this->anakod_olustur();
            }
        }

    }

    private function anakod_olustur()
    {
        $data = array();

        $q = @$this->sql->from('anakod')->orderBy('anakod_id DESC')->limit(1)->get(true);
        $anakod = $q['anakod'];

        if ($this->sql->count() > 0) {
            load::library('anakod');
            $data['anakod'] = Anakod::olustur($anakod);

        }else{
            $data['anakod'] = "AAA";
        }


        $data['anakod_buluntuyeri_id'] = 0;
        $data['buluntu_yili'] = 0;
        $data['durum'] = 1;


        $this->sonuc = @$this->sql->from('anakod')->insert($data);

        if ($this->sonuc) {
            return $q['anakod'];
        } else {
            //$this->error_log($this->sql->error());
            return "0";
        }
    }

    private function otomatik_tamamla($tablo, $sutun)
    {
        $q = trim($_GET["q"]);

        $sql = "select DISTINCT $sutun from $tablo where $sutun LIKE '%$q%'";

        $data = $this->sql->query($sql);
        foreach ($data as $q) {
            $v = stripslashes($q->{$sutun});
            $results[] = array(
                'key' => $v,
                'value' => $v
            );
        }

        echo json_encode($results);
    }

}