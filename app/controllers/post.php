<?php

class post extends Controller
{

    var $sql;

    var $message = array(
        'error_title' => 'Hata!',
        'error_text' => 'İşleminiz tamamlanamadı, lütfen tekrar deneyin!',
        'success_title' => 'Tamamlandı',
        'succes_text' => 'İşleminiz başarıyla tamamlandı.'
    );

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

    /* INSERT & UPDATE */

    function insert($table = ''){

        $table = addslashes(strip_tags(trim($table)));

        if($table == '' || $_SESSION['csrf'] != $_POST['token']){
            $this->json_return();
            die();
        }

        switch($table){
            case 'anakod':
                $this->sec('anakod_ekle');
                $this->anakod_ekle($_POST);
                break;
            case 'buluntu':
                $this->sec('buluntu_ekle');
                $this->buluntu_ekle($_POST);
                break;
            case 'kullanici':
                $this->kullanici_ekle($_POST);
                break;
            case 'listeler':
                $this->liste_olustur_guncelle($_POST);
                break;
            case 'konservasyon':
                $this->konservasyon_olustur_guncelle($_POST);
                break;
            case 'restorasyon':
                $this->restorasyon_olustur_guncelle($_POST);
                break;
                
            case 'evrak_yonetimi':
                    
                $this->sec($table);
                $_POST['evrak_tarihi'] = date('Y-m-d',strtotime($_POST['evrak_tarihi']));
                $this->ekle($_POST, $table);
                break;
            default:
                $this->sec($table);
                $this->ekle($_POST, $table);
                break;
        }

    }

    function update($table = '', $id = 0){

        $table = addslashes(strip_tags(trim($table)));
        $id = addslashes(strip_tags(trim($id)));

        if(($table == '' && (($id == 0) || !is_numeric($id))) || $_SESSION['csrf'] != $_POST['token']){
            $this->json_return();
            die();
        }

        switch($table){
            case 'anakod':
                $this->sec('anakod_duzenle');
                $this->anakod_duzenle($_POST, $id);
                break;
            case 'buluntu':
                $this->sec('buluntu_duzenle');
                $this->buluntu_duzenle($_POST, $id);
                break;
            case 'kullanici':
                $this->kullanici_duzenle($_POST, $id);
                break;
            case 'evrak_yonetimi':
                $this->sec($table);
                $_POST['evrak_tarihi'] = date('Y-m-d',strtotime($_POST['evrak_tarihi']));
                $this->duzenle($_POST, $table,$id);
                break;
            default:
                $this->sec($table);
                $this->duzenle($_POST, $table, $id);
                break;
        }

    }

    function delete($table = ''){
        $table = addslashes(strip_tags(trim($table)));
        $id = addslashes(strip_tags(trim($_POST['ID'])));

        if($table == '' && (($id == 0) || !is_numeric($id))){
            $this->json_return();
            die();
        }

        switch($table){
            case 'anakod':
                $this->sec('anakod_sil');
                $this->anakod_sil($id);
                break;
            case 'buluntu':
                $this->sec('buluntu_karti_sil');
                $this->buluntu_sil($id);
                break;
            case 'listeler':
                $this->sec('liste_sil');
                $this->liste_sil($id);
                break;
            case 'konservasyon':
                $this->sec('buluntu_sil');
                $this->konservasyon_sil($id);
                break;
            case 'restorasyon':
                $this->sec('buluntu_sil');
                $this->restorasyon_sil($id);
                break;
            default:
                if($table == 'evrak')
                    $table = 'evrak_yonetimi';

                if($table == 'demirbas')
                    $table = 'demirbas_listesi';

                if($table == 'kullanici')
                    $table = '_kullanici';

                $this->sec($table."_sil");
                $this->sil($table, $id);
                break;
        }

    }

    /* ANAKOD & BULUNTU */

