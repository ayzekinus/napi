<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
    <title>Sisteme Giriş</title>
    
    
  <!-- Mobile viewport optimization h5bp.com/ad -->
  <meta name="HandheldFriendly" content="True" />
  <meta name="MobileOptimized" content="320" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />

    
        <link rel="stylesheet" href="<?php echo Url::base(); ?>assets/css/giris.css?v=17">
        <link rel="stylesheet" href="<?php echo Url::base(); ?>assets/login/css/animate.css?v=6">


             <script type="text/javascript">
                        var jsPath = '<?php echo Url::base();?>';
                    </script> 

            </head>

            <body>

            <div class="cont">
                <div class="demo animated bounceInUp">
                    <div class="login">

                        <a href="#" class="logo peShiner"><img src="<?php echo Url::base(); ?>assets/img/pari_logo_small.png"/></a>
                        
                        <div class="login__form">
                            <form id="formk" action="">
                            <div class="login__row">
                                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                                </svg>
                                <input type="text" class="login__input name" name="username" placeholder="Kullanıcı Adı" autocomplete="off" tabindex="1"/>
                            </div>
                            <div class="login__row">
                                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                                </svg>
                                <input type="password" class="login__input pass" name="password" placeholder="Şifre" autocomplete="off" tabindex="2"/>
                            </div>
                            <button type="button" class="login__submit btngirisyap" tabindex="3">Giriş Yap</button>
                            <p class="login__signup">Copyright © <?php echo date('Y');?> Celsus Data &nbsp;</p>
                            </form>
                        </div>
                    </div>
                    <div class="app">
                        
                        <div class="app__logout">
                            <svg class="app__logout-icon svg-icon" viewBox="0 0 20 20">
                            <path d="M6,3 a8,8 0 1,0 8,0 M10,0 10,12"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?php echo Url::base(); ?>assets/js/libs/jquery-2.1.1.min.js"></script>
            <!--<script src="<?php echo Url::base(); ?>assets/js/libs/jquery-ui-1.10.3.min.js"></script>-->
            <script src="<?php echo Url::base(); ?>assets/js/jquery.pixelentity.shiner.min.js"></script>
            <script src="<?php echo Url::base(); ?>assets/js/giris.js?v=11"></script>


			
			<script type="text/javascript">

                $(document).ready(function() {
                    $(".peShiner").peShiner({
                        hover: false,
                        duration: 3,
                        color: "black",
                        repeat: 3,
                        reverse: true,
                        delay: 2
                    });
                });


			    var imgCount = 3;
			    var dir = jsPath + 'assets/img/';
			    var randomCount = Math.round(Math.random() * (imgCount - 1)) + 1;
			    var images = new Array;

			    images[1] = "slider1.jpg";
			    images[2] = "slider2.jpg";
			    images[3] = "slider3.jpg";
			   

			    $('.cont').css("background-image", "url("+ dir + images[randomCount] +")");




			</script>

            </body>
            </html>
