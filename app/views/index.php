<!DOCTYPE html>
<html lang="en-us" style="background-image: url(<?php echo Url::base();?>assets/img/paper.png);">
<head>
	<meta charset="utf-8">
	<title> :: Celsus Data :: </title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- #CSS Links -->
	<!-- Basic Styles -->

	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/js/zebra_datepicker/css/metallic.css?v=12">
	<link rel='stylesheet' type="text/css" media="screen" href='<?php echo Url::base(); ?>assets/js/touchspin/jquery.bootstrap-touchspin.min.css?v=4'>

	<link rel='stylesheet' href='<?php echo Url::base(); ?>assets/js/sweet-alert/sweet-alert.css'>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/css/bootstrap.min.css?v=5">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/css/font-awesome.min.css">

	<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/css/smartadmin-production-plugins.min.css?v=1991">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/css/smartadmin-production.min.css?v=205">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/css/smartadmin-skins.min.css">

	<!--<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/js/plugin/select2/select2.css?v=100">-->

	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>assets/css/theme_<?php echo $_SESSION['tema'];?>.css?v=203">

	<!-- #FAVICONS -->
	<link rel="shortcut icon" href="<?php echo Url::base();?>assets/img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo Url::base();?>assets/img/favicon/favicon.ico" type="image/x-icon">

	<!-- #GOOGLE FONT -->
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">-->

	<!-- #APP SCREEN / ICONS -->
	<!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
	<link rel="apple-touch-icon" href="<?php echo Url::base();?>assets/img/splash/sptouch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo Url::base();?>assets/img/splash/touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo Url::base();?>assets/img/splash/touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo Url::base();?>assets/img/splash/touch-icon-ipad-retina.png">

	<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- Startup image for web apps -->
	<link rel="apple-touch-startup-image" href="<?php echo Url::base();?>assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
	<link rel="apple-touch-startup-image" href="<?php echo Url::base();?>assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
	<link rel="apple-touch-startup-image" href="<?php echo Url::base();?>assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	<script type="text/javascript">
		var jsPath = '<?php echo Url::base();?>';
		var form = null;
		var dt = null;
		var year = '<?php echo date('Y');?>';
		var select_return = 'Arama yapın..';
	</script>

</head>


<body class="menu-on-top">

