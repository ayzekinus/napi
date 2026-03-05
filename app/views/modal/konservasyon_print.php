<style type="text/css">

    @page{
        size: auto;
        margin: 8mm;
    }

    body
    {
        margin: 0px;
        width: 100%; overflow-y: hidden;
    }

    .print_line{
        width: 100%;
        float: left;
        color: black;
        font-family: "Times New Roman" !important;
        font-size: 12pt !important;
    }

    .print_line .title{width: 140px;height: 20px; float: left;font-weight: bold;padding: 2px 5px !important;}
    .print_line .data{ height: 20px; float :left;padding: 2px 5px !important;}
    .print_line .content{width: 695px; padding: 10px 5px 0 5px; }

    .inline-group label{margin-right: 5px;}
    .inline-group label input{
        width: 15px;
        height: 15px;
        outline: 0;
        border-width: 1px;
        border-style: solid;
        background: #FFF;
    }




</style>

<div class="print_line">
    <div class="content" style="text-align: center;margin-bottom: 25px;">
        <span style="font-weight: bold; font-size: 20pt;">PARİON ANTİK KENTİ </span>
        <br>
        <span style="font-weight: bold;font-size: 14pt;">

            <?php echo str_replace('TAS', 'TAŞ', strtoupper_tr($q->tip)); if($q->tip != 'sikke'){echo ' BULUNTU ';}?> RAPORU
        </span>
    </div>
</div>


<div style="width: 100%;">

    <div style="width: 340px;float:left;">

        <div class="print_line">
            <span class="title">Buluntu Numarası:</span>
            <span class="data"><?php echo $qq->anakod . " - " .$qq->buluntu_no;?></span>
        </div>

        <div class="print_line">
            <span class="title">Obje Türü:</span>
            <span class="data"><?php echo $qq->form_obje;?></span>
        </div>

        <div class="print_line">
            <span class="title">Meteryal:</span>
            <span class="data"><?php echo $qq->yapim_malzemesi;?></span>
        </div>

    </div>

    <div style="width: 390px; float:left;">

        <div class="print_line">
            <span class="title">Buluntu Yeri:</span>
            <span class="data"><?php echo $qq->buluntu_yeri;?></span>
        </div>

        <div class="print_line">
            <span class="title">Lab. Giriş Tarihi:</span>
            <span class="data"><?php echo $q->lab_giris;?></span>
        </div>

        <div class="print_line">
            <span class="title">Lab. Çıkış Tarihi:</span>
            <span class="data"><?php echo $q->lab_cikis;?></span>
        </div>

    </div>

</div>