    private function anakod_ekle($post)
    {
        $_POST = $post;
        $data = array();

        $q = @$this->sql->from('anakod')->orderBy('anakod_id DESC')->limit(1)->get(true);
        $anakod = $q['anakod'];

        if ($this->sql->count() > 0) {
            load::library('anakod');
            $data['anakod'] = Anakod::olustur($anakod);

        }else{
            $data['anakod'] = "AAA";
        }

        foreach ($_POST as $key => $value) {
            if($key != 'token')
                $data[$key] = addslashes($value);
        }

        $this->sonuc = @$this->sql->from('anakod')->insert($data);

        if ($this->sonuc) {
            $lastid = $this->sql->insertId();
            $q = @$this->sql->from('anakod')->where('anakod_id = ' . $lastid)->limit(1)->get(true);

            $this->log('anakod', $lastid, serialize($data), 1);

            $extra = '"anakod": "'.$q['anakod'].'"';
            $this->json_return(true, $lastid, $extra);

        } else {

            $this->json_return();

            $this->error_log($this->sql->error());
        }
    }

    private function anakod_duzenle($post, $uID)
    {
        $_POST = $post;
        $data = array();

        foreach ($_POST as $key => $value) {
            if($key != 'token')
                $data[$key] = addslashes($value);
        }

        $this->sonuc = $this->sql->from('anakod')->where("anakod_id = $uID")->update($data);
        if ($this->sonuc) {
            $this->log('anakod', $uID, serialize($data), 2);
            $this->json_return(true, $uID);
        } else {
            $this->json_return(false, $uID);
            $this->error_log($this->sql->error());
        }
    }

    private function buluntu_ekle($post)
    {

        $_POST = $post;
        $data = array();

        if (is_numeric($_POST['buluntu_no']) && $_POST['buluntu_no'] > 0){

            @$this->sql->from('buluntu_karti')->where('bk_anakod_id = ' . $_POST['bk_anakod_id'] . ' AND buluntu_no = '. $_POST['buluntu_no'])->limit(1)->getAll();

            if($this->sql->count() > 0){
                $this->message['error_text'] = 'Buluntu No daha önce sisteme kayıt edilmiş!';
                $this->json_return();
                die();
            }

            $data['buluntu_no'] = $_POST['buluntu_no'];
        }

        $data['envanterlik'] = 0;

        if ($_POST['bk_hamur_renk_id'] == ''){$_POST['bk_hamur_renk_id'] = 0;}
        if ($_POST['bk_astar_renk_id'] == ''){$_POST['bk_astar_renk_id'] = 0;}
        if ($_POST['bk_buluntuyeri_id'] == ''){$_POST['bk_buluntuyeri_id'] = 0;}
        if ($_POST['bk_formobje_id'] == ''){$_POST['bk_formobje_id'] = 0;}
        if ($_POST['bk_yapim_mlz_id'] == ''){$_POST['bk_yapim_mlz_id'] = 0;}
        if ($_POST['bk_uretimyeri_id'] == ''){$_POST['bk_uretimyeri_id'] = 0;}
        if ($_POST['bk_donem_id'] == ''){$_POST['bk_donem_id'] = 0;}
        if ($_POST['bk_tip_id'] == ''){$_POST['bk_tip_id'] = 0;}

        foreach ($_POST as $key => $value) {
            if (($key != 'gorsel') && ($key != 'buluntu_no') && ($key != 'token'))
                $data[$key] = addslashes($value);
        }

        $this->sonuc = @$this->sql->from('buluntu_karti')->insert($data);

        if ($this->sonuc) {

            $insertID = $this->sql->insertId();
            $gorsel = $_POST['gorsel'];

            if(strlen($gorsel) > 0){
                $gorsel = str_replace('#', '\',\'', $gorsel);
                $gorsel = "'" . $gorsel ."'";

                @$this->sql->from('buluntu_galeri')->where('dosya IN ('.$gorsel.')')->update(array('bk_id' => $insertID));
            }

            $this->log('buluntu_karti', $insertID, serialize($data), 1);

            $this->json_return(true, $insertID);
        } else {

            $this->json_return();
            $this->error_log($this->sql->error());
        }

    }

