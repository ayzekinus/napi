<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }

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
            <h2><strong>Restorasyon</strong> <i>Detay</i></h2>

            <div class="jarviswidget-ctrls" role="menu" ><a href="#" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
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

                    <div style="margin: 10px;">

                        <ul id="myTab1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab">Rapor Detayı</a>
                            </li>
                        </ul>


                        <div id="myTabContent1" class="tab-content padding-10">
                            <div class="tab-pane fade active in" id="aktif_tab">

                                <table class="table table-bordered table-striped table-condensed table-hover">

                                    <thead>
                                    <tr>
                                        <th colspan="4">Genel Bilgiler</th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr>

                                        <td style="width: 150px;vertical-align:middle;">Anakod </td>

                                        <td>
                                            <label class="input">
                                                <?php echo $qq->anakod;?>
                                            </label>
                                        </td>

                                        <td style="width: 150px;vertical-align:middle;">Buluntu No </td>
                                        <td>
                                            <label class="input">
                                                <?php echo $qq->buluntu_no;?>
                                            </label>
                                        </td>


                                    </tr>

                                    <tr>
                                        <td style="width: 150px;vertical-align:middle;">Obje Türü </td>
                                        <td>
                                            <label class="input">
                                                <?php echo $qq->form_obje;?>
                                            </label>
                                        </td>

                                        <td style="width: 150px;vertical-align:middle;">Materyal </td>

                                        <td>
                                            <label class="input">
                                                <?php echo $qq->yapim_malzemesi;?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="vertical-align:middle;">Kazı Envanter No</td>
                                        <td>
                                            <label class="input">
                                               <?php echo $qq->kazienv_no;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 150px;">Uygulayan <i class="fa fa-asterisk reqicon"></i></td>
                                        <td >
                                            <label class="input">
                                                <?php echo stripslashes($q->uygulayan);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>

                                        <td style="vertical-align:middle;width: 150px;">Konservatör <i class="fa fa-asterisk reqicon"></i></td>
                                        <td >
                                            <label class="input">
                                                <?php echo stripslashes($q->konservator);?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 150px;">Bakanlık Temsilcisi <i class="fa fa-asterisk reqicon"></i></td>
                                        <td >
                                            <label class="input">
                                                <?php echo stripslashes($q->temsilci);?>
                                            </label>
                                        </td>

                                    </tr>

                                </table>


                                <br>


                                <table class="table table-bordered table-striped table-condensed table-hover">

                                    <thead>
                                    <tr>
                                        <th colspan="4">Eserin Mevcut Durumu</th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr>
                                        <td colspan="4">
                                            <label class="textarea">
                                                <?php echo stripslashes($q->mevcut_durum);?>
                                            </label>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>

                                <br>

                                <table class="table table-bordered table-striped table-condensed table-hover">

                                    <thead>
                                    <tr>
                                        <th colspan="4">Uygulanan İşlemler</th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr>
                                        <td colspan="4">
                                            <label class="textarea">
                                                <?php echo stripslashes($q->uygulanan_islemler);?>
                                            </label>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>

                                <br>

                                <table class="table table-bordered table-striped table-condensed table-hover">

                                    <thead>
                                    <tr>
                                        <th colspan="4">Kullanılan Malzeme</th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr>
                                        <td colspan="4">
                                            <label class="textarea">
                                                <?php echo stripslashes($q->kullanilan_malzeme);?>
                                            </label>
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
                                                    <a href="#" style="float: left;" data-id="<?php echo $q->rest_bk_id;?>" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="İşlem Geçmişi"
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

                    </div>

                    <footer>
                        <button type="button" class="btn btn-default kapatbtn" data-dismiss="modal" >
                            <i class="fa fa-remove"></i> Kapat
                        </button>

                        <a href="<?php echo 'index/restorasyon_duzenle/' . $q->rest_bk_id;?>"  class="btn btn-labeled btn-primary ajax" > <i class="fa fa-pencil"></i> Düzenle </a>

                        <a href="javascript:robo.print.show('<?php echo 'index/restorasyon_detay/' . $q->rest_bk_id . '/1';?>')"  class="btn btn-labeled bg-color-blueLight txt-color-white btnyazdir_anakod"> <i class="fa fa-print"></i> Yazdır </a>
                    </footer>
                </form>


            </div>


            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=4"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('[rel="tooltip"]').tooltip({ container: '.modal-content' });

        $(".btn_islem_gecmisi").on('click',function(){

            $(".islem_gecmisi_table").toggle();

            var active = $(".islem_gecmisi_table").attr("active");

            if (active == 0){

                var id = $(this).attr('data-id');
                var path = '<?php echo Url::base();?>';
                var git = path + 'index/log_getir/' + id + '/restorasyon_listesi';

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

