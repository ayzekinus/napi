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
            <h2><strong>Konservasyon</strong> <i>Detay</i></h2>

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

                                        <td colspan="2"></td>

                                    </tr>


                                    <tr>
                                        <td style="width: 150px;vertical-align:middle;">Buluntu No </td>
                                        <td>
                                            <label class="input">
                                                <?php echo $qq->buluntu_no;?>
                                            </label>
                                        </td>

                                        <td style="width: 150px;vertical-align:middle;">Buluntu Yeri </td>

                                        <td>
                                            <label class="input">
                                                <?php echo $qq->buluntu_yeri;?>
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
                                        <td style="vertical-align:middle;">Lab Giriş Tarihi</td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                               <?php echo $q->lab_giris;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;">Parça Sayısı</td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                                <?php echo $q->parca_sayisi;?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>

                                        <td style="vertical-align:middle;">Lab Çıkış Tarihi</td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                                <?php echo $q->lab_cikis;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 150px;">Konservatör</td>
                                        <td >
                                            <label class="input">
                                                <?php echo stripslashes($q->konservator);?>
                                            </label>
                                        </td>

                                    </tr>

                                </table>


                                <br>

                                <table class="table table-bordered table-striped table-condensed table-hover">

                                    <thead>
                                    <tr>
                                        <th colspan="4">Seçenekler</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php if($form_tip !== 'sikke'){?>

                                        <tr>
                                            <td colspan="4">
                                                <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Objenin Özellikleri</span>
                                                <br/><br/>

                                                <div class="inline-group">

                                                    <?php if ($form_tip == 'seramik'){?>

                                                        <label class="checkbox" >
                                                            <input disabled type="checkbox" name="opt_obje_ozellik[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Boyalı</label>

                                                    <?php } ?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_obje_ozellik[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Bezemeli</label>


                                                    <?php if($form_tip == 'seramik' || $form_tip == 'tas'){?>
                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_obje_ozellik[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('3', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Mühürlü</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_obje_ozellik[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('4', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Kabartmalı</label>

                                                    <?php } ?>


                                                    <?php if($form_tip == 'cam'){?>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_obje_ozellik[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('5', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Renkli</label>

                                                    <?php } ?>
                                                </div>

                                            </td>
                                        </tr>

                                    <?php }?>

                                    <tr>
                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Mevcut Durum</span>
                                            <br/><br/>

                                            <div class="inline-group">
                                                <label class="checkbox" >
                                                    <input disabled type="checkbox" name="opt_mevcut_durum[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_mevcut_durum); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                    <i></i>Tüm</label>


                                                <label class="checkbox" >
                                                    <input disabled type="checkbox" name="opt_mevcut_durum[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_mevcut_durum); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                    <i></i>Kırık</label>

                                                <label class="checkbox">
                                                    <input disabled type="checkbox" name="opt_mevcut_durum[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_mevcut_durum); if(in_array('3', $opt, true)){echo ' checked';}?>>
                                                    <i></i>Parçalı</label>

                                            </div>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Bozulmalar
                                            </span>
                                            <br/><br/>


                                            <div class="inline-group">

                                                <?php if($form_tip != 'sikke' && $form_tip != 'metal'){?>

                                                    <span style="float:left;font-weight: bold; margin-right: 10px;padding-top:2px;">Kalker:</span>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                        <i></i>İnce</label>


                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Kalın</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('3', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Lokal</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('4', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Tüm</label><br><br>
                                                    <?php if($form_tip == 'cam'){?>




                                                            <label class="checkbox">
                                                                <input disabled type="checkbox" name="opt_bozulmalar[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('5', $opt, true)){echo ' checked';}?>>
                                                                <i></i>Matlaşma</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="6" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('6', $opt, true)){echo ' checked';}?>>
                                                            <i></i>İrizasyon</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="7" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('7', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Kahve Rengi - Siyah Lekelenme</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="8" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('8', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Yapraklanma</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="9" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('9', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Yarık Oluşumu</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="10" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('10', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Opaklaşma</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="11" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('11', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Crizzling</label>
                                                    <?php } ?>




                                                    <?php if($form_tip == 'seramik' || $form_tip == 'tas'){?>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="12" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('12', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Yüzeysel Çatlak</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="13" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('13', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Derin Çatlak</label>

                                                    <?php } ?>

                                                <?php } else{?>



                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="14" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('14', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Patina</label>


                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="15" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('15', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Kalker</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="16" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('16', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Malahit</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="17" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('17', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Küprit</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="18" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('18', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Azurit</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="19" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('19', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Nantokit</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="20" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('20', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Atakamit</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="21" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('21', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paratakamit</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="22" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('22', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Gümüş Sülfür</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_bozulmalar[]" value="23" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('23', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Gümüş Klorür</label>



                                                    <?php if($form_tip == 'metal'){?>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="24" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('24', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Demir Oksit/Karbonat/Oksiditroksit</label>

                                                        <label class="checkbox">
                                                            <input disabled type="checkbox" name="opt_bozulmalar[]" value="25" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('25', $opt, true)){echo ' checked';}?>>
                                                            <i></i>Galvanik</label>

                                                    <?php }?>


                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Temizlik</span>
                                            <br/><br/>

                                            <div class="inline-group">

                                                <?php if($form_tip == 'seramik'){?>

                                                    <span style="float:left;font-weight: bold; margin-right: 10px;padding-top:2px;">Islak:</span>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Saf Su</label>


                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Su</label>

                                                    <br/><br/>

                                                <?php } ?>

                                                <span style="float:left;font-weight: bold; margin-right: 10px;padding-top:2px;">Kimyasal:</span>


                                                <?php if($form_tip == 'tas'){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('3', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Su</label>
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('4', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Formik Asit</label>

                                                <?php } ?>


                                                <?php if($form_tip == 'cam' || $form_tip == 'kemik' || $form_tip == 'tas' ){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('5', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Saf Su</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="6" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('6', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Alkol</label>


                                                <?php } ?>


                                                <?php if($form_tip == 'seramik' || $form_tip == 'sikke' || $form_tip == 'metal'){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="7" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('7', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Alkol</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="8" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('8', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Aseton</label>

                                                <?php } ?>

                                                <?php if($form_tip == 'seramik'){?>


                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="9" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('9', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Formik Asit</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="10" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('10', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Hidro Klorik Asit</label>
                                                <?php }?>

                                                <?php if($form_tip == 'metal'){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="11" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('11', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Asetik Asit</label>

                                                <?php }?>


                                                <?php if($form_tip == 'sikke' || $form_tip == 'metal' || $form_tip == 'seramik' || $form_tip == 'tas' ){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="12" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('12', $opt, true)){echo ' checked';}?>>
                                                        <i></i>EDTA</label>


                                                <?php } ?>


                                                <br/><br/>

                                                <span style="float:left;font-weight: bold; margin-right: 10px;padding-top:2px;">Mekanik:</span>

                                                <label class="checkbox" >
                                                    <input disabled type="checkbox" name="opt_temizlik[]" value="13" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('13', $opt, true)){echo ' checked';}?>>
                                                    <i></i>Bisturi</label>

                                                <?php if($form_tip != 'sikke' && $form_tip != 'metal'){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="14" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('14', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Fırça</label>

                                                <?php } ?>

                                                <?php if($form_tip == 'seramik' || $form_tip == 'tas' || $form_tip == 'metal'){?>
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="15" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('`5`', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Micro Scaler</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="16" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('16', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Micro Motor</label>

                                                <?php } ?>

                                                <?php if($form_tip == 'sikke' || $form_tip == 'tas' || $form_tip == 'metal'){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="17" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('17', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Cam Elyaf</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="18" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('18', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Mikro Bıçaklar</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="19" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('19', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Bambu Çubuk v.b.</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="20" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('20', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Mikro Motor</label>
                                                <?php } ?>

                                                <?php if($form_tip == 'tas' || $form_tip == 'metal'){?>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_temizlik[]" value="21" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('21', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Dramel</label>

                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Yapıştırma</span>
                                            <br/><br/>

                                            <div class="inline-group">

                                                <?php if($form_tip == 'kemik'){?>
                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paraloid B-72</label>


                                                <?php } ?>

                                                <?php if($form_tip == 'cam' || $form_tip == 'metal' || $form_tip == 'sikke' ){?>
                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Araldit 2020</label>
                                                <?php } ?>

                                                <?php if($form_tip == 'tas'){?>
                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('3', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Devcon</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('4', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Araldit</label>
                                                <?php } ?>


                                                <?php if($form_tip == 'seramik' || $form_tip == 'metal' || $form_tip == 'sikke'){?>
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('5', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paraloid B-72</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="6" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('6', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paraloid B-48N</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="7" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('7', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paraloid B-44</label>


                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="8" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('8', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Epoksi</label>

                                                    <label class="checkbox">
                                                        <input disabled type="checkbox" name="opt_yapistirma[]" value="9" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('9', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Araldit 5min</label>



                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>


                                    <?php if($form_tip == 'seramik'){?>
                                        <tr>
                                            <td colspan="4">
                                                <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Tümleme</span>
                                                <br/><br/>

                                                <div class="inline-group">
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_tumleme[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_tumleme); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Alçı</label>


                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_tumleme[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_tumleme); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Akrilik Boya</label>

                                                </div>

                                            </td>
                                        </tr>

                                    <?php }?>


                                    <tr>
                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Sağlamlaştırma</span>
                                            <br/><br/>

                                            <div class="inline-group">
                                                <label class="checkbox" >
                                                    <input disabled type="checkbox" name="opt_saglamlastirma[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('1', $opt, true)){echo ' checked';}?>>
                                                    <i></i>Paraloid B-72</label>

                                                <?php if($form_tip == 'tas'){?>
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_saglamlastirma[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('2', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Primal AC 33</label>
                                                <?php } ?>

                                                <?php if($form_tip == 'sikke' || $form_tip == 'metal'){?>
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_saglamlastirma[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('3', $opt, true)){echo ' checked';}?>>
                                                        <i></i>BTA</label>
                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_saglamlastirma[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('4', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paraloid B-48N</label>

                                                    <label class="checkbox" >
                                                        <input disabled type="checkbox" name="opt_saglamlastirma[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('5', $opt, true)){echo ' checked';}?>>
                                                        <i></i>Paraloid B-44</label>
                                                <?php } ?>

                                            </div>

                                        </td>
                                    </tr>


                                    </tbody>
                                </table>

                                <br>

                                <table class="table table-bordered table-striped table-condensed table-hover">

                                    <thead>
                                    <tr>
                                        <th colspan="4">Açıklama</th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr>
                                        <td colspan="4">
                                            <label class="textarea">
                                                <?php echo stripslashes($q->aciklama);?>
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
                                                    <a href="#" style="float: left;" data-id="<?php echo $q->kons_bk_id;?>" data-container="modal-content" rel="tooltip" data-placement="left" data-original-title="İşlem Geçmişi"
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

                        <a href="<?php echo 'index/konservasyon_duzenle/' . $q->kons_bk_id;?>"  class="btn btn-labeled btn-primary ajax" > <i class="fa fa-pencil"></i> Düzenle </a>

                        <a href="javascript:robo.print.show('<?php echo 'index/konservasyon_detay/' . $q->kons_bk_id . '/1';?>')"  class="btn btn-labeled bg-color-blueLight txt-color-white btnyazdir_anakod"> <i class="fa fa-print"></i> Yazdır </a>
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
                var git = path + 'index/log_getir/' + id + '/konservasyon_listesi';

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