    private function buluntu_duzenle($post, $id = null)
    {

        $_POST = $post;
        $data = array();

        if ($_POST['bk_hamur_renk_id'] == ''){$_POST['bk_hamur_renk_id'] = 0;}
        if ($_POST['bk_astar_renk_id'] == ''){$_POST['bk_astar_renk_id'] = 0;}
        if ($_POST['bk_buluntuyeri_id'] == ''){$_POST['bk_buluntuyeri_id'] = 0;}
        if ($_POST['bk_formobje_id'] == ''){$_POST['bk_formobje_id'] = 0;}
        if ($_POST['bk_yapim_mlz_id'] == ''){$_POST['bk_yapim_mlz_id'] = 0;}
        if ($_POST['bk_uretimyeri_id'] == ''){$_POST['bk_uretimyeri_id'] = 0;}
        if ($_POST['bk_donem_id'] == ''){$_POST['bk_donem_id'] = 0;}
        if ($_POST['bk_tip_id'] == ''){$_POST['bk_tip_id'] = 0;}

        foreach ($_POST as $key => $value) {
            if (($key != 'gorsel') && ($key != 'token'))
                $data[$key] =  addslashes($value);
        }


        $this->sonuc = @$this->sql->from('buluntu_karti')->where("bk_id = $id")->update($data);

        if ($this->sonuc) {

            $gorsel = $_POST['gorsel'];

            if(strlen($gorsel) > 0){
                $gorsel = str_replace('#', '\',\'', $gorsel);
                $gorsel = "'" . $gorsel ."'";

                @$this->sql->from('buluntu_galeri')->where('dosya IN ('.$gorsel.')')->update(array('bk_id' => $id));
            }

            $this->log('buluntu_karti', $id, serialize($data), 2);

            $this->json_return(true, $id);
        } else {

            $this->json_return();
            $this->error_log($this->sql->error());
        }

    }

    /*  DEFAULT CRUD */

    private function ekle($post, $table)
    {

        $_POST = $post;
        $data = array();

        foreach ($_POST as $key => $value) {
            if (($key != 'galeri_x_gorsel') && ($key != 'evrak_x_secimi') && ($key != 'yayin_x_secimi') &&($key != 'token'))
                $data[$key] = addslashes($value);
        }

        if($table == 'evrak_yonetimi'){
            $data['kayit_tarihi'] = date('Y-m-d H:i');
        }

        $this->sonuc = @$this->sql->from($table)->insert($data);

        if ($this->sonuc) {
            $insertID = $this->sql->insertId();

            if($table == 'acma_rapor'){

                $gorsel = $_POST['galeri_x_gorsel'];

                if(strlen($gorsel) > 0){
                    $gorsel = str_replace('#', '\',\'', $gorsel);
                    $gorsel = "'" . $gorsel ."'";

                    @$this->sql->from('acma_rapor_galeri')->where('dosya IN ('.$gorsel.')')->update(array('acma_rapor_id' => $insertID));
                }
            }

            if($table == 'evrak_yonetimi'){

                $evrak = $_POST['evrak_x_secimi'];

                if(strlen($evrak) > 0){
                    $evrak = str_replace('#', '\',\'', $evrak);
                    $evrak = "'" . $evrak ."'";

                    @$this->sql->from('evrak_yonetimi_dosya')->where('dosya IN ('.$evrak.')')->update(array('evrak_id' => $insertID));
                }

            }

            if($table == 'yayinlar'){

                $dosya = $_POST['yayin_x_secimi'];

                if(strlen($dosya) > 0){
                    $dosya = str_replace('#', '\',\'', $dosya);
                    $dosya = "'" . $dosya ."'";

                    @$this->sql->from('yayinlar_dosya')->where('dosya IN ('.$dosya.')')->update(array('yayin_id' => $insertID));
                }

            }

            $this->log($table, $insertID, serialize($data), 1);
            $this->json_return(true, $insertID);

        } else {

            $this->json_return();
            $this->error_log($this->sql->error());
        }

    }

