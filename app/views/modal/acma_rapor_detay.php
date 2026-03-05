<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }

    figure
    {
        text-align: center;
        outline: solid 1px #ccc;
        background: rgba(0,0,0,0.05);
        padding: 5px;
        margin: 8px 8px !important;
        display: inline-block;
    }

    figure > figcaption
    {
        margin-top: 5px !important;
        text-align: center;
        display: block; /* For IE8 */
    }


    .image-clean > figcaption
    {
        font-size: .9em;
        text-align: right;
    }


    .image-grayscale img, img.image-grayscale
    {
        filter: grayscale(100%);
    }

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
           <h2><strong>Açma Rapor</strong> <i>Detay</i></h2>

            <div style="width: 40px; height: 12px;float: right;margin-right: 5px;margin-top: -4px;">
                <a href="#" data-id="<?php echo $q->ID;?>" data-islem="0" class="pagebtn" style="color: white; "><i class="fa fa-lg fa-chevron-circle-left"></i></a>
                <a href="#" data-id="<?php echo $q->ID;?>" data-islem="1" class="pagebtn" style="color: white; margin-left: 2px;"><i class="fa fa-lg fa-chevron-circle-right"></i></a>
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
            <div id="widgetRefresh" class="widget-body no-padding">

                <form id="formk" action="" class="smart-form">

                    <div id="formdata"></div>

                        <div class="tab-content padding-10" >

                            <div class="active in" id="aktif_tab">

                                <table class="table table-bordered table-striped table-condensed table-hover detail-table" style="border: 1px solid #C4CCD1;" width="100%">

                                    <thead class="detailhead">
                                    <tr>
                                        <th colspan="4"> <?php echo $q->baslik;?></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Rapor Tipi</td>

                                        <td>
                                            <label class="input">
                                                <?php echo $q->rapor_tipi;?>
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
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Adı Soyadı <i class="fa fa-asterisk reqicon"></i></td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->adsoyad);?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>

                                        <td class="">
                                                <?php echo $by;?>
                                        </td>

                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Yazım Tarihi <i class="fa fa-asterisk reqicon"></i></td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                                <?php echo $q->yazim_tarihi;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Çalışma Yılı <i class="fa fa-asterisk reqicon"></i></td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                               <?php echo $q->calisma_yili;?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Plankare(ler)</td>
                                        <td colspan="3">
                                            <label class="input">
                                                <?php echo stripslashes($q->plankare);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Başlık <i class="fa fa-asterisk reqicon"></i></td>
                                        <td colspan="3">
                                            <label class="input">
                                                <?php echo stripslashes($q->baslik);?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <?php echo stripslashes($q->detay);?>
                                        </td>
                                    </tr>


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
                                                    <a href="#" style="float: left;" data-id="<?php echo $q->ID;?>" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="İşlem Geçmişi"
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

                            <a href="<?php echo Url::base('index/acma_rapor_duzenle/' . $q->ID);?>"  class="btn btn-labeled btn-primary ajax" > <i class="fa fa-pencil"></i> Düzenle </a>

                            <a href="javascript:robo.print.show('<?php echo Url::base('index/acma_rapor_detay/' . $q->ID . '/1');?>')"  class="btn btn-labeled bg-color-blueLight txt-color-white btnyazdir_acmarapor"> <i class="fa fa-print"></i> Yazdır </a>
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

        $(".pagebtn").on('click', function(){

            var id = $(this).attr('data-id');
            var islem = $(this).attr('data-islem');
            var path = '<?php echo Url::base();?>';
            var git = path + 'index/acma_rapor_getir/' + id + '/' + islem;

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
                var git = path + 'index/log_getir/' + id + '/acma_rapor';

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

</script>

