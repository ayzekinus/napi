<style type="text/css">

    .alt_gorsel {
        text-align: center;
        outline: solid 1px #ccc;
        background: rgba(0,0,0,0.05);
        padding: 5px;
        margin: 8px 8px !important;
        display: inline-block;
    }
    .alt_gorsel img:hover{cursor: pointer;}

</style>

<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                    <h2><strong>Buluntu</strong> <i>Düzenle</i></h2>


                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/buluntu_listesi" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
                </header>

                <!-- widget div-->
                <div>


                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form id="formk" action="" class="smart-form">
                            <input type="hidden" name="token" value="<?php echo $token;?>">


                            <div style="margin: 10px;">

                                <ul id="myTab1" class="nav nav-tabs bordered">
                                    <li class="active">
                                        <a href="#s1" data-toggle="tab">Genel Bilgiler </a>
                                    </li>

                                </ul>

                                <div id="myTabContent1" class="tab-content padding-10">
                                    <div class="tab-pane fade active in" id="s1">

                                        <table class="table table-bordered table-striped table-condensed table-hover">


                                            <thead>
                                            <tr>
                                                <th colspan="4">Genel Bilgiler</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Durumu</td>
                                                <td colspan="3">
                                                    <a href="#" class="btn btn-labeled btn-success btn-aktif" <?php if ($q->durum == 0) {
                                                        echo ' style="display: none;" ';
                                                    } ?>> <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Aktif </a>
                                                    <a href="#" class="btn btn-labeled btn-danger btn-pasif"  <?php if ($q->durum == 1) {
                                                        echo ' style="display: none;" ';
                                                    } ?>> <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Pasif </a>
                                                    <input type="hidden" name="durum" type="text" value="<?php echo $q->durum; ?>"/>
                                                </td>


                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Anakod <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="anakod_select">
                                                    <select name="bk_anakod_id" style="width: 100%;" class="select2 required">
                                                        <option value=""></option>
                                                        <?php echo '<option value="'.$anakod->anakod_id.'" selected>'.$anakod->anakod.'</option>';?>
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Buluntu No <i class="fa fa-asterisk reqicon"></i></td>

                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_no" type="text" class="required mask_number" value="<?php echo $q->buluntu_no;?>"/>
                                                    </label>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Tarihi <i class="fa fa-asterisk reqicon"></i></td>

                                                <td>
                                                    <label class="input">
                                                        <?php
                                                            $tarih = '';
                                                            if($q->buluntu_tarihi != ''){
                                                                $date = new DateTime(stripslashes($q->buluntu_tarihi));
                                                                $tarih = $date->format('d.m.Y');
                                                            }
                                                        ?>
                                                        <input name="buluntu_tarihi" type="text" placeholder="" class="datepicker required" value="<?php echo $tarih;?>">
                                                    </label>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Şube</td>

                                                <td>
                                                    <label class="input">
                                                        <input name="sube" type="text" placeholder="" value="<?php echo stripslashes($q->sube);?>" class="mask_number">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Kazı Env. No</td>

                                                <td>
                                                    <label class="input">
                                                        <input name="kazienv_no" type="text" placeholder="" value="<?php echo stripslashes($q->kazienv_no);?>">
                                                    </label>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Müze Env. No</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="muzeenv_no" type="text" placeholder="" value="<?php echo stripslashes($q->muzeenv_no);?>">
                                                    </label>
                                                </td>


                                            </tr>

                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Form/Obje <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="formobje_select" >
                                                    <select name="bk_formobje_id" class="select2 required" style="width: 100%;">
                                                        <?php  if($q->bk_formobje_id > 0) echo '<option value="'.$q->bk_formobje_id.'" selected>'.$lb_formobje->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Yapım Malzemesi <i class="fa fa-asterisk reqicon"></i></td>
                                                <td class="yapimmalzemesi_select" >
                                                    <select name="bk_yapim_mlz_id" class="select2 required" style="width: 100%;">
                                                        <?php  if($q->bk_yapim_mlz_id > 0) echo '<option value="'.$q->bk_yapim_mlz_id.'" selected>'.$lb_yapimmalzemesi->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Üretim Yeri</td>

                                                <td class="uretimyeri_select" >
                                                    <select name="bk_uretimyeri_id" class="select2" style="width: 100%;">
                                                        <?php  if($q->bk_uretimyeri_id > 0) echo '<option value="'.$q->bk_uretimyeri_id.'" selected>'.$lb_uretimyeri->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Dönem</td>
                                                <td class="donem_select" >
                                                    <select name="bk_donem_id" class="select2" style="width: 100%;">
                                                        <?php  if($q->bk_donem_id > 0) echo '<option value="'.$q->bk_donem_id.'" selected>'.$lb_donem->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Tip</td>

                                                <td class="tip_select" >
                                                    <select name="bk_tip_id" class="select2" style="width: 100%;">
                                                        <?php  if($q->bk_tip_id > 0) echo '<option value="'.$q->bk_tip_id.'" selected>'.$lb_tip->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>


                                              <td colspan="2"></td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="buluntu_select" >
                                                    <select name="bk_buluntuyeri_id" class="select2 required" style="width: 100%;">
                                                        <?php  if($q->bk_buluntuyeri_id > 0) echo '<option value="'.$q->bk_buluntuyeri_id.'" selected>'.$lb_buluntu_yeri->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Buluntu Şekli</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_sekli" type="text" placeholder="" value="<?php echo stripslashes($q->buluntu_sekli);?>">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Plankare</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="plankare" type="text" placeholder="" value="<?php echo stripslashes($q->plankare);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Tabaka</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="tabaka" type="text" placeholder="" value="<?php echo stripslashes($q->tabaka);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Seviye</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="seviye" type="text" placeholder="" value="<?php echo stripslashes($q->seviye);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Mezar No</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="mezarno" type="text" placeholder="" value="<?php echo stripslashes($q->mezarno);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Eser Tarihi</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="eser_tarihi" type="text" placeholder="" value="<?php echo stripslashes($q->eser_tarihi);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">B. Yeri Diğer</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_yeri_diger_bilgi" type="text" placeholder="" value="<?php echo stripslashes($q->buluntu_yeri_diger_bilgi);?>">
                                                    </label>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Ölçü & Renk Bilgileri</th>
                                            </tr>
                                            </thead>

                                            <tbody>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Yükseklik</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="yukseklik" type="text" placeholder="" value="<?php echo stripslashes($q->yukseklik);?>">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Ağız Çapı</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="agiz_capi" type="text" placeholder="" value="<?php echo stripslashes($q->agiz_capi);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Kaide/Dip Çapı</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="dip_capi" type="text" placeholder="" value="<?php echo stripslashes($q->dip_capi);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Kalınlık/Cidar</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="derinlik" type="text" placeholder="" value="<?php echo stripslashes($q->derinlik);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Uzunluk</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="uzunluk" type="text" placeholder="" value="<?php echo stripslashes($q->uzunluk);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Genişlik</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="genislik" type="text" placeholder="" value="<?php echo stripslashes($q->genislik);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Çap</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="cap" type="text" placeholder="" value="<?php echo stripslashes($q->cap);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Gram</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="gram" type="text" placeholder="" value="<?php echo stripslashes($q->gram);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Hamur Rengi</td>
                                                <td class="hamur_select" >
                                                    <select name="bk_hamur_renk_id" class="select2" style="width: 100%;">
                                                        <?php  if($q->bk_hamur_renk_id > 0) echo '<option value="'.$q->bk_hamur_renk_id.'" selected>'.$lb_renk_hamur->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>

                                                <td style="vertical-align:middle;">Astar Rengi</td>
                                                <td class="astar_select" >
                                                    <select name="bk_astar_renk_id" class="select2" style="width: 100%;">
                                                        <?php  if($q->bk_astar_renk_id > 0) echo '<option value="'.$q->bk_astar_renk_id.'" selected>'.$lb_renk_astar->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>

                                                <td style="vertical-align:middle;">Kalıp Yönü</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="kalip_yonu" type="text" placeholder="" value="<?php echo stripslashes($q->kalip_yonu);?>">
                                                    </label>
                                                </td>


                                                <td style="vertical-align:middle;">Diğer Renk</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="diger_renk" type="text" placeholder="" value="<?php echo stripslashes($q->diger_renk);?>">
                                                    </label>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>

                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Tanım / Bezeme</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <label class="textarea">
                                                        <textarea name="tanim" id="editor"><?php echo stripslashes($q->tanim);?></textarea>
                                                    </label>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Kaynak ve Referans</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td colspan="4">
                                                    <label class="textarea">
                                                        <textarea name="kaynak_referans" id="editor2"><?php echo stripslashes($q->kaynak_referans);?></textarea>
                                                    </label>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Buluntu Görseli</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Buluntu Görseli</td>
                                                <td colspan="3" class="gorsel_thumb">
                                                    <input type="hidden" name="gorsel" id="ust_gorsel" value=""/>
                                                    <a href="index/buluntu_galeri/<?php echo $q->bk_id;?>" data-target="#remoteModal"
                                                       data-toggle="modal"
                                                       class="btn btn-labeled bg-color-blueDark txt-color-white btn-gorselsec "> <span
                                                            class="btn-label"><i
                                                                class="glyphicon glyphicon-picture"></i></span>Galeri
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>

                                                <td colspan="4" class="gorsel_thumb" style="background-color: #FCFCF9 !important;">
                                                    <div class="gorsel_div">

                                                        <?php foreach($galeri as $g){?>

                                                        <div class="alt_gorsel">
                                                            <img src="<?php echo Url::base();?>uploads/images/thumb/<?php echo $g->dosya;?>" width="150" height="120" class="gorsel_img" data-name="<?php echo $g->dosya;?>">
                                                            <span><i class="fa fa-times fa-lg btngorselsil"></i></span>
                                                        </div>

                                                        <?php }?>

                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                            <footer>
                                <button type="button" class="btn btn-info btnkaydet">
                                    <i class="fa fa-save"></i> Kaydet
                                </button>
                                <a href="index/buluntu_listesi" type="button" class="ajax btn btn-default"
                                   data-dismiss="modal">
                                    <i class="fa fa-remove"></i> Kapat
                                </a>
                            </footer>
                        </form>


                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>

    </div>

    <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: none !important;">

            </div>
        </div>
    </div>