    private function duzenle($post, $table, $uID)
    {

        $_POST = $post;
        $data = array();

        foreach ($_POST as $key => $value) {
            if (($key != 'galeri_x_gorsel') && ($key != 'evrak_x_secimi') && ($key != 'yayin_x_secimi') && ($key != 'token')) {
                $data[$key] = addslashes($value);
            }
        }

        if($table == 'genel_ayarlar'){
            $data['buluntust_bk_id'] = implode(',',$_POST['buluntust_bk_id']);
            $data['genelst_bk_id'] = implode(',',$_POST['genelst_bk_id']);
        }
        if($table == 'evrak_yonetimi'){
            $data['kayit_tarihi'] = date('Y-m-d H:i');
        }


        $this->sonuc = $this->sql->from($table)->where("ID = $uID")->update($data);
        if ($this->sonuc) {

            if($table == 'acma_rapor'){
                $gorsel = $_POST['galeri_x_gorsel'];

                if(strlen($gorsel) > 0){
                    $gorsel = str_replace('#', '\',\'', $gorsel);
                    $gorsel = "'" . $gorsel ."'";

                    @$this->sql->from('acma_rapor_galeri')->where('dosya IN ('.$gorsel.')')->update(array('acma_rapor_id' => $uID));
                }
            }


            if($table == 'evrak_yonetimi'){
                $evrak = $_POST['evrak_x_secimi'];

                if(strlen($evrak) > 0){
                    $evrak = str_replace('#', '\',\'', $evrak);
                    $evrak = "'" . $evrak ."'";

                    @$this->sql->from('evrak_yonetimi_dosya')->where('dosya IN ('.$evrak.')')->update(array('evrak_id' => $uID));
                }
            }


            if($table == 'yayinlar'){
                $dosya = $_POST['yayin_x_secimi'];

                if(strlen($dosya) > 0){
                    $dosya = str_replace('#', '\',\'', $dosya);
                    $dosya = "'" . $dosya ."'";

                    @$this->sql->from('yayinlar_dosya')->where('dosya IN ('.$dosya.')')->update(array('yayin_id' => $uID));
                }
            }

            $this->log($table, $uID, serialize($data), 2);
            $this->json_return(true, $uID);

        } else {

            $this->json_return(false, $uID);
            $this->error_log($this->sql->error());
        }

    }

    private function sil($table, $ID)
    {
        $this->sonuc = $this->sql->from($table)->where('ID =' . $ID)->delete();

        if ($this->sonuc) {
            $this->json_return(true, $ID);
            $this->log($table, $ID, '', 0);
        } else {
            $this->json_return(false, $ID);
        }
    }

    private function anakod_sil($ID){
        $anakod = $this->sql->from('anakod')->where('anakod_id =' . $ID)->delete();

        if($anakod){
            $buluntu = $this->sql->from('buluntu_karti')->where('bk_anakod_id = ' . $ID)->getAll();
            foreach($buluntu as $b){
                @$this->buluntu_sil($b->bk_id);
            }

            $this->log('anakod', $ID, '', 0);
            $this->json_return(true, $ID);
        }else{
            $this->json_return(false, $ID);
        }

    }

    private function buluntu_sil($ID){

        $this->sonuc = $this->sql->from('buluntu_karti')->where('bk_id =' . $ID)->delete();

        if ($this->sonuc) {
            $data = $this->sql->from('buluntu_galeri')->where("bk_id = $ID")->getAll();

            foreach($data as $d){

                @unlink('uploads/images/'.$d->dosya);
                @unlink('uploads/images/thumb/'.$d->dosya);

            }

            @$this->sql->from('buluntu_galeri')->where("bk_id = $ID")->delete();

            $this->log('buluntu_karti', $ID, '', 0);


            $this->json_return(true, $ID);
        }else{
            $this->json_return(false, $ID);
        }

    }

    /* KULLANICI */

    private function kullanici_ekle($post)
    {
        $ssyetki = $_SESSION['yetki'];

        if (($ssyetki == 'S')) {

            global $config;

            extract($post);

            if (trim($sifre1) != trim($sifre2)) {

                $this->message['error_text'] = 'Girdiğiniz şifreler uyuşmuyor!';
                $this->json_return();

                die();
            }

            $kisitla = "";
            $kacadet = count($kisitlamalar);
            if ($kacadet > 0) {
                foreach ($kisitlamalar as $k) {
                    $kisitla .= $k . ",";
                }
            }

            $kisitlamalar = substr($kisitla, 0, -1);

            $data = array(
                '_kullanici' => $kullanici,
                '_sifre' => md5($config['hash'] . $sifre1),
                'durum' => $durum,
                'adsoyad' => $adsoyad,
                'yetki' => $yetki,
                'olusturulma_tarihi' => date('d.m.Y H:i'),
                'online' => 0,
                'aciklama' => addslashes($aciklama),
                'kisitlamalar' => addslashes($kisitlamalar),
                'telefon' => $telefon,
                'ogrenim_durumu' => $ogrenim_durumu,
                'eposta' => $eposta,
                'universite' => $universite

            );

            $s = $this->sql->from('_kullanici')->insert($data);
            if ($s) {
                $this->json_return(true, $this->sql->insertId());
                $this->log('_kullanici', $this->sql->insertId(), '', 1);
            } else {
                $this->json_return();
                $this->error_log($this->sql->error());
            }
        } else {
            $this->json_return();
            $this->error_log('Yetki Yok');
        }
    }

