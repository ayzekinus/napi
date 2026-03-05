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
                    <h2><strong>Evrak</strong> <i>Oluştur</i></h2>

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
                                                <td style="width: 150px;vertical-align:middle;">Evrak Tipi</td>

                                                <td style="vertical-align:middle;" >

                                                    <div class="inline-group">
                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_tipi" checked="checked" value="Gelen">
                                                            <i></i>Gelen</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_tipi" value="Giden">
                                                            <i></i>Giden</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_tipi" value="Tutanaklar">
                                                            <i></i>Tutanaklar</label>
                                                    </div>

                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Öncelik</td>

                                                <td style="vertical-align:middle;">

                                                    <div class="inline-group">

                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_oncelik" value="Düşük">
                                                            <i></i>Düşük</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_oncelik" checked="checked" value="Normal">
                                                            <i></i>Normal</label>

                                                        <label class="radio" >
                                                            <input type="radio" name="evrak_oncelik" value="Yüksek">
                                                            <i></i>Yüksek</label>
                                                    </div>

                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Evrak No / Tarihi</td>
                                                <td>
                                                    <label class="input" style="width: 48%; float: left;margin-right: 4%;">
                                                        <input name="evrak_no" class="mask_number" type="text" placeholder="" value="" >
                                                    </label>

                                                    <label class="input" style="width: 48%;float:left;">
                                                        <input name="evrak_tarihi" type="text" placeholder="" class="datepicker" value="<?php echo date('d.m.Y');?>" >
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Evrak Sayı</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="evrak_sayi" type="text" placeholder="" value="">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">İlgili Kurum <i class="fa fa-asterisk reqicon"></i></td>
                                                <td >
                                                    <label class="input">
                                                        <input name="evrak_kurum" type="text" placeholder="" class="required">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">İlgili Birim</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="ilgili_birim" type="text" placeholder="">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Evrak Konusu <i class="fa fa-asterisk reqicon"></i></td>
                                                <td colspan="3">
                                                    <label class="input">
                                                        <input name="evrak_konusu" type="text" placeholder="" class="required">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>

                                                <td style="vertical-align:middle;">Kayıt Tarihi</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="kayit_tarihi" type="text" class="datepicker" placeholder="" value="<?php echo date('d.m.Y, g:i');?>">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Hızlı Erişim</td>

                                                <td style="vertical-align:middle;" >

                                                    <div class="inline-group">
                                                        <label class="radio" >
                                                            <input type="radio" name="favori" value="1">
                                                            <i></i>Evet</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="favori" value="0" checked="checked">
                                                            <i></i>Hayır</label>


                                                </td>

                                    </div>


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
                                                    <textarea name="aciklama" id="editor"></textarea>
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
                                                    <a href="index/evrak_yukle" data-target="#remoteModal"
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
                                <a href="index/evrak_listesi/gelen" type="button" class="ajax btn btn-default"
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
        form.url = "post/insert/evrak_yonetimi";
        form.validate = true;

        form.use.select2();
        form.use.datepicker();
        form.use.ckeditor('editor');


        $(".gorsel_div").on('click','.alt_gorsel img',function(){

            var name = $(this).attr("data-name");
            var url = '<?php echo Url::base("uploads/docs/");?>' + name;

            forceDownload(url,name);

            return false;
        });


    });

</script>