<aside id="left-panel">

	<nav>

		<ul class="menuler">
			<li class="">
				<a  class="ajax" href="index/anasayfa" title="Anasayfa"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Anasayfa</span></a>
			</li>

			<?php

			$yetki = $_SESSION['kisitlamalar'];
			$yarr = explode(',',$yetki);

			if (($_SESSION['yetki'] == 'S') || in_array('A0', $yarr, true)) { ?>

				<li class="menu_anakod">
					<a href="#"><i class="fa fa-lg fa-fw fa-cube"></i> <span class="menu-item-parent">Anakod</span></a>

					<ul>
						<li><a class="ajax" href="index/anakod_ekle"><i class="fa fa-fw fa-plus"></i> Oluştur</a></li>
						<li><a class="ajax" href="index/anakod_listesi"><i class="fa fa-fw fa-table"></i> Listele</a></li>
					</ul>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('B0', $yarr, true)) { ?>

				<li class="menu_buluntu">
					<a  href="#"><i class="fa fa-lg fa-fw fa-cubes"></i> <span class="menu-item-parent">Buluntu</span></a>
					<ul>
						<li><a class="ajax" href="index/buluntu_ekle"><i class="fa fa-fw fa-plus"></i> Oluştur</a></li>
						<li><a class="ajax" href="index/buluntu_listesi"><i class="fa fa-fw fa-table"></i> Listele</a></li>
						<li style="border-bottom: 1px solid #ddd;"></li>

						<li><a class="ajax" href="index/buluntu_envanterlik"><i class="fa fa-tags"></i> Envanterlik Eserler</a></li>
						<li><a class="ajax" href="index/buluntu_konservasyon"><i class="fa fa-file-text"></i> Konservasyon Listesi</a></li>
						<li><a class="ajax" href="index/buluntu_restorasyon"><i class="fa fa-list-alt"></i> Restorasyon Listesi</a></li>
						<li style="border-bottom: 1px solid #ddd;"></li>

						<li><a class="ajax" href="index/buluntu_listesi_galeri"><i class="fa fa-fw fa-camera"></i> Buluntu Galerisi</a></li>
					</ul>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('AR0', $yarr, true)) { ?>

				<li class="menu_acmarapor">
					<a  href="#"><i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">Açma Rapor</span></a>
					<ul>
						<li><a class="ajax" href="index/acma_rapor_ekle"><i class="fa fa-fw fa-plus"></i> Oluştur</a></li>
						<li><a class="ajax" href="index/acma_rapor_listesi"><i class="fa fa-fw fa-table"></i> Listele</a></li>
					</ul>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('EY0', $yarr, true)) { ?>

				<li class="menu_evrak">
					<a  href="#"><i class="fa fa-lg fa-fw fa-envelope"></i> <span class="menu-item-parent">Evrak Yönetimi</span></a>
					<ul>
						<li><a class="ajax" href="index/evrak_ekle"><i class="fa fa-fw fa-plus"></i> Oluştur</a></li>
						<li><a class="ajax" href="index/evrak_listesi/gelen"><i class="fa fa-fw fa-table"></i> Listele</a></li>
					</ul>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('DL0', $yarr, true)) { ?>

				<li class="menu_demirbas">
					<a href="#"><i class="fa fa-lg fa-sitemap"></i> <span class="menu-item-parent">Demirbaş</span></a>
					<ul>
						<li><a class="ajax" href="index/demirbas_ekle"><i class="fa fa-fw fa-plus"></i> Oluştur</a></li>
						<li><a class="ajax" href="index/demirbas_listesi"><i class="fa fa-fw fa-table"></i> Listele</a></li>
					</ul>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('PD0', $yarr, true)) { ?>
				<li style="display: none;">
					<a  class="ajax" href="#"><i class="fa fa-lg fa-fw fa-shield"></i> <span class="menu-item-parent">Depo</span></a>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('Y0', $yarr, true)) { ?>


				<li>
					<a  class="ajax" href="#"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Yayınlar</span></a>
					<ul>

						<li><a class="ajax" href="index/yayin_ekle"><i class="fa fa-fw fa-plus"></i> Oluştur</a></li>
						<li><a class="ajax" href="index/yayin_listesi"><i class="fa fa-fw fa-table"></i> Listele</a></li>

					</ul>
				</li>

			<?php }

			if (($_SESSION['yetki'] == 'S') || in_array('R0', $yarr, true)) { ?>


				<li>
					<a  class="ajax" href="#"><i class="fa fa-lg fa-fw fa-bar-chart"></i> <span class="menu-item-parent">İstatistikler</span></a>
					<ul>

						<li><a href="index/istatistik_sihirbazi" class="ajax"><i class="fa fa-fw fa-bolt"></i> İstatistik Sihirbazı</a></li>

					</ul>
				</li>

			<?php }
			?>

			

			<li>
				<a href="https://forms.gle/iZFb9w9zkTKL53Zv6"><i class="fa fa-lg fa-fw fa-send"></i> <span class="menu-item-parent">Izin</span></a>
			</li>
            <!--
			<li>
				<a  class="ajax" href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Hesabım</span></a>
			</li>

			-->

			<?php

			if ($_SESSION['yetki'] == 'S') { ?>
				<li class="menu_ayarlar">
					<a  class="ajax" href="#"><i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Yönetim</span></a>
					<ul>

						<li><a href="index/genel_ayarlar" class="ajax"><i class="fa fa-fw fa-cog"></i> Genel Ayarlar</a></li>

						<li style="border-bottom: 1px solid #ddd;"></li>

						<li><a href="index/listeler" class="ajax"><i class="fa fa-fw fa-table"></i> Listeler</a></li>
						<li><a href="index/kullanicilar" class="ajax"><i class="fa fa-fw fa-user"></i> Kullanıcılar</a></li>

						<li style="border-bottom: 1px solid #ddd;"></li>

						<li><a href="index/islem_gecmisi" class="ajax"><i class="fa fa-fw fa-star"></i> İşlem Geçmişi</a></li>
						<li><a href="index/giris_loglari" class="ajax"><i class="fa fa-fw fa-clock-o"></i> Giriş Logları</a></li>
						<li><a href="index/hatali_girisler" class="ajax"><i class="fa fa-fw fa-history"></i> Hatalı Girişler</a></li>
					</ul>
				</li>
			<?php } ?>


			<li>
				<a href="index/cikis"><i class="fa fa-lg fa-fw fa-power-off"></i> <span class="menu-item-parent">Çıkış Yap</span></a>
			</li>

		</ul>

	</nav>