    private function kullanici_duzenle($post, $id = null)
    {
        $ssyetki = $_SESSION['yetki'];

        if (($ssyetki == 'S')) {

            global $config;

            extract($post);

            if (!is_numeric($id)) {
                $this->json_return();
                die();
            }

            $kisitla = "";
            $kacadet = count($kisitlamalar);
            if ($kacadet > 0) {
                foreach ($kisitlamalar as $k) {
                    $kisitla .= $k . ",";
                }
            }

            $kisitlamalar = substr($kisitla, 0, -1);

            $data = array(
                '_kullanici' => $kullanici,
                'durum' => $durum,
                'adsoyad' => $adsoyad,
                'yetki' => $yetki,
                'aciklama' => $aciklama,
                'kisitlamalar' => addslashes($kisitlamalar),
                'telefon' => $telefon,
                'ogrenim_durumu' => $ogrenim_durumu,
                'eposta' => $eposta,
                'universite' => $universite
            );

            if (!empty($sifre1) || !empty($sifre2)) {

                if ($sifre1 === $sifre2) {
                    $data['_sifre'] = md5($config['hash'] . $sifre1);
                } else {
                    $this->message['error_text'] = 'Girdiğiniz şifreler uyuşmuyor!';
                    $this->json_return();

                    die();
                }
            }

            $s = $this->sql->from('_kullanici')->where("ID = $id")->update($data);
            if ($s) {
                $this->json_return(true, $id);
                $this->log('_kullanici', $id, '', 2);
            } else {
                $this->json_return();
                $this->error_log($this->sql->error());
            }
        } else {
            $this->json_return();
            $this->error_log('Yetki Yok');
        }
    }

    /* LISTELER */

    private function liste_olustur_guncelle($post)
    {

        if ($_SESSION['yetki'] != 'S') die();

        $liste = $post["list_adi"];
        $listeID = $post["list_id"];
        $tur = $post['tip'];

        if($listeID != 0){
            @$this->sql->from('list_data')->where("tip = $tur and list_adi = '$liste' and list_adi <> $listeID")->orderBy('list_id DESC')->get();
        }else{
            @$this->sql->from('list_data')->where("tip = $tur and list_adi = '$liste'")->orderBy('list_id DESC')->get();
        }

        if ($this->sql->count() > 0 && $listeID == 0) {
            $this->message['error_text'] = 'İşleminiz gerçekleşmedi, kayıt sistemde mevcut';
            $this->json_return(false);
            die();
        }

        $data = array(
            'list_adi' => $liste,
            'tip' => $tur,
            'form' => $_POST['form']
        );

        if (is_numeric($listeID) && $listeID != 0) {

            $q = $this->sql->from('list_data')->where("list_id = $listeID")->update($data);

            if ($q) {
                $this->json_return(true, $listeID);
            } else {
                $this->json_return();
            }

        } else {

            $q = $this->sql->from('list_data')->insert($data);
            if ($q) {
                $this->json_return(true, $this->sql->insertId());
            } else {
                $this->json_return();
                $this->error_log($this->sql->error());
            }

        }

    }

    private function liste_sil($ID){
        $this->sec('liste_sil');

        $this->sonuc = $this->sql->from('list_data')->where('list_id =' . $ID)->delete();
        if ($this->sonuc) {
            $this->json_return(true, $ID);
            $this->log('list_data', $ID, '', 0);
        } else {
            $this->json_return(false, $ID);
        }
    }

    /* KONSERVASYON */

