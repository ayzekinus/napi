<script type="text/javascript" src="<?php echo Url::base();?>assets/js/fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="<?php echo Url::base();?>assets/js/fusioncharts/themes/fusioncharts.theme.fint.js"></script>
<!-- widget grid -->
<section id="widget-grid" class="">

    <?php if($ayarlar->mod_minist == 1){?>
    <div class="row">
        <div class="col-md-2 col-xs-6">
            <div class="hpanel" style="border: 1px solid #AAAEAF;">
                <div class="panel-body no-padding" style="height: 60px !important;">
                    <div class="pull-right" style="opacity:0.8;font-size: 34px;padding-top:3px;color: #6F7272 !important;">
                        <a href="index/anakod_listesi" class="ajax" style="color: #6F7272 !important;"><i class="fa fa-lg fa-fw fa-cube"></i></a>
                    </div>

                    <div class="value-block pull-left"  style="color: #6F7272 !important;">
                        <div class="value-self"><?php echo $anakod_toplam;?></div>
                        <div class="value-title">Anakod</div>
                    </div>
                </div>

                <div class="panel-foot foot-blue">

                </div>
            </div>
        </div>

        <div class="col-md-2 col-xs-6">
            <div class="hpanel" style="border: 1px solid #AAAEAF;">
                <div class="panel-body no-padding" style="height: 60px !important;">
                    <div class="pull-right" style="opacity:0.8;font-size: 34px;padding-top:3px;color: #6F7272 !important;">
                        <a href="index/buluntu_listesi" class="ajax" style="color: #6F7272 !important;"><i class="fa fa-lg fa-fw fa-cubes"></i></a>
                    </div>

                    <div class="value-block pull-left"  style="color: #6F7272 !important;">
                        <div class="value-self"><?php echo $buluntu_toplam;?></div>
                        <div class="value-title">Buluntu</div>
                    </div>
                </div>

                <div class="panel-foot foot-blue">

                </div>
            </div>
        </div>

        <div class="col-md-2 col-xs-6">
            <div class="hpanel" style="border: 1px solid #AAAEAF;">
                <div class="panel-body no-padding" style="height: 60px !important;">
                    <div class="pull-right" style="opacity:0.8;font-size: 34px;padding-top:3px;color: #6F7272 !important;">
                        <a href="index/acma_rapor_listesi" class="ajax" style="color: #6F7272 !important;"> <i class="fa fa-lg fa-fw fa-file-text-o"></i></a>
                    </div>

                    <div class="value-block pull-left"  style="color: #6F7272 !important;">
                        <div class="value-self"><?php echo $acmarapor_toplam;?></div>
                        <div class="value-title">Açma Rapor</div>
                    </div>
                </div>

                <div class="panel-foot foot-blue">

                </div>
            </div>
        </div>

        <div class="col-md-2 col-xs-6">
            <div class="hpanel" style="border: 1px solid #AAAEAF;">
                <div class="panel-body no-padding" style="height: 60px !important;">
                    <div class="pull-right" style="opacity:0.8;font-size: 34px;padding-top:3px;color: #6F7272 !important;">
                        <a href="index/evrak_listesi/gelen" class="ajax" style="color: #6F7272 !important;"><i class="fa fa-lg fa-fw fa-envelope"></i></a>
                    </div>

                    <div class="value-block pull-left"  style="color: #6F7272 !important;">
                        <div class="value-self"><?php echo $evrak_toplam;?></div>
                        <div class="value-title">Evrak</div>
                    </div>
                </div>

                <div class="panel-foot foot-blue">

                </div>
            </div>
        </div>


        <div class="col-md-2 col-xs-6">
            <div class="hpanel" style="border: 1px solid #AAAEAF;">
                <div class="panel-body no-padding" style="height: 60px !important;">
                    <div class="pull-right" style="opacity:0.8;font-size: 34px;padding-right: 5px;padding-top:3px;color: #6F7272 !important;">
                        <a href="index/demirbas_listesi" class="ajax" style="color: #6F7272 !important;"><i class="fa fa-lg fa-sitemap"></i></a>
                    </div>

                    <div class="value-block pull-left"  style="color: #6F7272 !important;">
                        <div class="value-self"><?php echo $demirbas_toplam;?></div>
                        <div class="value-title">Demirbaş</div>
                    </div>
                </div>

                <div class="panel-foot foot-blue">

                </div>
            </div>
        </div>


        <div class="col-md-2 col-xs-6">
            <div class="hpanel" style="border: 1px solid #AAAEAF;">
                <div class="panel-body no-padding" style="height: 60px !important;">
                    <div class="pull-right" style="opacity:0.8;font-size: 34px;padding-top:3px;color: #6F7272 !important;">
                        <a href="index/kullanicilar" class="ajax" style="color: #6F7272 !important;"> <i class="fa fa-lg fa-fw fa-user"></i></a>
                    </div>

                    <div class="value-block pull-left"  style="color: #6F7272 !important;">
                        <div class="value-self"><?php echo $kullanici_toplam;?></div>
                        <div class="value-title">Kullanıcı</div>
                    </div>
                </div>

                <div class="panel-foot foot-blue">

                </div>
            </div>
        </div>
    </div>

<?php } ?>

    <?php if($ayarlar->mod_genelst == 1){?>
    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>İstatistikler </h2>

                    <?php if($_SESSION['yetki'] == 'S'){?>
                        <div class="jarviswidget-ctrls" role="menu" ><a href="#"  class="btnRaporYenile button-icon" style=""><i class="fa fa-refresh"></i></a></div>
                    <?php } ?>
                </header>

                <!-- widget div-->
                <div class="no-padding">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">


                    </div>
                    <!-- end widget edit box -->

                    <div class="widget-body">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                <div class="row no-space">

                                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                        <div class="chart-content">
                                            <div class="chart-category pull-left" style="">
                                                <div id="chartContainer"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 show-stats">

                                        <div class="row">
                                            <div style="width: 100%; text-align:center;margin-bottom: 10px;"><span style="font-family: Verdana,sans;color: #49563A;font-size: 13px;font-weight: bold;line-height: 15.6px;fill: #49563A;">5 Yıllık Genel Toplam</span></div>
                                            <?php include 'temp/buluntu_genel_toplam.php'; ?>
                                        </div>

                                    </div>

                                </div>

                                <div class="row no-space">
                                    <div id="chart-container"></div>
                                </div>

                            </div>
                            <!-- end s1 tab pane -->

                            <div class="tab-pane fade" id="s2">
                              
                                <div class="padding-10">

                                </div>

                            </div>
                            <!-- end s2 tab pane -->

                           
                            <!-- end s3 tab pane -->
                        </div>

                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

        </article>
    </div>

    <!-- end row -->

    <?php } ?>


    <?php if($ayarlar->mod_buluntust == 1){?>

    <div class="row">

        <?php
            foreach($buluntust as $bul){
        ?>

        <article class="col-md-6">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-pie-chart"></i> </span>
                    <h2><?php echo stripslashes($bul->list_adi);?> İstatistikleri </h2>
                    <ul class="nav nav-tabs pull-right in" id="myTab"></ul>
                </header>

                <!-- widget div-->
                <div class="no-padding">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox"></div>
                    <!-- end widget edit box -->

                    <div class="widget-body">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="ss1">
                                <div class="row no-space">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="custom-scroll table-responsive" style="">
                                            <?php include 'temp/buluntu_'.$bul->list_id.'.php';?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end s1 tab pane -->
                            <!-- end s3 tab pane -->
                        </div>
                        <!-- end content -->
                    </div>
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
        <?php } ?>

    </div>

    <?php } ?>