<table class="table table-bordered table-striped table-condensed table-hover">



    <tbody>

    <?php if($form_tip !== 'sikke'){?>

        <tr>
            <td colspan="4">
                <span style="vertical-align:middle;width: 200px;font-weight: bold;text-decoration: underline;">Objenin Özellikleri</span>
                <br/><br/>

                <div class="inline-group">

                    <?php if ($form_tip == 'seramik'){?>

                        <label class="checkbox" >
                            <input type="checkbox" name="opt_obje_ozellik[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('1', $opt, true)){echo ' checked';}?>>
                            <i></i>Boyalı</label>

                    <?php } ?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_obje_ozellik[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('2', $opt, true)){echo ' checked';}?>>
                        <i></i>Bezemeli</label>


                    <?php if($form_tip == 'seramik' || $form_tip == 'tas'){?>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_obje_ozellik[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('3', $opt, true)){echo ' checked';}?>>
                            <i></i>Mühürlü</label>

                        <label class="checkbox">
                            <input type="checkbox" name="opt_obje_ozellik[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('4', $opt, true)){echo ' checked';}?>>
                            <i></i>Kabartmalı</label>

                    <?php } ?>


                    <?php if($form_tip == 'cam'){?>

                        <label class="checkbox">
                            <input type="checkbox" name="opt_obje_ozellik[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_obje_ozellik); if(in_array('5', $opt, true)){echo ' checked';}?>>
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
                    <input type="checkbox" name="opt_mevcut_durum[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_mevcut_durum); if(in_array('1', $opt, true)){echo ' checked';}?>>
                    <i></i>Tüm</label>


                <label class="checkbox" >
                    <input type="checkbox" name="opt_mevcut_durum[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_mevcut_durum); if(in_array('2', $opt, true)){echo ' checked';}?>>
                    <i></i>Kırık</label>

                <label class="checkbox">
                    <input type="checkbox" name="opt_mevcut_durum[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_mevcut_durum); if(in_array('3', $opt, true)){echo ' checked';}?>>
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
                        <input type="checkbox" name="opt_bozulmalar[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('1', $opt, true)){echo ' checked';}?>>
                        <i></i>İnce</label>


                    <label class="checkbox" >
                        <input type="checkbox" name="opt_bozulmalar[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('2', $opt, true)){echo ' checked';}?>>
                        <i></i>Kalın</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('3', $opt, true)){echo ' checked';}?>>
                        <i></i>Lokal</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('4', $opt, true)){echo ' checked';}?>>
                        <i></i>Tüm</label>
                    <?php if($form_tip == 'cam'){?>


                        <div class="inline-group">

                            <label class="checkbox">
                                <input type="checkbox" name="opt_bozulmalar[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('5', $opt, true)){echo ' checked';}?>>
                                <i></i>Matlaşma</label>
                        </div>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="6" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('6', $opt, true)){echo ' checked';}?>>
                            <i></i>İrizasyon</label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="7" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('7', $opt, true)){echo ' checked';}?>>
                            <i></i>Kahve Rengi - Siyah Lekelenme</label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="8" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('8', $opt, true)){echo ' checked';}?>>
                            <i></i>Yapraklanma</label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="9" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('9', $opt, true)){echo ' checked';}?>>
                            <i></i>Yarık Oluşumu</label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="10" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('10', $opt, true)){echo ' checked';}?>>
                            <i></i>Opaklaşma</label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="11" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('11', $opt, true)){echo ' checked';}?>>
                            <i></i>Crizzling</label>
                    <?php } ?>




                    <?php if($form_tip == 'seramik' || $form_tip == 'tas'){?>

                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="12" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('12', $opt, true)){echo ' checked';}?>>
                            <i></i>Yüzeysel Çatlak</label>

                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="13" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('13', $opt, true)){echo ' checked';}?>>
                            <i></i>Derin Çatlak</label>

                    <?php } ?>

                <?php } else{?>



                    <label class="checkbox" >
                        <input type="checkbox" name="opt_bozulmalar[]" value="14" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('14', $opt, true)){echo ' checked';}?>>
                        <i></i>Patina</label>


                    <label class="checkbox" >
                        <input type="checkbox" name="opt_bozulmalar[]" value="15" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('15', $opt, true)){echo ' checked';}?>>
                        <i></i>Kalker</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="16" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('16', $opt, true)){echo ' checked';}?>>
                        <i></i>Malahit</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="17" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('17', $opt, true)){echo ' checked';}?>>
                        <i></i>Küprit</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="18" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('18', $opt, true)){echo ' checked';}?>>
                        <i></i>Azurit</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="19" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('19', $opt, true)){echo ' checked';}?>>
                        <i></i>Nantokit</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="20" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('20', $opt, true)){echo ' checked';}?>>
                        <i></i>Atakamit</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="21" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('21', $opt, true)){echo ' checked';}?>>
                        <i></i>Paratakamit</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="22" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('22', $opt, true)){echo ' checked';}?>>
                        <i></i>Gümüş Sülfür</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_bozulmalar[]" value="23" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('23', $opt, true)){echo ' checked';}?>>
                        <i></i>Gümüş Klorür</label>



                    <?php if($form_tip == 'metal'){?>

                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="24" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('24', $opt, true)){echo ' checked';}?>>
                            <i></i>Demir Oksit/Karbonat/Oksiditroksit</label>

                        <label class="checkbox">
                            <input type="checkbox" name="opt_bozulmalar[]" value="25" <?php $opt = ''; $opt = explode(',', $q->opt_bozulmalar); if(in_array('25', $opt, true)){echo ' checked';}?>>
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
                        <input type="checkbox" name="opt_temizlik[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('1', $opt, true)){echo ' checked';}?>>
                        <i></i>Saf Su</label>


                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('2', $opt, true)){echo ' checked';}?>>
                        <i></i>Su</label>

                    <br/><br/>

                <?php } ?>

                <span style="float:left;font-weight: bold; margin-right: 10px;padding-top:2px;">Kimyasal:</span>


                <?php if($form_tip == 'tas'){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('3', $opt, true)){echo ' checked';}?>>
                        <i></i>Su</label>
                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('4', $opt, true)){echo ' checked';}?>>
                        <i></i>Formik Asit</label>

                <?php } ?>


                <?php if($form_tip == 'cam' || $form_tip == 'kemik' || $form_tip == 'tas' ){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('5', $opt, true)){echo ' checked';}?>>
                        <i></i>Saf Su</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="6" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('6', $opt, true)){echo ' checked';}?>>
                        <i></i>Alkol</label>


                <?php } ?>


                <?php if($form_tip == 'seramik' || $form_tip == 'sikke' || $form_tip == 'metal'){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="7" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('7', $opt, true)){echo ' checked';}?>>
                        <i></i>Alkol</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="8" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('8', $opt, true)){echo ' checked';}?>>
                        <i></i>Aseton</label>

                <?php } ?>

                <?php if($form_tip == 'seramik'){?>


                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="9" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('9', $opt, true)){echo ' checked';}?>>
                        <i></i>Formik Asit</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="10" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('10', $opt, true)){echo ' checked';}?>>
                        <i></i>Hidro Klorik Asit</label>
                <?php }?>

                <?php if($form_tip == 'metal'){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="11" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('11', $opt, true)){echo ' checked';}?>>
                        <i></i>Asetik Asit</label>

                <?php }?>


                <?php if($form_tip == 'sikke' || $form_tip == 'metal' || $form_tip == 'seramik' || $form_tip == 'tas' ){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="12" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('12', $opt, true)){echo ' checked';}?>>
                        <i></i>EDTA</label>


                <?php } ?>


                <br/><br/>

                <span style="float:left;font-weight: bold; margin-right: 10px;padding-top:2px;">Mekanik:</span>

                <label class="checkbox" >
                    <input type="checkbox" name="opt_temizlik[]" value="13" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('13', $opt, true)){echo ' checked';}?>>
                    <i></i>Bisturi</label>

                <?php if($form_tip != 'sikke' && $form_tip != 'metal'){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="14" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('14', $opt, true)){echo ' checked';}?>>
                        <i></i>Fırça</label>

                <?php } ?>

                <?php if($form_tip == 'seramik' || $form_tip == 'tas' || $form_tip == 'metal'){?>
                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="15" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('`5`', $opt, true)){echo ' checked';}?>>
                        <i></i>Micro Scaler</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="16" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('16', $opt, true)){echo ' checked';}?>>
                        <i></i>Micro Motor</label>

                <?php } ?>

                <?php if($form_tip == 'sikke' || $form_tip == 'tas' || $form_tip == 'metal'){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="17" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('17', $opt, true)){echo ' checked';}?>>
                        <i></i>Cam Elyaf</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="18" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('18', $opt, true)){echo ' checked';}?>>
                        <i></i>Mikro Bıçaklar</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="19" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('19', $opt, true)){echo ' checked';}?>>
                        <i></i>Bambu Çubuk v.b.</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="20" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('20', $opt, true)){echo ' checked';}?>>
                        <i></i>Mikro Motor</label>
                <?php } ?>

                <?php if($form_tip == 'tas' || $form_tip == 'metal'){?>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_temizlik[]" value="21" <?php $opt = ''; $opt = explode(',', $q->opt_temizlik); if(in_array('21', $opt, true)){echo ' checked';}?>>
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
                        <input type="checkbox" name="opt_yapistirma[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('1', $opt, true)){echo ' checked';}?>>
                        <i></i>Paraloid B-72</label>


                <?php } ?>

                <?php if($form_tip == 'cam' || $form_tip == 'metal' || $form_tip == 'sikke' ){?>
                    <label class="checkbox">
                        <input type="checkbox" name="opt_yapistirma[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('2', $opt, true)){echo ' checked';}?>>
                        <i></i>Araldit 2020</label>
                <?php } ?>

                <?php if($form_tip == 'tas'){?>
                    <label class="checkbox">
                        <input type="checkbox" name="opt_yapistirma[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('3', $opt, true)){echo ' checked';}?>>
                        <i></i>Devcon</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_yapistirma[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('4', $opt, true)){echo ' checked';}?>>
                        <i></i>Araldit</label>
                <?php } ?>


                <?php if($form_tip == 'seramik' || $form_tip == 'metal' || $form_tip == 'sikke'){?>
                    <label class="checkbox" >
                        <input type="checkbox" name="opt_yapistirma[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('5', $opt, true)){echo ' checked';}?>>
                        <i></i>Paraloid B-72</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_yapistirma[]" value="6" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('6', $opt, true)){echo ' checked';}?>>
                        <i></i>Paraloid B-48N</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_yapistirma[]" value="7" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('7', $opt, true)){echo ' checked';}?>>
                        <i></i>Paraloid B-44</label>


                    <label class="checkbox">
                        <input type="checkbox" name="opt_yapistirma[]" value="8" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('8', $opt, true)){echo ' checked';}?>>
                        <i></i>Epoksi</label>

                    <label class="checkbox">
                        <input type="checkbox" name="opt_yapistirma[]" value="9" <?php $opt = ''; $opt = explode(',', $q->opt_yapistirma); if(in_array('9', $opt, true)){echo ' checked';}?>>
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
                        <input type="checkbox" name="opt_tumleme[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_tumleme); if(in_array('1', $opt, true)){echo ' checked';}?>>
                        <i></i>Alçı</label>


                    <label class="checkbox" >
                        <input type="checkbox" name="opt_tumleme[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_tumleme); if(in_array('2', $opt, true)){echo ' checked';}?>>
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
                    <input type="checkbox" name="opt_saglamlastirma[]" value="1" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('1', $opt, true)){echo ' checked';}?>>
                    <i></i>Paraloid B-72</label>

                <?php if($form_tip == 'tas'){?>
                    <label class="checkbox" >
                        <input type="checkbox" name="opt_saglamlastirma[]" value="2" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('2', $opt, true)){echo ' checked';}?>>
                        <i></i>Primal AC 33</label>
                <?php } ?>

                <?php if($form_tip == 'sikke' || $form_tip == 'metal'){?>
                    <label class="checkbox" >
                        <input type="checkbox" name="opt_saglamlastirma[]" value="3" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('3', $opt, true)){echo ' checked';}?>>
                        <i></i>BTA</label>
                    <label class="checkbox" >
                        <input type="checkbox" name="opt_saglamlastirma[]" value="4" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('4', $opt, true)){echo ' checked';}?>>
                        <i></i>Paraloid B-48N</label>

                    <label class="checkbox" >
                        <input type="checkbox" name="opt_saglamlastirma[]" value="5" <?php $opt = ''; $opt = explode(',', $q->opt_saglamlastirma); if(in_array('5', $opt, true)){echo ' checked';}?>>
                        <i></i>Paraloid B-44</label>
                <?php } ?>

            </div>

        </td>
    </tr>


    </tbody>
</table>




<div class="print_line" style="margin-top:10px;">
    <span class="title" style="width: 90px !important;text-decoration: underline;">Konservatör:</span>
    <span class="data"><?php echo $q->konservator;?></span>
</div>

<div class="print_line">
    <div class="content">
        <?php echo stripslashes($q->aciklama);?>
    </div>
</div>

<footer>Bu Form CelsusData Veritabanı Üzerinden Oluşturulmuştur.</footer>