    private function konservasyon_olustur_guncelle($post){

        $id = $post['kons_bk_id'];
        $islem = $post['islem'];
        $sezon = $post['sezon'];
        $tip = $post['tip'];

        $ozellik = '';
        $mevcut_durum = '';
        $bozulmalar = '';
        $temizlik = '';
        $yapistirma = '';
        $tumleme = '';
        $saglamlastirma = '';


        $ozellik = implode(',', $post['opt_obje_ozellik']);
        $mevcut_durum = implode(',', $post['opt_mevcut_durum']);
        $bozulmalar = implode(',', $post['opt_bozulmalar']);
        $temizlik = implode(',', $post['opt_temizlik']);
        $yapistirma = implode(',', $post['opt_yapistirma']);
        $tumleme = implode(',', $post['opt_tumleme']);
        $saglamlastirma = implode(',', $post['opt_saglamlastirma']);


        $data = array(
            'kons_bk_id' => $id,
            'sezon' => $sezon,
            'tip' => $tip,
            'lab_giris' => $post['lab_giris'],
            'lab_cikis' => $post['lab_cikis'],
            'parca_sayisi' => $post['parca_sayisi'],
            'konservator' => $post['konservator'],
            'aciklama' => $post['aciklama'],
            'opt_obje_ozellik' => $ozellik,
            'opt_mevcut_durum' => $mevcut_durum,
            'opt_bozulmalar' => $bozulmalar,
            'opt_temizlik' => $temizlik,
            'opt_yapistirma' => $yapistirma,
            'opt_tumleme' => $tumleme,
            'opt_saglamlastirma' => $saglamlastirma
        );

        $sonuc = '';
        $logtype = 1;
        if($islem == 0){
            $sonuc = $this->sql->from('konservasyon_listesi')->insert($data);
        }else{
            $sonuc = $this->sql->from('konservasyon_listesi')->where('kons_bk_id = ' . $id)->update($data);
            $logtype = 2;
        }


        if ($sonuc) {
            $this->json_return(true, $id);
            $this->log('konservasyon_listesi', $id, serialize($data), $logtype);
        } else {
            $this->json_return();
        }
    }

    private function konservasyon_sil($ID){
        $d = $this->sql->from('konservasyon_listesi')->where('kons_bk_id =' . $ID)->delete();

        if($d){
            $this->log('konservasyon_listesi', $ID, '', 0);
            $this->json_return(true, $ID);
        }else{
            $this->json_return(false, $ID);
        }

    }

    /* RESTORASYON */

    private function restorasyon_olustur_guncelle($post)
    {

        $id = $post['rest_bk_id'];
        $islem = $post['islem'];
        $sezon = $post['sezon'];
        $tip = $post['tip'];


        $data = array(
            'rest_bk_id' => $id,
            'sezon' => $sezon,
            'tip' => $tip,
            'uygulayan' => $post['uygulayan'],
            'konservator' => $post['konservator'],
            'temsilci' => $post['temsilci'],
            'mevcut_durum' => $post['mevcut_durum'],
            'uygulanan_islemler' => $post['uygulanan_islemler'],
            'kullanilan_malzeme' => $post['kullanilan_malzeme']
        );

        $sonuc = '';
        $logtype = 1;
        if ($islem == 0) {
            $sonuc = $this->sql->from('restorasyon_listesi')->insert($data);
        } else {
            $sonuc = $this->sql->from('restorasyon_listesi')->where('rest_bk_id = ' . $id)->update($data);
            $logtype = 2;
        }


        if ($sonuc) {
            $this->json_return(true, $id);
            $this->log('restorasyon_listesi', $id, serialize($data), $logtype);
        } else {
            $this->json_return();
        }

    }

    private function restorasyon_sil($ID){
        $d = $this->sql->from('restorasyon_listesi')->where('rest_bk_id =' . $ID)->delete();

        if($d){
            $this->log('restorasyon_listesi', $ID, '', 0);
            $this->json_return(true, $ID);
        }else{
            $this->json_return(false, $ID);
        }

    }

    /* OTHER */