</aside>
<!-- END NAVIGATION -->

<!-- #MAIN PANEL -->
<div id="main" role="main">

	<!-- RIBBON -->
	<div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning'></i> Sayfayı Yenileyin" data-html="true" data-reset-msg="Dikkat, kayıt edilmeyen değişiklikler kaybolacaktır."><i class="fa fa-refresh"></i></span>
				</span>

		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<!-- This is auto generated -->
		</ol>
		<!-- end breadcrumb -->

		<div style="float:right;line-height: 40px;color: #BBB;" >Merhaba, <span style="color: #E4E4E4 !important;"><?php echo $_SESSION['adsoyad'];?></span> hoşgeldin.</div>

	</div>
	<!-- END RIBBON -->

	<!-- #MAIN CONTENT -->
	<div id="content">

	</div>

	<!-- END #MAIN CONTENT -->

</div>
<!-- END #MAIN PANEL -->


<!-- #PAGE FOOTER -->
<div class="page-footer">
	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<span class="txt-color-white">Copyright <span class="hidden-xs"> Celsus Data</span> © <?php echo date('Y');?></span>
		</div>

		<div class="col-xs-6 col-sm-6">
			<a href="#" class="logo-cd"><img src="<?php echo Url::base();?>assets/img/logo-cd.png" height="24"/> </a>
			<span class="txt-color-white" style="float: right;">Ver: 19.0815</span>

		</div>

		<!-- end col -->
	</div>
	<!-- end row -->
</div>
<!-- END FOOTER -->

<!-- #PLUGINS -->

<script src="<?php echo Url::base(); ?>assets/js/libs/jquery-2.1.1.min.js?v=21212"></script>
<script src="<?php echo Url::base(); ?>assets/js/jquery-ui-1.10.4/js/jquery-ui-1.10.4.custom.min.js?v=31212"></script>

<script src="<?php echo Url::base(); ?>assets/js/datatables/datatables.min.js?v=81212"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>

<script src="<?php echo Url::base(); ?>assets/js/datatables/bootstrap.datatables.js?v=3121"></script>
<script src="<?php echo Url::base(); ?>assets/js/plugin/datatables/dataTables.colVis.min.js?v=31122"></script>
<script src="<?php echo Url::base(); ?>assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo Url::base(); ?>assets/js/sweet-alert/sweet-alert.min.js?v=312112"></script>

<script src="<?php echo Url::base(); ?>assets/js/plugin/ckeditor/ckeditor.js?v=2"></script>
<script src="<?php echo Url::base(); ?>assets/js/zebra_datepicker/javascript/zebra_datepicker.src.js"></script>
<script src="<?php echo Url::base(); ?>assets/js/touchspin/jquery.bootstrap-touchspin.min.js?v=31221"></script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo Url::base(); ?>assets/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo Url::base(); ?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo Url::base(); ?>assets/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo Url::base(); ?>assets/js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<!--<script src="<?php echo Url::base(); ?>assets/js/smartwidgets/jarvis.widget.min.js"></script>-->

<!-- EASY PIE CHARTS -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/select2/select2.min.js?v=400"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<!--<script src="<?php echo Url::base(); ?>assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>-->

<!-- browser msie issue fix -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices: you can disable this in app.js -->
<script src="<?php echo Url::base(); ?>assets/js/plugin/fastclick/fastclick.min.js"></script>


<!-- MAIN APP JS FILE -->
<script src="<?php echo Url::base(); ?>assets/js/app.min.js"></script>

</body>

</html>