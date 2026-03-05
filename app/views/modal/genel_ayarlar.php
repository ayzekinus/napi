<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                    <h2><strong>Genel</strong> <i>Ayarlar</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/anasayfa" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>

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
                                        <a href="#s1" data-toggle="tab">Genel Ayarlar </a>
                                    </li>
                                </ul>

                                <div id="myTabContent1" class="tab-content padding-10">
                                    <div class="tab-pane fade active in" id="s1">

                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Genel Ayarlar</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Kazı Başkanı</td>
                                                <td style="width: 200px;">
                                                    <label class="input">
                                                        <input name="kazi_baskani" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->kazi_baskani);?>">
                                                    </label>
                                                </td>

                                                <td colspan="2"></td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Varsayılan Tema</td>
                                                <td colspan="3">

                                                    <div class="inline-group" style="margin-top: 5px;">
                                                        <label class="radio">
                                                            <input name="tema" type="radio" value="default" <?php if($q->tema == 'default'){echo ' checked';}?> >
                                                            <i></i>Default</label>

                                                        <label class="radio">
                                                            <input name="tema" type="radio" value="blue" <?php if($q->tema == 'blue'){echo ' checked';}?>>
                                                            <i></i>Ocean Blue</label>


                                                        <label class="radio">
                                                            <input name="tema" type="radio" value="gray" <?php if($q->tema == 'gray'){echo ' checked';}?>>
                                                            <i></i>Gray</label>

                                                        <label class="radio">
                                                            <input name="tema" type="radio" value="lightgray" <?php if($q->tema == 'lightgray'){echo ' checked';}?>>
                                                            <i></i>Light Gray</label>
                                                    </div>


                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>

                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Anasayfa Görünüm Ayarları</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Mini İstatistik Sayacı</td>
                                                <td colspan="3">
                                                    <div class="inline-group" style="margin-top: 5px;">
                                                        <label class="radio">
                                                            <input name="mod_minist" type="radio" value="1" <?php if($q->mod_minist == 1){echo ' checked';}?>>
                                                            <i></i>Aktif</label>

                                                        <label class="radio">
                                                            <input name="mod_minist" type="radio" value="0" <?php if($q->mod_minist == 0){echo ' checked';}?>>
                                                            <i></i>Pasif</label>
                                                    </div>

                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Genel İstatistik (5)</td>
                                                <td>
                                                    <div class="inline-group" style="margin-top: 5px;">
                                                        <label class="radio">
                                                            <input name="mod_genelst" type="radio" value="1" <?php if($q->mod_genelst == 1){echo ' checked';}?>>
                                                            <i></i>Aktif</label>

                                                        <label class="radio">
                                                            <input name="mod_genelst" type="radio" value="0" <?php if($q->mod_genelst == 0){echo ' checked';}?>>
                                                            <i></i>Pasif</label>
                                                    </div>
                                                </td>

                                                <td colspan="2" class="buluntu_select" style="min-width: 200px; max-width: 450px;">
                                                    <select name="genelst_bk_id[]" class="select2 " multiple style="width: 100%;">
                                                        <?php echo $genelst;?>
                                                    </select>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Buluntu İstatistikleri</td>
                                                <td>
                                                    <div class="inline-group" style="margin-top: 5px;">
                                                        <label class="radio">
                                                            <input name="mod_buluntust" type="radio" value="1" <?php if($q->mod_buluntust == 1){echo ' checked';}?>>
                                                            <i></i>Aktif</label>

                                                        <label class="radio">
                                                            <input name="mod_buluntust" type="radio" value="0" <?php if($q->mod_buluntust == 0){echo ' checked';}?>>
                                                            <i></i>Pasif</label>
                                                    </div>
                                                </td>

                                                <td colspan="2" class="buluntu_select2" style="min-width: 200px; max-width: 450px;">
                                                    <select name="buluntust_bk_id[]" class="select2 " multiple style="width: 100%;">
                                                        <?php echo $buluntust;?>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Hareketler Panosu</td>
                                                <td colspan="3">
                                                    <div class="inline-group" style="margin-top: 5px;">
                                                        <label class="radio">
                                                            <input name="mod_pano" type="radio" value="1" <?php if($q->mod_pano == 1){echo ' checked';}?>>
                                                            <i></i>Aktif</label>

                                                        <label class="radio">
                                                            <input name="mod_pano" type="radio" value="0" <?php if($q->mod_pano == 0){echo ' checked';}?>>
                                                            <i></i>Pasif</label>
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
                                <a href="index/anasayfa" type="button" class="ajax btn btn-default"
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
</section>

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=5"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>

<script type="text/javascript">

    $(document).ready(function () {

        form = robo.form;
        form.url = 'post/update/genel_ayarlar/1';
        form.validate = true;
        //form.updatefunc = 'rapor/yenile';

        form.use.select2();

        robo.data.load('buluntu', '.buluntu_select','open');
        robo.data.load('buluntu', '.buluntu_select2','open');

        //drawBreadCrumb(["Düzenle"]);

    });

</script>