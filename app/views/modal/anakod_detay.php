<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }
</style>

<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-deletebutton="true" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
           <h2><strong>Anakod</strong> <i>Detay</i></h2>

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

                        <ul id="myTab1" class="nav nav-tabs bordered navbuluntulist">
                            <?php echo $anakodPage;?>
                        </ul>


                        <div class="tab-content padding-10">
                            <div class="active in" id="s1">

                                <table class="table table-bordered table-striped table-condensed table-hover detail-table" style="border: 1px solid #C4CCD1;" width="100%">

                                    <thead class="detailhead">
                                    <tr style="background-color: #768284 !important;background-image : none;">
                                        <th colspan="4">

                                            <div style="float:left;">
                                                <?php echo $q->anakod;?>
                                            </div>
                                            <div class="badge bg-color-redLight" style="float: right;" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="Buluntu Sayısı">
                                                <?php echo $count;?>
                                            </div>
                                        </th>

                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr>
                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Anakod</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $q->anakod;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Durumu</td>
                                        <td>
                                            <label class="input">
                                                <?php if($q->durum == 1){echo '<font style="color: green;">'.Aktif.'</font>';}else{echo '<font style="color: red;">'.Pasif.'</font>';}?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $by;?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Buluntu Yılı <i class="fa fa-asterisk reqicon"></i></td>
                                        <td>
                                            <label class="input">
                                                <?php echo $q->buluntu_yili;?>
                                            </label>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Plankare</td>
                                        <td >
                                            <label class="input">
                                                <?php echo $q->plankare;?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Tabaka</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $q->tabaka;?>
                                            </label>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Seviye</td>
                                        <td >
                                            <label class="input">
                                                <?php echo $q->seviye;?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Mezar No</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $q->mezarno;?>
                                            </label>
                                        </td>

                                    </tr>


                                    <tr>

                                        <td colspan="4">
                                            <label class="input">
                                                <?php echo $q->aciklama;?>
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
                                                <a href="#" style="float: left;" data-id="<?php echo $q->anakod_id;?>" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="İşlem Geçmişi"
                                                   class="btn bg-color-blueLight txt-color-white btn_islem_gecmisi"><i
                                                        class="fa fa-history fa-lg"></i></a>
                                            </div>

                                        </td>
                                    </tr>

                                    <?php } ?>

                                    </tbody>

                                </table>


                                <?php if($logGoster){?>

                                <br/>


                                <table class="table table-bordered table-striped table-condensed table-hover islem_gecmisi_table"  active="0" style="display:none;border: 2px solid #B3B7AE;">

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

                        <a href="<?php echo Url::base('index/anakod_duzenle/' . $q->anakod_id);?>"  class="btn btn-labeled btn-primary ajax" > <i class="fa fa-pencil"></i> Düzenle </a>

                        <a href="javascript:robo.print.show('<?php echo Url::base('index/anakod_detay/' . $q->anakod_id . '/1');?>')"  class="btn btn-labeled bg-color-blueLight txt-color-white btnyazdir_anakod"> <i class="fa fa-print"></i> Yazdır </a>
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

        $('[rel="tooltip"]').tooltip({ container: '.modal-content' });

        $('#myTab1 li a').on('click',function(){

            var id = $(this).attr('data-id');
            var path = '<?php echo Url::base();?>';
            var git = path + 'index/anakod_detay/' + id + '/0';

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
                var git = path + 'index/log_getir/' + id + '/anakod';

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

