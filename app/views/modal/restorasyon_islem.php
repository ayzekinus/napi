<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                    <h2><strong>Restorasyon</strong> <i>Formu</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/buluntu_restorasyon" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
                </header>

                <!-- widget div-->
                <div>


                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form id="formk" action="" class="smart-form">

                            <input type="hidden" name="token" value="<?php echo $token;?>">
                            <input type="hidden" name="rest_bk_id" value="<?php echo $id;?>">
                            <input type="hidden" name="sezon" value="<?php echo date('Y');?>">
                            <input type="hidden" name="tip" value="<?php echo $form_tip;?>">
                            <input type="hidden" name="islem" value="<?php echo $islem;?>">

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

                                                <td style="width: 150px;vertical-align:middle;">Anakod</td>

                                                <td>
                                                    <label class="input">
                                                        <input name="anakod" type="text" placeholder="" class="ignore" value="<?php echo $qq->anakod;?>" disabled>
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu No </td>
                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_no" type="text" placeholder="" class="ignore" value="<?php echo $qq->buluntu_no;?>" disabled>
                                                    </label>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Obje Türü </td>
                                                <td>
                                                    <label class="input">
                                                        <input name="obje_turu" type="text" placeholder="" class="ignore" value="<?php echo $qq->form_obje;?>" disabled>
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Materyal </td>

                                                <td>
                                                    <label class="input">
                                                        <input name="materyal" type="text" placeholder="" class="ignore" value="<?php echo $qq->yapim_malzemesi;?>" disabled>
                                                    </label>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="vertical-align:middle;">Kazı Envanter No</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="kazienv_no" type="text" placeholder="" class="ignore" value="<?php echo $qq->kazienv_no;?>" disabled>
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;width: 150px;">Uygulayan <i class="fa fa-asterisk reqicon"></i></td>
                                                <td >
                                                    <label class="input">
                                                        <input name="uygulayan" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->uygulayan);?>">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>

                                                <td style="vertical-align:middle;width: 150px;">Konservatör <i class="fa fa-asterisk reqicon"></i></td>
                                                <td >
                                                    <label class="input">
                                                        <input name="konservator" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->konservator);?>">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;width: 150px;">Bakanlık Temsilcisi <i class="fa fa-asterisk reqicon"></i></td>
                                                <td >
                                                    <label class="input">
                                                        <input name="temsilci" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->temsilci);?>">
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
                                                        <textarea name="mevcut_durum" id="editor"><?php echo stripslashes($q->mevcut_durum);?></textarea>
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
                                                        <textarea name="uygulanan_islemler" id="editor2"><?php echo stripslashes($q->uygulanan_islemler);?></textarea>
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
                                                        <textarea name="kullanilan_malzeme" id="editor3"><?php echo stripslashes($q->kullanilan_malzeme);?></textarea>
                                                    </label>
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
                                <a href="index/buluntu_restorasyon" type="button" class="ajax btn btn-default"
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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=4"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>

<script type="text/javascript">

    $(document).ready(function () {

        form = robo.form;
        form.url = "post/insert/restorasyon";
        form.validate = true;

        form.use.ckeditor('editor');
        form.use.ckeditor('editor2');
        form.use.ckeditor('editor3');

        drawBreadCrumb(["Buluntu", "Restorasyon"]);
        $(".menu_buluntu").addClass("active");

    });

</script>