<?php if($ayarlar->mod_pano == 1){?>

    <div class="row">
        <article class="col-sm-12">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-clock-o"></i> </span>
                    <h2>İşlem Geçmişi (Log) </h2>

                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#ssd1"><i class="fa fa-star"></i><span class="hidden-mobile hidden-tablet"> Son Hareketler</span></a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#ss2"> <i class="fa fa-clock-o"></i>  <span class="hidden-mobile hidden-tablet">Giriş Logları</span></a>
                        </li>

                        <?php if($_SESSION['yetki'] == 'S'){?>
                        <li>
                            <a data-toggle="tab" href="#ss3"> <i class="fa fa-history"></i>  <span class="hidden-mobile hidden-tablet">Hatalı Girişler</span></a>
                        </li>
                        <?php }?>
                    </ul>

                </header>

                <!-- widget div-->
                <div class="no-padding">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">


                    </div>
                    <!-- end widget edit box -->

                    <div class="widget-body">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="ssd1">
                                <div class="row no-space">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="custom-scroll table-responsive" style="height:300px; overflow-y: scroll;">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Kayıt</th>
                                                    <th style="width: 170px;">Kayıt Tipi</th>
                                                    <th style="width: 120px;">İşlem Tipi</th>
                                                    <th style="width: 120px;">Kullanıcı</th>
                                                    <th style="width: 140px;">İşlem Tarihi</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo $loglar;?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end s1 tab pane -->

                            <div class="tab-pane fade padding-10 no-padding-bottom" id="ss2">

                                    <div class="row no-space">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                            <div class="custom-scroll table-responsive" style="height:300px; overflow-y: scroll;">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Kullanıcı Adı</th>
                                                        <th style="width: 140px;">IP Adresi</th>
                                                        <th style="width: 140px;">İşlem Tarihi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    foreach($kullanici_log as $k){
                                                        echo '<tr><td>'.$k->adsoyad.'</td><td>'.$k->ip.'</td><td>'.$k->tarih.'</td></tr>';
                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- end s2 tab pane -->



                            <?php if($_SESSION['yetki'] == 'S'){?>
                            <div class="tab-pane fade padding-10 no-padding-bottom" id="ss3">

                                <div class="row no-space">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="custom-scroll table-responsive" style="height:300px; overflow-y: scroll;">

                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Kullanıcı ID</th>
                                                    <th style="width: 140px;">IP Adresi</th>
                                                    <th style="width: 140px;">İşlem Tarihi</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                foreach($kullanici_log_hata as $k){
                                                    echo '<tr><td>'.$k->user.'</td><td>'.$k->ip.'</td><td>'.$k->tarih.'</td></tr>';
                                                }
                                                ?>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <?php }?>


                            <!-- end s3 tab pane -->
                        </div>

                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

        </article>
    </div>


    <!-- end row -->

    <?php }?>

</section>
<!-- end widget grid -->


<script type="text/javascript">

    $(document).ready(function(){

        $('.btnRaporYenile').on('click',function(){

            $.get('rapor/yenile');

            setTimeout(function(){
                location.href=location.href;
            },2000);
        });

    });


    FusionCharts.ready(function() {
        var chart = new FusionCharts({
            "type": "mscolumn3d",
            "renderAt": "chartContainer",
            "width": "100%",
            "height": "300",
            "dataFormat": "json",
            "dataSource": {
                "chart": {
                    "caption": "Son 5 Yılın Buluntu İstatistikleri",
                    "yaxisname": "Buluntu Sayısı",
                    "formatNumber": "1",
                    "formatNumberScale": "0",
                    "decimalSeparator": ",",
                    "thousandSeparator": ".",
                    "bgcolor": "#FFFFFF",
                    "showalternatehgridcolor": "0",
                    "showvalues": "1",
                    "labeldisplay": "1",
                    "divlinecolor": "#CCCCCC",
                    "divlinealpha": "70",
                    "useroundedges": "1",
                    "canvasbgcolor": "#FFFFFF",
                    "canvasbasecolor": "#CCCCCC",
                    "showcanvasbg": "0",
                    "animation": "1",
                    "palettecolors": "#008ee4,#6baa01,#e44a00,#f8bd19,#33bdda,#F0B67F,#6B818C,#B09398,#D8E4FF,#D5DE8B,#CFD2B2,#E0D8DE,#FEF6C9,#EEF5DB,#802C3E,#A05125,#F2F79E,#92B9BD,#F2F79E,#C8ACAB,#B68F9D,#A690A4",
                    "showborder": "0",
                    "legendshadow": "0",
                    "legendborderalpha": "50",
                    "canvasborderthickness": "1",
                    "canvasborderalpha": "50",
                    "placevaluesinside": "1",
                    "rotatevalues": "1"
                },
                <?php include 'temp/buluntu_yillara_gore.json'; ?>
            }
        }).render();
    });

    const dataSource = {
        "chart": {
            "caption": "Yıllara göre buluntu sayısı",
            "subcaption": "",
            "formatNumberScale": "0",
            "decimalSeparator": ",",
            "thousandSeparator": ".",
            "showvalues": "1",
            "numvisibleplot": "12",
            "plottooltext": "$label yılında toplam <b>$dataValue</b> buluntu mevcut",
            "theme": "fusion"
        },
        <?php include 'temp/yillara_gore_toplam.json'; ?>
    };

    FusionCharts.ready(function() {
        var myChart22 = new FusionCharts({
            type: "scrollarea2d",
            renderAt: "chart-container",
            width: "100%",
            height: "100%",
            dataFormat: "json",
            dataSource
        }).render();
    });
</script>