    function yukle()
    {
        $return = '';

        $_SESSION['file_name'] = 'error';

        /* just use uploadify
        $fileName = $_FILES["Filedata"]['name'];
        $tempLoc = $_FILES["Filedata"]['tmp_name'];
        */

        $fileName = $_FILES["file"]['name'];
        $tempLoc = $_FILES["file"]['tmp_name'];

        $filePath = str_replace('index.php', '', $_SERVER["SCRIPT_FILENAME"]) . $_REQUEST['folderFile'];
        $filePath2 = str_replace('index.php', '', $_SERVER["SCRIPT_FILENAME"]) . $_REQUEST['folderFile'] . '/thumb';

        $arr = array(
            'name' => $fileName,
            'tmp_name' => $tempLoc
        );

        ini_set('memory_limit', '192M');
        ini_set('max_execution_time', '90');

        $upload = load::library('upload');
        $upload->upload($arr);

        if ($upload->uploaded) {

            $newName = Rand(1, 9999) . time();
            $upload->file_new_name_body = $newName;

            if ($_REQUEST['ext'] == 'image') {

                if ((bool)$_REQUEST['resize']) {
                    $upload->image_resize = true;
                    $upload->image_x = $_REQUEST['width'];
                    $upload->image_ratio_y = true;
                }

                $upload->jpeg_quality = 100;
            }

            $upload->process($filePath);

            if ($upload->processed) {

                $return = $newName . "." . $upload->file_src_name_ext;

                $_SESSION['file_name'] = $return;

                if ($_REQUEST['ext'] == 'image' && (bool)$_REQUEST['thumb']) {
                    $upload->file_new_name_body = $newName;
                    $upload->image_resize = (bool)$_REQUEST['resize'];
                    $upload->image_x = $_REQUEST['twidth'];
                    $upload->image_ratio_y = true;

                    $upload->process($filePath2);
                }

                $upload->clean();
            } else {
                $return = 'error';
            }

        } else {
            $return = 'error';
        }

        echo $return;
    }

    function envanterlik(){
        $this->sec('buluntu_ekle');

        $id = @$_POST['id'];
        if(!is_numeric($id))
            die("0");

        $data = array(
            'envanter_bk_id' => addslashes($id),
            'sezon' => date('Y')
        );

        $d = $this->sql->from('envanterlik_liste')->where("envanter_bk_id = $id AND sezon = " . date('Y'))->get();
        if($this->sql->count() > 0){

            @$this->sql->from('envanterlik_liste')->where("id = $d->id")->delete();
            @$this->sql->from('envanterlik_liste')->where("envanter_bk_id = $id")->get();

            if($this->sql->count() < 1){
                @$this->sql->from('buluntu_karti')->where("bk_id = $id")->update(array('envanterlik' => 0));
                echo "2";
                # Buluntuya ait gecmis yillara ait kayit yoksa.
            }else{
                echo "3";
                # Buluntuya ait gecmis yillara ait kayit varsa.
            }

            $this->log('envanterlik_liste', $d->id, serialize($data), 0);
        }else{
            $q = $this->sql->from('envanterlik_liste')->insert($data);

            if($q){

                @$this->sql->from('buluntu_karti')->where("bk_id = $id")->update(array('envanterlik' => 1));

                $lastid = $this->sql->insertId();
                $this->log('envanterlik_liste', $lastid, serialize($data), 1);

                echo "1";
            }else{
                echo "0";
            }
        }
    }

    function yuklenen_dosya(){
        echo  $_SESSION['file_name'];
    }

    function galeri(){

        $dosya = addslashes(strip_tags($_POST['dosya']));
        $table = addslashes(strip_tags($_POST['table']));

        if(empty($dosya)){
            echo "0";
            die();
        }

        if ($table != 'buluntu_galeri' && $table != 'acma_rapor_galeri' && $table != 'evrak_yonetimi_dosya' && $table != 'yayinlar_dosya'){
            die();
        }

        $this->sonuc = @$this->sql->from($table)->insert(array('dosya' => $dosya, 'kim' => $_SESSION['ID']));
        if($this->sonuc){
            echo "1";
        }else{
            echo "0";
        }
    }

    function galeri_sil() {
        $dosya = addslashes(strip_tags($_POST['dosya']));
        $table = addslashes(strip_tags($_POST['table']));

        if ($table != 'buluntu_galeri' && $table != 'acma_rapor_galeri' && $table != 'evrak_yonetimi_dosya' && $table != 'yayinlar_dosya'){
            die();
        }

        $this->sonuc = $this->sql->from($table)->where("dosya = '$dosya'")->delete();
        if ($this->sonuc) {

            if($table == 'evrak_yonetimi_dosya'){
                @unlink('uploads/docs/'.$dosya);
            }else if($table == 'yayinlar_dosya'){
                @unlink('uploads/publications/'.$dosya);
            }else{
                @unlink('uploads/images/'.$dosya);
                @unlink('uploads/images/thumb/'.$dosya);
            }

            echo "1";
        } else {
            echo "0";
        }
    }

