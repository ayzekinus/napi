<link rel='stylesheet' href='<?php echo Url::base(); ?>assets/js/jquery.qtip.custom/jquery.qtip.min.css?v=4'>

<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }

    .alt_gorsel {
        text-align: center;
        outline: solid 1px #ccc;
        background: rgba(0,0,0,0.05);
        padding: 5px;
        margin: 8px 8px !important;
        display: inline-block;
    }
    .alt_gorsel img:hover{cursor: pointer;}


    .pagebtn:hover{color: black !important;}

    #aktif_tab{
        width: 100%; overflow-y: scroll;
        padding-right: 5px;
    }


</style>


<script type="text/javascript">
    var winHeight = window.innerHeight * 65 / 100;
    $("#aktif_tab").css("max-height", winHeight);
</script>


<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-deletebutton="true" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
           <h2><strong>Evrak</strong> <i>Detay</i></h2>

            <div style="width: 40px; height: 12px;float: right;margin-right: 5px;margin-top: -4px;">
                <a href="#" data-id="<?php echo $q->id;?>" data-islem="0" class="pagebtn" style="color: white; "><i class="fa fa-lg fa-chevron-circle-left"></i></a>
                <a href="#" data-id="<?php echo $q->id;?>" data-islem="1" class="pagebtn" style="color: white; margin-left: 2px;"><i class="fa fa-lg fa-chevron-circle-right"></i></a>
            </div>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div id="widgetRefresh" class="widget-body no-padding">

                <form id="formk" action="" class="smart-form">

                    <div id="formdata"></div>

                        <div class="tab-content padding-10" >

                            <div class="active in" id="aktif_tab">

                                <table class="table table-bordered table-striped table-condensed table-hover detail-table" style="border: 1px solid #C4CCD1;" width="100%">

                                    <thead class="detailhead">
                                    <tr>
                                        <th colspan="4"> <?php echo $q->evrak_tipi . " Evrak";?></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kayıt No / Tarihi</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->id) . " / " .stripslashes($q->kayit_tarihi);?>
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

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Öncelik</td>

                                        <td>
                                            <label class="input">
                                                <?php echo $q->evrak_oncelik;?>
                                            </label>

                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Hızlı Erişim</td>

                                        <td>
                                            <label class="input">
                                                <?php if($q->favori == 1){echo '<font style="color: green;">'.Evet.'</font>';}else{echo '<font style="color: red;">'.Hayır.'</font>';}?>

                                            </label>

                                        </td>

                                    </tr>



                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Evrak No / Tarihi</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->evrak_no) . " / " .stripslashes($q->evrak_tarihi);?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Evrak Sayı</td>

                                        <td class="">
                                            <?php echo stripslashes($q->evrak_sayi);?>
                                        </td>

                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">İlgili Kurum <i class="fa fa-asterisk reqicon"></i></td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                                <?php echo $q->evrak_kurum;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">İlgili Birim</td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                                <?php echo $q->ilgili_birim;?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Evrak Konusu <i class="fa fa-asterisk reqicon"></i></td>
                                        <td colspan="3">
                                            <label class="input">
                                                <?php echo stripslashes($q->evrak_konusu);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Açıklama</td>
                                        <td colspan="3">
                                            <?php echo stripslashes($q->aciklama);?>
                                        </td>
                                    </tr>


                                    <?php if(count($dosyalar) > 0){?>

                                        <tr>
                                            <td colspan="4" class="gorsel_thumb" style="background-color: #FCFCF9 !important;">

                                                <div class="gorsel_div">


                                                    <?php

                                                    foreach($dosyalar as $d){

                                                        $uzanti = explode('.', $d->dosya);
                                                        $uzanti = $uzanti[1];


                                                        $file = 'diger.png';

                                                        $tur = 'Bilinmiyor';

                                                        switch ($uzanti){
                                                            case "jpg":
                                                            case "jpeg":
                                                            case "png":
                                                                $file = 'jpeg.png';
                                                                $tur = 'Resim Dosyası';
                                                                break;
                                                            case "pdf":
                                                                $file = 'pdf.png';
                                                                $tur = 'Pdf Dosyası';
                                                                break;
                                                            case "doc":
                                                            case "docx":
                                                            case "odt":
                                                                $file = 'word.png';
                                                            $tur = 'Word Dosyası';
                                                                break;
                                                            case "xls":
                                                            case "xlsx":
                                                            case "ods":
                                                                $file = 'excel.png';
                                                            $tur = 'Excel Dosyası';
                                                                break;

                                                        }

                                                        $path = str_replace('index.php', '', $_SERVER["SCRIPT_FILENAME"]);

                                                        $file2 = $path . '/uploads/docs/' . $d->dosya;
                                                        $size = filesize($file2);

                                                        $filedate = date("d.m.Y H:i", filectime($file2));



                                                        if($size >= 1073741824){
                                                            $size = round($size/1073741824)." GB";
                                                        }
                                                        elseif($size >= 1048576){
                                                            $size = round($size/1048576)." MB";
                                                        }
                                                        elseif($size >= 1024){
                                                            $size = round($size/1024)." KB";
                                                        }else{
                                                            $size = $size. " B";
                                                        }


                                                        ?>

                                                        <div class="alt_gorsel" data-tooltip="<b>Dosya Adı: </b> <?php echo $d->dosya;?> <br/> <b>Oluşturulma: </b> <?php echo $filedate;?> <br/><b>Dosya Boyutu: </b> <?php echo $size;?> <br/><b>Dosya Türü: </b> <?php echo $tur;?>">
                                                            <img src="<?php echo Url::base('assets/img/file_icon/' . $file);?>" width="64" height="64" class="gorsel_img" data-name="<?php echo $d->dosya;?>">
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
                                                    <a href="#" style="float: left;" data-id="<?php echo $q->id;?>" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="İşlem Geçmişi"
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

                            </div>

                        </div>



                    <footer>



                            <button type="button" class="btn btn-default kapatbtn" data-dismiss="modal" >
                                <i class="fa fa-remove"></i> Kapat
                            </button>

                            <a href="<?php echo Url::base('index/evrak_duzenle/' . $q->id);?>"  class="btn btn-labeled btn-primary ajax" > <i class="fa fa-pencil"></i> Düzenle </a>

                    </footer>
                </form>



            </div>


            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>

<script src="<?php echo Url::base(); ?>assets/js/jquery.qtip.custom/jquery.qtip.min.js?v=2"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.alt_gorsel').qtip({
            content: {
                title: 'Evrak Detayı',
                attr: 'data-tooltip'
            },
            position: {
                my: 'bottom center',  // Position my top left...
                at: 'top center', // at the bottom right of...
                target: 'event'
            }
        });

        $(".pagebtn").on('click', function(){

            var id = $(this).attr('data-id');
            var islem = $(this).attr('data-islem');
            var path = '<?php echo Url::base();?>';
            var git = path + 'index/evrak_getir/' + id + '/' + islem + '/<?php echo strtolower($q->evrak_tipi);?>';

            $.get(git,null,function(data){
                if(data !== "0"){
                    $('#remoteModal .modal-content').html(data);
                }
            });

            return false;
        });


        $('[rel="tooltip"]').tooltip({ container: '.modal-content' });

        $(".btn_islem_gecmisi").on('click',function(){

            $(".islem_gecmisi_table").toggle();

            var active = $(".islem_gecmisi_table").attr("active");

            if (active == 0){

                var id = $(this).attr('data-id');
                var path = '<?php echo Url::base();?>';
                var git = path + 'index/log_getir/' + id + '/evrak_yonetimi';

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

        $(".gorsel_div").on('click','.alt_gorsel img',function(){

            var name = $(this).attr("data-name");
            var url = '<?php echo Url::base("uploads/docs/");?>' + name;

            forceDownload(url,name);

            return false;
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