</section>


<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=4"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>

<script type="text/javascript">

    $(document).ready(function () {

        form = robo.form;
        form.url = 'post/update/buluntu/<?php echo $q->bk_id;?>';
        form.validate = true;

        form.use.datepicker();
        form.use.select2();
        form.use.ckeditor('editor');
        form.use.ckeditor('editor2');

        robo.data.load('anakod', '.anakod_select','search');
        robo.data.load('buluntu', '.buluntu_select','open');
        robo.data.load('formobje', '.formobje_select','open');
        robo.data.load('yapim_malzemesi', '.yapimmalzemesi_select','open');
        robo.data.load('uretim_yeri', '.uretimyeri_select','open');
        robo.data.load('donem', '.donem_select','open');
        robo.data.load('tip', '.tip_select','open');
        robo.data.load('renk', '.hamur_select','open');
        robo.data.load('renk', '.astar_select','open');


        $("input[name='yukseklik'], input[name='genislik'], input[name='agiz_capi'], input[name='dip_capi'], input[name='derinlik'], input[name='cap'], input[name='uzunluk']").TouchSpin({
            min: 0, max: 1000, step: 0.1, decimals: 2, boostat: 5, maxboostedstep: 10, postfix: 'cm', forcestepdivisibility: false
        });

        $("input[name='gram']").TouchSpin({
            min: 0, max: 9999, step: 0.1, decimals: 2, boostat: 5, maxboostedstep: 10, postfix: 'gr', forcestepdivisibility: false
        });

        $(".menu_buluntu").addClass("active");
        drawBreadCrumb(["Düzenle"]);

        setTimeout(galeri_img(), 2000);

    });

</script>