    private function sec($segment = '') {

        $this->session_check();

        if($_SESSION['yetki'] != 'S'){
            $yetki = $_SESSION['kisitlamalar'];

            $_A = array('A0','A1','A2');
            $A = array('anakod_listesi,anakod_listesi_data,anakod_detay','anakod_ekle','anakod_duzenle');
            $kontrol = str_replace($_A,$A,$yetki);

            $_B = array('B0','B1','B2');
            $B = array('buluntu_listesi,buluntu_listesi_data,buluntu_detay,buluntu_galeri','buluntu_ekle','buluntu_duzenle');
            $kontrol .= str_replace($_B,$B, $yetki);

            $_AR = array('AR0','AR1','AR2');
            $AR = array('acma_rapor_listesi,acma_rapor_listesi_data,acma_rapor_detay,acma_rapor_galeri','acma_rapor,acma_rapor_ekle','acma_rapor,acma_rapor_duzenle');
            $kontrol .= str_replace($_AR,$AR, $yetki);

            $_EY = array('EY0','EY1','EY2');
            $EY = array('evrak_listesi,evrak_listesi_data,evrak_detay','evrak_yonetimi,evrak_ekle','evrak_yonetimi,evrak_duzenle');
            $kontrol .= str_replace($_EY,$EY,$yetki);

            $_DL = array('DL0','DL1','DL2');
            $DL = array('demirbas_listesi,demirbas_listesi_data,demirbas_detay','demirbas_listesi,demirbas_ekle','demirbas_listesi,demirbas_duzenle');
            $kontrol .= str_replace($_DL,$DL,$yetki);



            $_Y = array('Y0','Y1','Y2');
            $Y = array('yayin_listesi,yayin_listesi_data,yayin_detay','yayinlar,yayin_ekle','yayinlar,yayin_duzenle');
            $kontrol .= str_replace($_Y,$Y,$yetki);


            $_DELETE = array('A3', 'B3', 'AR3', 'EY3', 'DL3', 'Y3');
            $DELETE = array('anakod_sil','buluntu_karti_sil','acma_rapor_sil','evrak_yonetimi_sil', 'demirbas_listesi_sil','yayinlar_sil');
            $kontrol .= str_replace($_DELETE,$DELETE, $yetki);



            $yarr = explode(',',$kontrol);

            if (!in_array($segment, $yarr, true)) {
                load::view('404');
                die();
            }
        }

    }

    private function session_check(){
        $time_difference = strtotime(date("d.m.Y H:i")) - $_SESSION['islem_tarihi'];
        $hours = round($time_difference / 3600);
        //$days = round($time_difference / 86400);

        if($hours > 0){
            @$this->sql->from('_kullanici')->where('ID = '. $_SESSION['ID'])->update(array('online' => 0));

            $this->message['error_text'] = 'Oturumunuz sona ermiş!';
            $this->json_return(false, '#');

            Session::destroy();
            die();
        }

        $_SESSION['islem_tarihi'] = strtotime(date("d.m.Y H:i"));
    }

    private function log($tablo, $data_id, $data, $islem){

        if($_SESSION['ID'] != 0){
            @$this->sql->from('_log')->insert(array(
                'tablo' => $tablo,
                'kullanici_id' => $_SESSION['ID'],
                'data_id' => $data_id,
                'data' => $data,
                'islem' => $islem,
                'tarih' => date('d.m.Y H:i')));
        }
    }

    private function error_log($error_msg = '')
    {
        $dosya_adi = ROOT . '/temp/error_log.msg';
        $dosya = fopen($dosya_adi, 'a+');
        fwrite($dosya, $error_msg);
        fclose($dosya);
    }

    private function json_return($success = false, $id = 0, $extra = ''){
        if ($success){
            if($extra != '')
                $extra = ", " . $extra;

            echo '{ "success": true, "data_id": '.$id.', "time": "'.date("d.m.Y H:i").'", "msg_title": "'.$this->message['success_title'].'", "msg_text": "'.$this->message['succes_text'].'"'.$extra.'}';
        }
        else{
            echo '{ "success": false, "data_id": "'.$id.'", "time": "'.date("d.m.Y H:i").'", "msg_title": "'.$this->message['error_title'].'", "msg_text": "'.$this->message['error_text'].'", "error": "'.$this->sql->error_query().'"}';
        }
    }

}