<?php

/*
 *
 *

buluntu_galeri_view

SELECT bg.bk_id, a.anakod, bye.list_adi AS buluntu_yeri, LPAD(bk.buluntu_no,4,0) as buluntu_no, fo.list_adi as formobje, bk.buluntu_tarihi, bg.dosya
FROM buluntu_galeri AS bg
INNER JOIN buluntu_karti AS bk ON bk.bk_id = bg.bk_id
INNER JOIN list_data AS bye ON bye.list_id = bk.bk_buluntuyeri_id
INNER JOIN anakod AS a ON a.anakod_id = bk.bk_anakod_id
INNER JOIN list_data as fo ON fo.list_id = bk.bk_formobje_id
GROUP BY bg.bk_id order by bg.bk_id DESC


buluntu_listesi

SELECT bk.bk_id, a.anakod, LPAD( bk.buluntu_no, 4, 0 ) AS buluntu_no, bye.list_adi AS buluntu_yeri, ym.list_adi AS yapim_malzemesi, bk.buluntu_tarihi, d.list_adi AS donem, fo.list_adi AS formobje, bk.durum, bk.envanterlik, t.list_adi as tip, bk.plankare, bk.tabaka, bk.seviye, bk.eser_tarihi
FROM buluntu_karti AS bk
LEFT JOIN anakod AS a ON bk.bk_anakod_id = a.anakod_id
LEFT JOIN list_data AS bye ON bk.bk_buluntuyeri_id = bye.list_id
LEFT JOIN list_data AS ym ON bk.bk_yapim_mlz_id = ym.list_id
LEFT JOIN list_data AS d ON bk.bk_donem_id = d.list_id
LEFT JOIN list_data AS fo ON bk.bk_formobje_id = fo.list_id
LEFT JOIN list_data AS t ON bk.bk_tip_id = t.list_id;

 *
 * */


/*
 *
 * SELECT a.anakod as ANAKOD, count(*) as ADET FROM `buluntu_karti` as bk LEFT JOIN anakod as a ON a.anakod_id = bk.bk_anakod_id group by bk.bk_anakod_id order by adet desc
 * anakoda ait buluntu sayısı
 *
 *
 * SELECT  l.list_adi as YAPIM_MALZEMESI, count(*) as ADET FROM `buluntu_karti` as bk LEFT JOIN list_data as l ON bk.bk_yapim_mlz_id = l.list_id group by bk.bk_yapim_mlz_id order by adet desc
 *
 * SELECT ll.list_adi as DONEM, l.list_adi as FORM_OBJE, count(*) as ADET FROM `buluntu_karti` as bk LEFT JOIN list_data as l ON bk.bk_formobje_id = l.list_id LEFT JOIN list_data as ll ON bk.bk_donem_id = ll.list_id group by bk.bk_donem_id, bk.bk_formobje_id order by adet desc
 *
 * SELECT ll.list_adi as DONEM, SUBSTRING(bk.buluntu_tarihi,-4,4) as BULUNTU_YILI, l.list_adi as FORM_OBJE, count(*) as ADET FROM `buluntu_karti` as bk LEFT JOIN list_data as l ON bk.bk_formobje_id = l.list_id LEFT JOIN list_data as ll ON bk.bk_donem_id = ll.list_id group by SUBSTRING(bk.buluntu_tarihi,-4,4),bk.bk_donem_id, bk.bk_formobje_id order by adet desc
 *
 * SELECT lb.list_adi as BULUNTU_YERI, ll.list_adi as DONEM, SUBSTRING(bk.buluntu_tarihi,-4,4) as BULUNTU_YILI, l.list_adi as FORM_OBJE, count(*) as ADET FROM `buluntu_karti` as bk LEFT JOIN list_data as l ON bk.bk_formobje_id = l.list_id LEFT JOIN list_data as ll ON bk.bk_donem_id = ll.list_id LEFT JOIN list_data as lb ON bk.bk_buluntuyeri_id = lb.list_id where l.list_adi LIKE '%Sikke%' group by bk.bk_buluntuyeri_id, SUBSTRING(bk.buluntu_tarihi,-4,4),bk.bk_donem_id, bk.bk_formobje_id order by BULUNTU_YERI ASC
 *
 * SELECT lb.list_adi as BULUNTU_YERI, ll.list_adi as DONEM, SUBSTRING(bk.buluntu_tarihi,-4,4) as BULUNTU_YILI, l.list_adi as FORM_OBJE, count(*) as ADET, k.adsoyad as KULLANICI FROM `buluntu_karti` as bk LEFT JOIN list_data as l ON bk.bk_formobje_id = l.list_id LEFT JOIN list_data as ll ON bk.bk_donem_id = ll.list_id LEFT JOIN list_data as lb ON bk.bk_buluntuyeri_id = lb.list_id LEFT JOIN _log as lo ON lo.data_id = bk.bk_id LEFT JOIN _kullanici as k ON k.ID = lo.kullanici_id where lo.islem = 1 and lo.tablo = 'buluntu_karti' group by lo.kullanici_id, bk.bk_buluntuyeri_id, bk.bk_formobje_id order by KULLANICI DESC
 *
 * */


