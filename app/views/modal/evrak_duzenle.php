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
                    <h2><strong>Evrak</strong> <i>Düzenle</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/evrak_listesi/gelen" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>

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
                                                <td style="width: 150px;vertical-align:middle;">Evrak Tipi</td>

                                                <td style="vertical-align:middle;" >

                                                    <div class="inline-group">
                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_tipi" value="Gelen" <?php if($q->evrak_tipi == 'Gelen'){echo ' checked';}?>>
                                                            <i></i>Gelen</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_tipi" value="Giden" <?php if($q->evrak_tipi == 'Giden'){echo ' checked';}?>>
                                                            <i></i>Giden</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_tipi" value="Tutanaklar" <?php if($q->evrak_tipi == 'Tutanaklar'){echo ' checked';}?>>
                                                            <i></i>Tutanaklar</label>
                                                    </div>

                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Öncelik</td>

                                                <td style="vertical-align:middle;">

                                                    <div class="inline-group">

                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_oncelik" value="Düşük" <?php if($q->evrak_oncelik == 'Düşük'){echo ' checked';}?>>
                                                            <i></i>Düşük</label>

                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_oncelik" value="Normal" <?php if($q->evrak_oncelik == 'Normal'){echo ' checked';}?>>
                                                            <i></i>Normal</label>

                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_oncelik" value="Yüksek" <?php if($q->evrak_oncelik == 'Yüksek'){echo ' checked';}?>>
                                                            <i></i>Yüksek</label>
                                                    </div>

                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Evrak No / Tarihi</td>
                                                <td>
                                                    <label class="input" style="width: 48%; float: left;margin-right: 4%;">
                                                        <input name="evrak_no" type="text" placeholder="" class="mask_number" value="<?php echo stripslashes($q->evrak_no); ?>" >
                                                    </label>

                                                    <label class="input" style="width: 48%;float:left;">
                                                        <input name="evrak_tarihi" type="text" placeholder="" class="datepicker" value="<?php echo stripslashes($q->evrak_tarihi); ?>" >
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Evrak Sayı</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="evrak_sayi" type="text" placeholder="" value="<?php echo stripslashes($q->evrak_sayi); ?>">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">İlgili Kurum <i class="fa fa-asterisk reqicon"></i></td>
                                                <td >
                                                    <label class="input">
                                                        <input name="evrak_kurum" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->evrak_kurum); ?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">İlgili Birim</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="ilgili_birim" type="text" placeholder="" value="<?php echo stripslashes($q->ilgili_birim); ?>">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Evrak Konusu <i class="fa fa-asterisk reqicon"></i></td>
                                                <td colspan="3">
                                                    <label class="input">
                                                        <input name="evrak_konusu" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->evrak_konusu); ?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>


                                                <td style="width: 150px;vertical-align:middle;">Kayıt Tarihi</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="kayit_tarihi" type="text" class="datepicker" placeholder="" value="<?php echo stripslashes($q->kayit_tarihi); ?>">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Hızlı Erişim</td>

                                                <td style="vertical-align:middle;">

                                                    <div class="inline-group">
                                                        <label class="radio" >
                                                            <input type="radio" name="favori" value="1" <?php if($q->favori == 1){echo ' checked';}?>>
                                                            <i></i>Evet</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="favori" value="0" <?php if($q->favori == 0){echo ' checked';}?>>
                                                            <i></i>Hayır</label>
                                                    </div>

                                                </td>

                                            </tr>


                                            </tbody>
                                        </table>

                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th colspan="4"> Açıklama</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td colspan="4">
                                                    <textarea name="aciklama" id="editor"><?php echo stripslashes($q->aciklama); ?></textarea>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Yüklenecek Evraklar</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Evrak Seçimi</td>
                                                <td colspan="3" class="gorsel_thumb">
                                                    <input type="hidden" name="evrak_x_secimi" id="ust_gorsel" value=""/>
                                                    <a href="index/evrak_yukle/<?php echo $q->id;?>" data-target="#remoteModal"
                                                       data-toggle="modal"
                                                       class="btn btn-labeled bg-color-blueDark txt-color-white btn-gorselsec "> <span
                                                            class="btn-label"><i
                                                                class="glyphicon glyphicon-folder-open"></i></span>Gözat
                                                    </a>

                                                </td>
                                            </tr>

                                            <tr>

                                                <td colspan="4" class="gorsel_thumb" style="background-color: #FCFCF9 !important;">
                                                    <div class="gorsel_div">


                                                        <?php

                                                        foreach($dosyalar as $d){

                                                            $uzanti = explode('.', $d->dosya);
                                                            $uzanti = $uzanti[1];


                                                            $file = 'diger.png';

                                                            switch ($uzanti){
                                                                case "jpg":
                                                                case "jpeg":
                                                                case "png":
                                                                    $file = 'jpeg.png';
                                                                    break;
                                                                case "pdf":
                                                                    $file = 'pdf.png';
                                                                    break;
                                                                case "doc":
                                                                case "docx":
                                                                case "odt":
                                                                    $file = 'word.png';
                                                                    break;
                                                                case "xls":
                                                                case "xlsx":
                                                                case "ods":
                                                                    $file = 'excel.png';
                                                                    break;

                                                            }


                                                            ?>


                                                            <div class="alt_gorsel">
                                                                <img src="<?php echo Url::base('assets/img/file_icon/' . $file);?>" width="96" height="96" class="gorsel_img" data-name="<?php echo $d->dosya;?>">
                                                                <span style="width: 96px !important; margin: 80px 0 0 -96px !important;"><i class="fa fa-times fa-lg btngorselsil"></i></span>
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
                                <a href="index/evrak_listesi/<?php echo strtolower($q->evrak_tipi);?>" type="button" class="ajax btn btn-default"
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
        form.url = "post/update/evrak_yonetimi/<?php echo $q->id;?>";
        form.validate = true;

        form.use.select2();
        form.use.datepicker();
        form.use.ckeditor('editor');

        $(".menu_evrak").addClass("active");
        drawBreadCrumb(["Düzenle"]);

        $(".gorsel_div").on('click','.alt_gorsel img',function(){

            var name = $(this).attr("data-name");
            var url = '<?php echo Url::base("uploads/docs/");?>' + name;

            forceDownload(url,name);

            return false;
        });

    });


</script>