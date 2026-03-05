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
                    <h2><strong>Açma Rapor</strong> <i>Düzenle</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/acma_rapor_listesi" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
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
                                                <td style="width: 150px;vertical-align:middle;">Rapor Tipi</td>

                                                <td style="vertical-align:middle;" colspan="3">

                                                    <div class="inline-group">
                                                        <label class="radio" style="width: 30px;">
                                                            <input type="radio" name="rapor_tipi"  value="Günlük Rapor" <?php if($q->rapor_tipi == 'Günlük Rapor'){echo ' checked';}?>>
                                                            <i></i>Günlük</label>

                                                        <label class="radio" >
                                                            <input type="radio" name="rapor_tipi" value="Haftalık" <?php if($q->rapor_tipi == 'Haftalık'){echo ' checked';}?>>
                                                            <i></i>Haftalık</label>

                                                        <label class="radio">
                                                            <input type="radio" name="rapor_tipi" value="15 Günlük" <?php if($q->rapor_tipi == '15 Günlük'){echo ' checked';}?>>
                                                            <i></i>15 Günlük</label>

                                                        <label class="radio">
                                                            <input type="radio" name="rapor_tipi" value="Kapanış" <?php if($q->rapor_tipi == 'Kapanış'){echo ' checked';}?>>
                                                            <i></i>Kapanış</label>
                                                    </div>

                                                </td>
                                            </tr>


                                            <tr>


                                                <td style="width: 150px;vertical-align:middle;">Adı Soyadı <i class="fa fa-asterisk reqicon"></i></td>
                                                <td>
                                                    <label class="input">
                                                        <input name="adsoyad" type="text" placeholder="" value="<?php echo stripslashes($q->adsoyad);?>" class="required" <?php if($_SESSION['yetki'] != 'S'){echo ' readonly';}?>>
                                                    </label>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="buluntu_select">
                                                    <select name="buluntuyeri_id" class="select2 required" style="width: 100%;"
                                                            <option value=""></option>
                                                    <?php  if($q->buluntuyeri_id > 0) {
                                                        echo '<option value="' . $q->buluntuyeri_id . '" selected>' . $lb_buluntu_yeri->list_adi . '</option>';
                                                    }
                                                    ?>
                                                    </select>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Yazım Tarihi <i class="fa fa-asterisk reqicon"></i></td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="yazim_tarihi" type="text" placeholder="" class="datepicker required" value="<?php echo $q->yazim_tarihi;?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Çalışma Yılı <i class="fa fa-asterisk reqicon"></i></td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="calisma_yili" type="text" placeholder="" class="mask_yil required" value="<?php echo $q->calisma_yili;?>">
                                                    </label>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="vertical-align:middle;">Plankare(ler)</td>
                                                <td colspan="3">
                                                    <label class="input">
                                                        <input name="plankare" type="text" placeholder="" value="<?php echo stripslashes($q->plankare);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Başlık <i class="fa fa-asterisk reqicon"></i></td>
                                                <td colspan="3">
                                                    <label class="input">
                                                        <input name="baslik" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->baslik);?>">
                                                    </label>
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>

                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th colspan="4"> Detay *</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td colspan="4">
                                                    <textarea name="detay" id="editor"><?php echo stripslashes($q->detay);?></textarea>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Rapor Görseli</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Rapor Görseli</td>
                                                <td colspan="3" class="gorsel_thumb">
                                                    <input type="hidden" name="galeri_x_gorsel" id="ust_gorsel" value=""/>
                                                    <a href="index/acma_rapor_galeri/<?php echo $q->ID;?>" data-target="#remoteModal"
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
                                <a href="index/acma_rapor_listesi" type="button" class="ajax btn btn-default"
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
        form.url = "post/update/acma_rapor/<?php echo $q->ID;?>";
        form.validate = true;

        form.use.select2();
        form.use.ckeditor('editor');

        robo.data.load('buluntu', '.buluntu_select','open');

        $("input[name='calisma_yili']").TouchSpin({
            min: 1900,
            max: <?php echo date('Y');?>,
            initval: <?php echo date('Y');?>,
            verticalbuttons: true
        });

        $(".gorsel_div").on('click','.alt_gorsel img',function(){

            //src.select();
            //document.execCommand("copy");

            CKEDITOR.instances.editor.insertHtml('<img src="' + $(this).attr("src") + '">');

            return false;
        });

        $(".menu_acmarapor").addClass("active");
        drawBreadCrumb(["Düzenle"]);

    });


</script>