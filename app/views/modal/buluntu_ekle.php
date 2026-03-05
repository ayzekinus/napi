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
                    <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
                    <h2><strong>Buluntu</strong> <i>Oluştur</i> <?php if($id > 0 ){echo " ~ " . @$q->anakod;} ?></h2>

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
                                                    <a href="#" class="btn btn-labeled btn-success btn-aktif"> <span
                                                            class="btn-label"><i
                                                                class="glyphicon glyphicon-ok"></i></span>Aktif </a>
                                                    <a href="#" class="btn btn-labeled btn-danger btn-pasif"
                                                       style="display: none;"> <span class="btn-label"><i
                                                                class="glyphicon glyphicon-remove"></i></span>Pasif </a>
                                                    <input type="hidden" name="durum" value="1"/>
                                                </td>
                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Anakod <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="anakod_select">
                                                    <select name="bk_anakod_id" class="select2 required" style="width: 100%;">
                                                        <option value=""></option>
                                                        <?php
                                                        $select = '';
                                                        foreach($anakod as $a){
                                                            if($a->anakod_id == $q->anakod_id) {$select = ' selected';}else{$select = '';}
                                                            echo '<option value="'.$a->anakod_id.'" '.$select.'>'.$a->anakod.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Buluntu No <i class="fa fa-asterisk reqicon"></i></td>

                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_no" type="text" class="required mask_number">
                                                    </label>
                                                </td>
                                            </tr>

                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Tarihi <i class="fa fa-asterisk reqicon"></i></td>

                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_tarihi" type="text" placeholder="" class="datepicker required">
                                                    </label>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Şube</td>

                                                <td>
                                                    <label class="input">
                                                        <input name="sube" type="text" placeholder="" class="mask_number">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Kazı Env. No</td>

                                                <td>
                                                    <label class="input">
                                                        <input name="kazienv_no" type="text" placeholder="">
                                                    </label>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Müze Env. No</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="muzeenv_no" type="text" placeholder="">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Form/Obje <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="formobje_select">
                                                    <select name="bk_formobje_id" class="select2 required" style="width: 100%;">
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Yapım Malzemesi <i class="fa fa-asterisk reqicon"></i></td>
                                                <td class="yapimmalzemesi_select">
                                                    <select name="bk_yapim_mlz_id" class="select2 required" style="width: 100%;">
                                                    </select>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Üretim Yeri</td>

                                                <td class="uretimyeri_select">
                                                    <select name="bk_uretimyeri_id" class="select2" style="width: 100%;">
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Dönem</td>
                                                <td class="donem_select">
                                                    <select name="bk_donem_id" class="select2 " style="width: 100%;">
                                                    </select>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Tip</td>

                                                <td class="tip_select">
                                                    <select name="bk_tip_id" class="select2" style="width: 100%;">
                                                    </select>
                                                </td>


                                              <td colspan="2"></td>

                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="buluntu_select <?php if ($id > 0) echo ' hasOpen';?>">
                                                    <select name="bk_buluntuyeri_id" class="select2 required " style="width: 100%;">
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Buluntu Şekli</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_sekli" type="text" placeholder="">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Plankare</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="plankare" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Tabaka</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="tabaka" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Seviye</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="seviye" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Mezar No</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="mezarno" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Eser Tarihi</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="eser_tarihi" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">B. Yeri Diğer</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_yeri_diger_bilgi" type="text" placeholder="">
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
                                                        <input name="yukseklik" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Ağız Çapı</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="agiz_capi" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Kaide/Dip Çapı</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="dip_capi" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Kalınlık/Cidar</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="derinlik" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Uzunluk</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="uzunluk" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Genişlik</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="genislik" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="vertical-align:middle;">Çap</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="cap" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Gram</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="gram" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>


                                                <td style="vertical-align:middle;">Hamur Rengi</td>
                                                <td class="hamur_select">
                                                    <select name="bk_hamur_renk_id" class="select2 " style="width: 100%;">
                                                    </select>
                                                </td>


                                                <td style="vertical-align:middle;">Astar Rengi</td>
                                                <td class="astar_select">
                                                    <select name="bk_astar_renk_id" class="select2 " style="width: 100%;">
                                                    </select>
                                                </td>


                                            </tr>


                                            <tr>

                                                <td style="vertical-align:middle;">Kalıp Yönü</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="kalip_yonu" type="text" placeholder="">
                                                    </label>
                                                </td>


                                                <td style="vertical-align:middle;">Diğer Renk</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="diger_renk" type="text" placeholder="">
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
                                                        <textarea name="tanim" id="editor"></textarea>
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
                                                        <textarea name="kaynak_referans" id="editor2"></textarea>
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
                                                    <a href="index/buluntu_galeri" data-target="#remoteModal"
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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=1112"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>


<script type="text/javascript">

    $(document).ready(function () {

        form = robo.form;
        form.url = "post/insert/buluntu";
        form.validate = true;

        form.use.datepicker();
        form.use.select2();

        robo.data.load('anakod', '.anakod_select','search');

        robo.data.load('buluntu', '.buluntu_select','open');
        robo.data.load('formobje', '.formobje_select','open');
        robo.data.load('yapim_malzemesi', '.yapimmalzemesi_select','open');
        robo.data.load('uretim_yeri', '.uretimyeri_select','open');
        robo.data.load('donem', '.donem_select','open');
        robo.data.load('tip', '.tip_select','open');
        robo.data.load('renk', '.hamur_select','open');
        robo.data.load('renk', '.astar_select','open');

        form.use.ckeditor('editor');
        form.use.ckeditor('editor2');

        $("input[name='sube']").TouchSpin({
            min: 0, max: 100, initval: 1, verticalbuttons: true
        });

        $("input[name='yukseklik'], input[name='genislik'], input[name='agiz_capi'], input[name='dip_capi'], input[name='derinlik'], input[name='cap'], input[name='uzunluk']").TouchSpin({
            min: 0, max: 1000, step: 0.1, decimals: 2, boostat: 5, maxboostedstep: 10, postfix: 'cm', forcestepdivisibility: false
        });

        $("input[name='gram']").TouchSpin({
            min: 0, max: 9999, step: 0.1, decimals: 2, boostat: 5, maxboostedstep: 10, postfix: 'gr', forcestepdivisibility: false
        });

        var id = '<?php echo $id;?>';

        if(id > 0){
            drawBreadCrumb(["Buluntu", "Oluştur"]);
            $(".menu_buluntu").addClass("active");
        }

    });

</script>