/*
 * rp_yillara_gore_buluntu
 * SELECT lb.list_adi as buluntu_yeri, SUBSTRING(bk.buluntu_tarihi,-4,4) as buluntu_yili, count(*) as adet FROM `buluntu_karti` as bk LEFT JOIN list_data as lb ON bk.bk_buluntuyeri_id = lb.list_id where SUBSTRING(bk.buluntu_tarihi,-4,4) != '' group by bk.bk_buluntuyeri_id, buluntu_yili
 *
 *
 * rp_aylara_gore_buluntu
 * SELECT lb.list_adi as buluntu_yeri, LPAD(REPLACE(REPLACE(SUBSTRING(bk.buluntu_tarihi,-7,5),'.20',''),'.',''),2,0) as buluntu_ay,SUBSTRING(bk.buluntu_tarihi,-4,4) as buluntu_yili, count(*) as adet FROM `buluntu_karti` as bk LEFT JOIN list_data as lb ON bk.bk_buluntuyeri_id = lb.list_id where SUBSTRING(bk.buluntu_tarihi,-4,4) != '' group by bk.bk_buluntuyeri_id, buluntu_yili, buluntu_ay
 * */


/*
islem_gecmisi
view

SELECT l.log_id, k.adsoyad,
CASE
	WHEN l.tablo IN('buluntu_karti', 'restorasyon_listesi', 'konservasyon_listesi') THEN (SELECT CONCAT(anakod,  ' ', buluntu_no) FROM buluntu_listesi WHERE bk_id = l.data_id)
	WHEN l.tablo = 'anakod' THEN (SELECT anakod FROM anakod WHERE anakod_id = l.data_id)
	WHEN l.tablo = 'acma_rapor' THEN (SELECT baslik FROM acma_rapor WHERE ID = l.data_id)
	WHEN l.tablo = 'evrak_yonetimi' THEN (SELECT evrak_konusu FROM evrak_yonetimi WHERE id = l.data_id)
	WHEN l.tablo = 'demirbas_listesi' THEN (SELECT malzeme_adi FROM demirbas_listesi WHERE id = l.data_id)
	WHEN l.tablo = 'yayinlar' THEN (SELECT eser_ad FROM yayinlar WHERE id = l.data_id)
END AS data_title,
CASE
	WHEN l.tablo = 'buluntu_karti' THEN 'Buluntu'
	WHEN l.tablo = 'restorasyon_listesi' THEN 'Restorasyon Formu'
	WHEN l.tablo = 'konservasyon_listesi' THEN 'Konservasyon Formu'
	WHEN l.tablo = 'anakod' THEN 'Anakod'
	WHEN l.tablo = 'acma_rapor' THEN 'Açma Rapor'
	WHEN l.tablo = 'evrak_yonetimi' THEN 'Evrak'
	WHEN l.tablo = 'demirbas_listesi' THEN 'Demirbaş'
	WHEN l.tablo = 'yayinlar' THEN 'Yayın'
END AS data_cat,
CASE
	WHEN l.islem = 1 THEN 'Oluşturuldu'
	WHEN l.islem = 2 THEN 'Güncellendi'
END as islem_tip,
l.islem, l.tablo, l.data_id, l.tarih
FROM _log AS l LEFT JOIN _kullanici AS k ON k.ID = l.kullanici_id
WHERE l.tablo NOT IN ('_kullanici','list_data','genel_ayarlar') AND islem != 0

*/

