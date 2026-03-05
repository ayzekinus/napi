<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                    <h2><strong>Anakod</strong> <i>Düzenle</i> ~ <?php echo stripslashes($q->anakod);?></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/anakod_listesi" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
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

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yeri <i class="fa fa-asterisk reqicon"></i></td>

                                                <td class="buluntu_select">
                                                    <select name="anakod_buluntuyeri_id" class="select2 required" style="width: 100%;">
                                                        <?php  if($q->anakod_buluntuyeri_id > 0) echo '<option value="'.$q->anakod_buluntuyeri_id.'" selected>'.$lb_buluntu_yeri->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yılı <i class="fa fa-asterisk reqicon"></i></td>
                                                <td>
                                                    <label class="input">
                                                        <input name="buluntu_yili" type="text" placeholder="" class="mask_yil required" value="<?php echo stripslashes($q->buluntu_yili);?>">
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

                                            </tbody>
                                        </table>


                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Açıklama <i class="fa fa-asterisk reqicon"></i></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <label class="textarea">
                                                        <textarea name="aciklama" class="required" id="editor"><?php echo stripslashes($q->aciklama);?></textarea>
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
                                <a href="index/anakod_listesi" type="button" class="ajax btn btn-default"
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
        form.url = 'post/update/anakod/<?php echo $q->anakod_id;?>';
        form.validate = true;

        form.use.select2();
        form.use.ckeditor('editor');

        robo.data.load('buluntu', '.buluntu_select','open');

        $("input[name='buluntu_yili']").TouchSpin({
            min: 1900,
            max: year,
            initval: year,
            verticalbuttons: true
        });

        $(".menu_anakod").addClass("active");
        drawBreadCrumb(["Düzenle"]);

    });

</script>