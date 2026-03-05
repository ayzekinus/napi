<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }

    .pagebtn:hover{color: black !important;}

    #aktif_tab{
        width: 100%; overflow-y: scroll;
        padding-right: 5px;


    .gorsel_thumb .gorsel_div .alt_gorsel {float: left; margin-right: 5px !important; margin-bottom: 10px !important;}
    .gorsel_thumb .gorsel_div .alt_gorsel .gorsel_img{float: left;}

    .gorsel_kucuk img{float: left; border: 1px solid black; }

    .gorsel_img{border: 1px dashed #CCD0D1 !important;}
    .gorsel_img:hover{cursor: pointer;border: 1px solid #CCD0D1 !important;}

</style>


<script type="text/javascript">
    var winHeight = window.innerHeight * 65 / 100;
    $("#aktif_tab").css("max-height", winHeight);
</script>


<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-deletebutton="true" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

        <header>
            <!--<span class="widget-icon"> <i class="fa fa-bolt"></i> </span>-->
            <!--<h2><strong>Buluntu</strong> <i>Detay</i></h2>-->
            <h2><strong><?php echo $anakod. " " . $q->buluntu_num;?></strong></h2>


            <div style="width: 40px; height: 12px;float: right;margin-right: 5px;margin-top: -4px;">
                <a href="#" data-id="<?php echo $q->bk_anakod_id;?>" data-islem="0" class="pagebtn" style="color: white; "><i class="fa fa-lg fa-chevron-circle-left"></i></a>
                <a href="#" data-id="<?php echo $q->bk_anakod_id;?>" data-islem="1" class="pagebtn" style="color: white; margin-left: 2px;"><i class="fa fa-lg fa-chevron-circle-right"></i></a>
            </div>


            <!--<div class="jarviswidget-ctrls" role="menu" ><a href="#" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>-->

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div id="widgetRefresh" class="widget-body no-padding ">

                <form id="formk" action="" class="smart-form " >

                    <div id="formdata"></div>

                    <ul style="display: block;" id="myTab1" class="nav nav-tabs bordered navbuluntulist">
                        <?php echo $anakodPage;?>
                    </ul>

                    <div class="tab-content padding-10">
                        <div class="active in" id="aktif_tab">

                            <table class="table table-bordered table-striped table-condensed table-hover detail-table"  width="100%" style="border: 1px solid #C4CCD1;">

                                <thead class="detailhead">
                                <tr>
                                    <th colspan="4">Genel Bilgiler</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Anakod <i class="fa fa-asterisk reqicon"></i></td>

                                    <td>
                                        <label class="input">
                                            <?php echo $anakod;?>
                                        </label>

                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Durumu</td>
                                    <td>
                                        <label class="input">
                                            <?php if($q->durum == 1){echo '<font style="color: green;">'.Aktif.'</font>';}else{echo '<font style="color: red;">'.Pasif.'</font>';}?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu No <i class="fa fa-asterisk reqicon"></i></td>

                                    <td>
                                        <label class="input">
                                            <?php echo $q->buluntu_num;?>
                                        </label>

                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Tarihi <i class="fa fa-asterisk reqicon"></i></td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->buluntu_tarihi);?>
                                        </label>
                                    </td>

                                </tr>

                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Tip</td>
                                    <td>
                                        <?php echo $tip;?>
                                    </td>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Şube</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->sube);?>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kazı Env. No</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->kazienv_no);?>
                                        </label>
                                    </td>


                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Müze Env. No</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->muzeenv_no);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Form/Obje <i class="fa fa-asterisk reqicon"></i></td>

                                    <td>
                                        <?php echo $formobje;?>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Yapım Malzemesi <i class="fa fa-asterisk reqicon"></i></td>
                                    <td >
                                        <?php echo $yapim_malzemesi;?>
                                    </td>

                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Üretim Yeri</td>
                                    <td>
                                        <?php echo $uretimyeri;?>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Dönem</td>
                                    <td >
                                        <?php echo $donem;?>
                                    </td>
                                </tr>



                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>
                                    <td >
                                        <?php echo $by;?>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Şekli</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->buluntu_sekli);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Plankare</td>
                                    <td style="width: 300px;">
                                        <label class="input">
                                            <?php echo stripslashes($q->plankare);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Tabaka</td>
                                    <td style="width: 350px;">
                                        <label class="input">
                                            <?php echo stripslashes($q->tabaka);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Seviye</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->seviye);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Mezar No</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->mezarno);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Eser Tarihi</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->eser_tarihi);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">B. Yeri Diğer</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->buluntu_yeri_diger_bilgi);?>
                                        </label>
                                    </td>
                                </tr>

                                </tbody>
                            </table>


                            <br/>


                            <table class="table table-bordered table-striped table-condensed table-hover detail-table">

                                <thead class="detailhead">
                                <tr>
                                    <th colspan="4">Ölçü & Renk Bilgileri</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Yükseklik</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->yukseklik);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Ağız Çapı</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->agiz_capi);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kaide/Dip Çapı</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->dip_capi);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kalınlık/Cidar</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->derinlik);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Uzunluk</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->uzunluk);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Genişlik</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->genislik);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Çap</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->cap);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Gram</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->gram);?>
                                        </label>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Hamur Rengi</td>
                                    <td >
                                        <?php echo $hamur_rengi;?>
                                    </td>


                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Astar Rengi</td>
                                    <td >
                                        <?php echo $astar_rengi;?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kalıp Yönü</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->kalip_yonu);?>
                                        </label>
                                    </td>

                                    <td style="vertical-align:middle;width: 200px;font-weight: bold;">Diğer Renk</td>
                                    <td>
                                        <label class="input">
                                            <?php echo stripslashes($q->diger_renk);?>
                                        </label>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <br/>

                            <table class="table table-bordered table-striped table-condensed table-hover detail-table">

                                <thead class="detailhead">
                                <tr>
                                    <th colspan="4">Diğer Bilgiler</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>

                                    <td colspan="4">
                                        <span style="vertical-align:middle;width: 200px;font-weight: bold;">Tanım / Bezeme</span>
                                        <br/><br/>

                                        <label class="textarea">
                                            <?php echo stripslashes($q->tanim);?>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <span style="vertical-align:middle;width: 200px;font-weight: bold;">Kaynak ve Referans</span>
                                        <br/><br/>

                                        <label class="textarea">
                                            <?php echo stripslashes($q->kaynak_referans);?>
                                        </label>
                                    </td>
                                </tr>


                                <?php if(count($galeri) > 0){?>

                                    <tr>
                                        <td colspan="4" class="gorsel_thumb" style="background-color: #FCFCF9 !important;">

                                            <div class="gorsel_div">

                                                <div class="gorsel_onizle" style="float:left;width:460px; background: white; border: 1px solid #CCD0D1;">
                                                    <a href="#" target="_blank"><img src=""></a>
                                                    <div style="width: 100%; height: 30px;margin-top: -30px;">
                                                        <a href="javascript:void(0);" class="btn btn-default txt-color-blueDark pull-right imgDownload" rel="tooltip" data-placement="top" data-original-title="Görseli Kaydet" style="margin-right: 10px; margin-top: -10px;position: relative;"><i class="fa fa-angle-double-down fa-lg"></i></a>
                                                    </div>
                                                </div>


                                                <?php foreach($galeri as $g){?>
                                                    <div class="alt_gorsel" style="float:left; margin-left: 15px;">
                                                        <img src="<?php echo Url::base();?>uploads/images/thumb/<?php echo $g->dosya;?>" width="140" height="120" class="gorsel_img" data-name="<?php echo $g->dosya;?>">
                                                    </div>

                                                <?php }?>


                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>


                                <?php if($logGoster){?>
                                    <tr>
                                        <td colspan="4" style="width: 100%;background-color: #EDEDED;">

                                            <div style="width: 600px; float: left;padding-top: 7px;font-size: 15px;">

                                                <span style="float:left;color: white;margin-right: 10px;" class="label label-default" data-container="modal-content" rel="tooltip" data-placement="top" data-original-title="Son İşlem Tarihi">
                                                   <i style="font-weight: normal;font-style: normal;"><?php echo $log->tarih;?></i>
                                                </span>

                                                <?php if($log->islem == 1){?>
                                                    <span style="float:left;margin-right: 10px;color: white; " class="label label-success" data-container="modal-content" rel="tooltip" data-placement="top" data-original-title="Oluşturan">
                                                   <i style="font-weight: normal;font-style: normal;"><?php echo $user;?></i>
                                                </span>

                                                <?php } else{?>


                                                    <span style="float:left;margin-right: 10px;color: white;" class="label label-warning" data-container="modal-content" rel="tooltip" data-placement="top" data-original-title="Son Güncelleyen">
                                                  <i style="font-weight: normal;font-style: normal;"><?php echo $user;?></i>
                                                </span>

                                                <?php } ?>


                                            </div>

                                            <div style=" float: right;">
                                                <a href="#" style="float: left;" data-id="<?php echo $q->bk_id;?>" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="İşlem Geçmişi"
                                                   class="btn bg-color-blueLight txt-color-white btn_islem_gecmisi"><i
                                                        class="fa fa-history fa-lg"></i></a>
                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>

                            </table>


                            <?php if($logGoster){?>


                                <table class="table table-bordered table-striped table-condensed table-hover islem_gecmisi_table"  active="0" style="margin-top: 15px;display:none;border: 2px solid #B3B7AE;">

                                    <thead style="background-color: #B3B7AE !important;color: white;text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.3);">
                                    <tr style="background-color: #B3B7AE !important;background-image : none;">
                                        <th colspan="4">İşlem Geçmişi <?php if($_SESSION['yetki'] != 'S'){echo '(5)';}?></th>
                                    </tr>
                                    </thead>

                                    <tbody class="islem_tbody">

                                    </tbody>

                                </table>

                            <?php } ?>


                            <!--<div id="myTabContent1" class="tab-content padding-10" >

                                <div class="tab-pane fade active in" id="aktif_tab">



                                </div>

                            </div>-->

                        </div>

                    </div>



                    <footer>
                            <button type="button" class="btn btn-default kapatbtn" data-dismiss="modal" >
                                <i class="fa fa-remove"></i> Kapat
                            </button>

                            <a href="<?php echo Url::base('index/buluntu_duzenle/' . $q->bk_id);?>"  class="btn btn-labeled btn-primary ajax" > <i class="fa fa-pencil"></i> Düzenle </a>

                            <a href="javascript:robo.print.show('<?php echo Url::base('index/buluntu_detay/' . $q->bk_id . '/1');?>')"  class="btn btn-labeled bg-color-blueLight txt-color-white btnyazdir_buluntu"> <i class="fa fa-print"></i> Yazdır </a>
                    </footer>
                </form>



            </div>


            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>

<script type="text/javascript">
    $(document).ready(function() {

        var url = '<?php echo Url::base("uploads/images/");?>';
        var src = $(".alt_gorsel img:eq(0)").attr("src");

        $(".gorsel_onizle img").attr("src", src);
        $(".gorsel_onizle a").attr("href", url + $(".alt_gorsel img:eq(0)").attr("data-name"));
        $(".gorsel_onizle a").attr("data-name", $(".alt_gorsel img:eq(0)").attr("data-name"));

        $(".gorsel_img").on('click', function(){

            var src= $(this).attr("src");

            $(".gorsel_onizle img").attr("src", src);
            $(".gorsel_onizle a").attr("href", url + $(this).attr("data-name"));
            $(".gorsel_onizle a").attr("data-name", $(this).attr("data-name"));

           return false;
        });

        $(".imgDownload").on('click',function(){

            var url = $(".gorsel_onizle a").attr("href");
            var dataName = $(".gorsel_onizle a").attr("data-name");

            forceDownload(url, dataName);

            return false;
        });

        $(".pagebtn").on('click', function(){

            var id = $(this).attr('data-id');
            var islem = $(this).attr('data-islem');
            var path = '<?php echo Url::base();?>';
            var git = path + 'index/buluntu_anakod_getir/' + id + '/' + islem;

            $.get(git,null,function(data){
                if(data !== "0"){
                    $('#remoteModal .modal-content').html(data);
                }
            });

            return false;
        });

        $('[rel="tooltip"]').tooltip({ container: '.modal-content' });

        $('#myTab1 li a').on('click',function(){

            var id = $(this).attr('data-id');
            var path = '<?php echo Url::base();?>';
            var git = path + 'index/buluntu_detay/' + id + '/0';

            $.get(git,null,function(data){
                $('#remoteModal .modal-content').html(data);
            });

            return false;
        });

        $(".btn_islem_gecmisi").on('click',function(){

            $(".islem_gecmisi_table").toggle();

            var active = $(".islem_gecmisi_table").attr("active");

            if (active == 0){

                var id = $(this).attr('data-id');
                var path = '<?php echo Url::base();?>';
                var git = path + 'index/log_getir/' + id + '/buluntu_karti';

                $.get(git, null, function(data){
                    $(".islem_tbody").html(data);
                });

                $(".islem_gecmisi_table").attr("active","1");

            }else{
                $(".islem_gecmisi_table").attr("active","0");
            }

            return false;
        });

        $(".kapatbtn").on('click',function(){
            $("#dt_basic tbody tr").css("opacity","1");
        });
    });

    function forceDownload(url, fileName){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.responseType = "blob";
        xhr.onload = function(){
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(this.response);
            var tag = document.createElement('a');
            tag.href = imageUrl;
            tag.download = fileName;
            document.body.appendChild(tag);
            tag.click();
            document.body.removeChild(tag);
        }
        xhr.send();
    }

</script>