class Rapor extends Controller
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

    function home(){

    }

    function yenile(){

        $a = $this->sql->from('genel_ayarlar')->where('ID = 1')->get();

        if(strlen($a->buluntust_bk_id) > 0){
            $buluntu = $this->sql->from('list_data')->where('durum = 1 AND tip = 1 AND list_id IN (' . $a->buluntust_bk_id . ')')->getAll();

            foreach($buluntu as $b){
                $this->buluntu_yeri_anasayfa($b->list_id);
            }
        }

        $this->ygb_geneltoplam();
        $this->yillara_gore_toplam();
        $this->yillara_gore_buluntu();

        echo "ok";
    }

    function yillara_gore_toplam(){

        $sonuc = $this->sql->query("SELECT buluntu_yili, SUM(adet) as toplam FROM (SELECT LPAD(REPLACE(REPLACE(SUBSTRING(bk.buluntu_tarihi,-7,5),'.20',''),'.',''),2,0) as buluntu_ay,SUBSTRING(bk.buluntu_tarihi,-4,4) as buluntu_yili, count(*) as adet FROM `buluntu_karti` as bk where SUBSTRING(bk.buluntu_tarihi,-4,4) != '' group by buluntu_yili, buluntu_ay) TEMP group by buluntu_yili",true, false);
        if($this->sql->count() > 0){

            $data = array();
            $key = array();
            $say = 0;

            foreach ($sonuc as $c) {
                $data[$say]['label'] = $c->buluntu_yili;
                $key[$say]['value'] = $c->toplam;
                $say++;
            }

            $kategori = '"categories": [{"category": ' . json_encode($data) . '}],';
            $veri = '"dataset": [{"data": ';
            $veri .= json_encode($key);

            $json = $kategori . $veri . '}]';


            $file = 'temp/yillara_gore_toplam.json';
            @unlink($file);
            $dosya = fopen($file, 'w');
            fwrite($dosya, $json);
            fclose($dosya);

        }
    }

    function ygb_geneltoplam(){
        # Yillara gore buluntu genel toplami, son 5 yil - buluntu yerine gore
        $kacyil = 4;
        $yil = intval(date('Y'));
        $sonucyil = intval($yil) - $kacyil;

        $yillar = $this->sql->query("SELECT DISTINCT buluntu_yili FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP where buluntu_yili BETWEEN $sonucyil AND $yil AND adet > 10) TEMPS order by buluntu_yili ASC", true, false);
        $yilyaz = array();
        $ret = '';
        $renkler = array('#008ee4', '#6baa01', '#e44a00', '#f8bd19', '#33bdda');

        $say = 0;

        foreach ($yillar as $aa) {
            $yilyaz[] = $aa->buluntu_yili;
        }

        $t = $this->sql->query("SELECT SUM(adet) as toplam FROM  rp_yillara_gore_buluntu where buluntu_yili IN(".implode(',', $yilyaz).")",false, false);

        foreach($yilyaz as $y){
            $sonuc = $this->sql->query("SELECT SUM(adet) as toplam FROM  rp_yillara_gore_buluntu where buluntu_yili = " . $y,false, false);
            if ($this->sql->count() > 0) {

                $ret .= '<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text"> '.$y.' yılı toplamı ('.round($sonuc->toplam/$t->toplam*100).'%)<span class="pull-right">'.$sonuc->toplam.'</span> </span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="opacity:0.7; background-color: '.$renkler[$say].'; width: '.($sonuc->toplam/$t->toplam*100).'%;"></div>
                                                </div> </div>';

                $say++;
            }
        }

        $ret .= '<div class="col-xs-12 col-sm-12 col-md-12" >
<div style="width: 100%; height: 28px; padding: 5px 4px;font-size: 12px; margin-bottom: 15px; background: rgb(240, 243, 237);border: 1px solid #ddd;">
                                <div class="pull-left"><i class="fa fa-bar-chart-o"></i> Genel Toplam</div>
                                <div class="pull-right">'.$t->toplam.'</div>
                                </div>
                            </div>';


        $file = 'temp/buluntu_genel_toplam.php';
        @unlink($file);
        $dosya = fopen($file, 'w');
        fwrite($dosya, $ret);
        fclose($dosya);
    }

    function yillara_gore_buluntu(){

        # Yillara gore buluntu toplami, son 5 yil sadece istenilen buluntu yerine gore

        $kacyil = 4;
        $yil = intval(date('Y'));
        $sonucyil = intval($yil) - $kacyil;

        $yillar = $this->sql->query("SELECT DISTINCT buluntu_yili FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP where buluntu_yili BETWEEN $sonucyil AND $yil AND adet > 10) TEMPS order by buluntu_yili ASC", true, false);
        $yilyaz = array();

        foreach ($yillar as $aa) {
            $yilyaz[] = $aa->buluntu_yili;
        }

        $a = $this->sql->from('genel_ayarlar')->where('ID = 1')->get();

        $buluntuadi = '';
        if(strlen($a->genelst_bk_id) > 0){
            $buluntus = $this->sql->from('list_data')->where('durum = 1 AND tip = 1 AND list_id IN (' . $a->genelst_bk_id . ')')->getAll();

            foreach($buluntus as $b){
               //array_push($buluntuadi, $b->list_adi);

                $buluntuadi = $buluntuadi . ' buluntu_yeri LIKE \'%' . $b->list_adi . '%\' OR';
            }

            $buluntuadi = substr($buluntuadi, 0, strlen($buluntuadi) - 2);
        }else{
            die();
        }

        $buluntu = $this->sql->query("SELECT DISTINCT buluntu_yeri FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP where buluntu_yili BETWEEN $sonucyil AND $yil AND adet > 10) TEMPS WHERE " . $buluntuadi, true, false);

        $data = array();
        $say = 0;
        foreach ($buluntu as $c) {
            $data[$say]['label'] = $c->buluntu_yeri;
            $say++;
        }

        $veri = '"dataset": [';
        $key = array();

        for ($x = 0; $x <= count($yilyaz) - 1; $x++) {
            $veri .= '{"seriesname": "' . $yilyaz[$x] . '","data": ';
            for ($i = 0; $i <= count($data); $i++) {

                $sonuc = $this->sql->query("SELECT adet FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP where buluntu_yeri = '" . $data[$i]['label'] . "' AND buluntu_yili = " . $yilyaz[$x]." AND adet > 10",false, false);
                if ($this->sql->count() > 0) {
                    $key[$i]['value'] = $sonuc->adet;
                } else {
                    $key[$i]['value'] = "";
                }
            }
            $veri .= json_encode($key) . '}';

            if ($x < $kacyil) {
                $veri .= ',';
            }
        }

        $kategori = '"categories": [{"category": ' . json_encode($data) . '}],';
        $json = $kategori . $veri . ']';

        $file = 'temp/buluntu_yillara_gore.json';
        @unlink($file);
        $dosya = fopen($file, 'w');
        fwrite($dosya, $json);
        fclose($dosya);
    }

    function yillara_gore_buluntu_rapor_pie(){

        $yillar = $this->sql->query("SELECT DISTINCT buluntu_yili FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP) TEMPS order by buluntu_yili ASC", true, false);
        $yilyaz = array();

        $data = array();
        foreach ($yillar as $aa) {
            $yilyaz[] = $aa->buluntu_yili;
        }

        # WHERE buluntu_yeri LIKE '%Odeion%' OR buluntu_yeri LIKE '%Roma Hamamı%' OR buluntu_yeri LIKE '%Yamaç Hamamı%' OR buluntu_yeri LIKE '%Nekropol%' OR buluntu_yeri LIKE '%Tiyatro%'
        $buluntu = $this->sql->query("SELECT DISTINCT buluntu_yeri FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP) TEMPS ", true, false);

        $veri = '';

        $s = 0;
        foreach($buluntu as $b){
                $sonuc = $this->sql->query("SELECT adet FROM (SELECT * FROM  rp_yillara_gore_buluntu) TEMP where buluntu_yeri = '" . $b->buluntu_yeri . "'",false, false);
                if ($this->sql->count() > 0) {
                    $data[$s]['label'] = $b->buluntu_yeri;
                    $data[$s]['value'] =  $sonuc->adet;
                } else {
                    $data[$s]['label'] = $b->buluntu_yeri;
                    $data[$s]['value'] = "0";
                }

            $s++;
        }

        $kategori = '"data": ' . json_encode($data);
        $json = $kategori . $veri;

        echo $json;
    }

    function yillara_gore_formobje(){
        $kacyil = 4;
        $yil = intval(date('Y'));
        $sonucyil = intval($yil) - $kacyil;

        $yillar = $this->sql->query("SELECT DISTINCT buluntu_yili FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_formobje) TEMP where buluntu_yili BETWEEN $sonucyil AND $yil AND adet > 10) TEMPS", true, false);
        $yilyaz = array();

        foreach ($yillar as $aa) {
            $yilyaz[] = $aa->buluntu_yili;
            echo $aa->yil;
        }

        $buluntu = $this->sql->query("SELECT DISTINCT form_obje FROM (SELECT * FROM (SELECT * FROM  rp_yillara_gore_formobje) TEMP where buluntu_yili BETWEEN $sonucyil AND $yil AND adet > 10) TEMPS", true, false);

        $data = array();
        $say = 0;
        foreach ($buluntu as $c) {
            $data[$say]['label'] = $c->form_obje;
            $say++;
        }

        $veri = '"dataset": [';
        $key = array();

        for ($x = 0; $x <= count($yilyaz) - 1; $x++) {
            $veri .= '{"seriesname": "' . $yilyaz[$x] . '","data": ';
            for ($i = 0; $i <= count($data); $i++) {

                $sonuc = $this->sql->query("SELECT adet FROM (SELECT * FROM  rp_yillara_gore_formobje) TEMP where form_obje = '" . $data[$i]['label'] . "' AND buluntu_yili = " . $yilyaz[$x]." AND adet > 10",false, false);
                if ($this->sql->count() > 0) {
                    $key[$i]['value'] = $sonuc->adet;
                } else {
                    $key[$i]['value'] = "";
                }
            }
            $veri .= json_encode($key) . '}';

            if ($x < $kacyil) {
                $veri .= ',';
            }
        }

        $kategori = '"categories": [{"category": ' . json_encode($data) . '}],';
        $json = $kategori . $veri . ']';

        $file = 'temp/formobje_yillara_gore.json';
        @unlink($file);
        $dosya = fopen($file, 'w');
        fwrite($dosya, $json);
        fclose($dosya);
    }

    function buluntu_yeri_anasayfa($bk_id = 35){

        /*
        $roma = 35;
        $nekropol = 3;
        $yamac_hamami = 62;
        $odeion = 34;
        */

        $query = 'SELECT lb.list_adi as buluntu_yeri, SUBSTRING(bk.buluntu_tarihi,-4,4) as buluntu_yili, count(*) as adet from buluntu_karti as bk LEFT JOIN list_data as lb ON lb.list_id = bk.bk_buluntuyeri_id WHERE bk.bk_buluntuyeri_id IN('.$bk_id.') AND SUBSTRING(bk.buluntu_tarihi,-4,4) <= '.date('Y').' AND SUBSTRING(bk.buluntu_tarihi,-4,4) != \'\' group by bk.bk_buluntuyeri_id, SUBSTRING(bk.buluntu_tarihi,-4,4)';

        $buluntu = $this->sql->query($query, true, false);

        $results = array();

        $div = '';
        $chart = '';

        $grafik_tipi = 'pie3d';

        foreach($buluntu as $b){
            $results[$b->buluntu_yeri][$b->buluntu_yili] = $b->adet;
        }

        $toplamBuluntu = count($results);

        $setcol = '12';
        $setheight = '400px';

        if($toplamBuluntu > 1) {
            $setcol = '6';
            $setheight = '400px';
        }

        $s = 0;

        foreach($results as $key => $value){

            $data = array();
            $totalCount = 0;

            $x = 0;
            foreach($value as $a => $b){

                $data[$x]['label'] = (string)$a;
                $data[$x]['value'] =  $b;

                $totalCount = $totalCount + intval($b);
                $x++;
            }

            if($totalCount > 0){

                $s = $bk_id;

                $div .= '<div id="line_'.$s.'" style=""></div>';

                $chart .= 'FusionCharts.ready(function() {var myChart'.$bk_id.' = new FusionCharts({type: "'.$grafik_tipi.'", renderAt: "line_'.$s.'", width: "100%", height: "'.$setheight.'", dataFormat: "json",';
                $chart .= 'dataSource: {"chart": {"caption": "'.$key.' <br><br>","subcaption": "Toplam Buluntu: '.$totalCount.'","plottooltext": "$label yılına ait toplam <b>$value</b> buluntu mevcut", "showlegend": "1", "showpercentvalues": "0", "numbersuffix": " adet", "legendposition": "bottom", "theme": "fusion"},';

                $chart .= '"data": ' . json_encode($data);
                $chart .= '}';
                $chart .= '}).render();});';
            }
        }

        $html = $div . '<script type="text/javascript">'. $chart . '</script>';

        $file = 'temp/buluntu_'.$bk_id.'.php';
        @unlink($file);
        $dosya = fopen($file, 'w');
        fwrite($dosya, $html);
        fclose($dosya);

    }


}