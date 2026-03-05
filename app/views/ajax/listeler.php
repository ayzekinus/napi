<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }


    #dt_basic_wrapper .dt-toolbar{ display: none !important; }
    .widget-body .toolbox{width: 100% !important;}



</style>

<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Listeler </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body no-padding" >
                        <div class="toolbox" style="padding: 10px;height: 50px;background: #fafafa !important;">

                            <form id="formk" name="formk">

                                <div style="width: 250px;float:left;margin:0px 0 0 0px;float: left;">
                                    <label>
                                        <input name="list_adi" type="text" class="required"
                                               placeholder="Liste Adı"
                                               style="text-align: center; width: 250px;height: 32px;">
                                        <input type="hidden" name="list_id" value="0"/>
                                        <input type="hidden" name="token" value="<?php echo $token;?>"/>
                                    </label>
                                </div>

                                <div style="150px; height: 32px;float:left;margin-left: 15px;">
                                    <select name="form" class="form_select" style="width: 150px;" placeholder="Form Seçiniz">
                                        <option value=""></option>
                                        <option value="">Form Seçiniz</option>
                                        <option value="Metal">Metal</option>
                                        <option value="Taş">Taş</option>
                                        <option value="Kemik">Kemik</option>
                                        <option value="Cam">Cam</option>
                                        <option value="Seramik">Seramik</option>
                                        <option value="Sikke">Sikke</option>
                                    </select>
                                </div>

                                <div style="150px; height: 32px;float:left;margin-left: 15px;">
                                    <select name="tip" class="required tip_select" style="width: 150px;" placeholder="Liste Türü Seçiniz">
                                        <option value=""></option>
                                        <optgroup label="Buluntu Listeleri">
                                            <option value="1">Buluntu Yeri</option>
                                            <option value="2">Form Obje</option>
                                            <option value="3">Yapım Malzemesi</option>
                                            <option value="4">Tip</option>
                                            <option value="5">Üretim Yeri</option>
                                            <option value="6">Dönem</option>
                                            <option value="7">Renk</option>
                                        </optgroup>
                                        <optgroup label="Diğer Listeler">
                                            <option value="8">Yayın Kategorisi</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="butonlar"
                                     style="width: 165px; float: left;margin: 0px 0 0 15px;">
                                    <a href="#"
                                       class="btn btn-labeled btn-info btnlisteolustur"
                                       style="float: left;"> <span class="btn-label"><i
                                                class="fa fa-plus"></i></span>Oluştur </a>

                                    <a href="#"
                                       class="btn btn-labeled btn-info btnlistekaydet"
                                       style="float: left;display: none;"> <span class="btn-label"><i
                                                class="fa fa-save"></i></span>Kaydet </a>


                                    <a href="#" style="margin-left: 10px;display:none;"
                                       class="btn bg-color-blueLight txt-color-white btnlisteback"><i
                                            class="fa fa-history fa-lg"></i></a>
                                </div>

                            </form>


                        </div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%" >

                            <thead>

                            <tr class="gelismis_arama">
                                <th class="hasinput" style="width:25px; text-align:center;justify-content: center;">
                                    #
                                </th>

                                <th class="hasinput" style="">
                                    <input type="text" class="form-control column_filter" placeholder="Liste Adı" data-column="1" tabindex="1"/>
                                </th>


                                <th class="hasinput" style="width: 150px;">
                                    <input type="text" class="form-control column_filter" placeholder="Form Tanımı" data-column="2" tabindex="2"/>
                                </th>

                                <th class="hasinput" style="width:150px">
                                    <select name="rapor_tipi" class="select2" style="width: 100%" data-column="3" tabindex="3">
                                        <option value="Tümü">TÜMÜ</option>

                                        <option value="Buluntu Yeri">Buluntu Yeri</option>
                                        <option value="Form Obje">Form Obje</option>
                                        <option value="Yapım Malzemesi">Yapım Malzemesi</option>
                                        <option value="Tip">Tip</option>
                                        <option value="Üretim Yeri">Üretim Yeri</option>
                                        <option value="Dönem">Dönem</option>
                                        <option value="Renk">Renk</option>

                                        <option value="Yayın Kategorisi">Yayın Kategorisi</option>

                                    </select>
                                </th>

                            </tr>

                            <tr>

                                <th data-hide="phone" style="width: 25px;">ID</th>
                                <th data-class="expand" style="width: 100px;"> Liste Adı</th>
                                <th data-class="expand" style="width: 150px;"> Form Tanımı</th>
                                <th data-class="expand" style="width: 100px;"> Liste Türü</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </article>

    </div>

    <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: none !important;">

            </div>
        </div>
    </div>
</section>

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=5"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.list.js?v=4"></script>

<script type="text/javascript">

    $(document).ready(function() {

        dt = robo.datatable;

        dt.source = jsPath + 'index/listeler_data';
        dt.table_name = 'listeler';
        dt.btn_edit = 'liste_duzenle';
        dt.btn_detail = 'liste_detay';
        dt.sorting = 'asc';
        dt.popup_print = false;
        dt.popup_detail = false;

        dt.run("#dt_basic");

        form = robo.form;
        form.url = "post/insert/listeler";
        form.validate = true;

        $(".tip_select").select2();
        $(".form_select").select2();

        $(".btnlisteolustur").on('click', function(){
            form.submit("#formk");

            setTimeout(function(){
                $("input[name=list_adi]").val("");
                dt.refresh();
            },200);

            return false;
        });

        $(".btnlistekaydet").on('click', function(){
            form.submit("#formk");

            setTimeout(function(){
                $("input[name=list_adi]").val("");
                $("input[name=list_id]").val("0");
                $(".tip_select").val("").trigger('change');
                $(".form_select").val("").trigger('change');

                $(".btnlistekaydet").hide();
                $(".btnlisteback").hide();
                $(".btnlisteolustur").show();

                dt.refresh();
            },200);

            return false;
        });

        $(".btnlisteback").on('click', function () {

            setTimeout(function(){
                $("input[name=list_adi]").val("");
                $("input[name=list_id]").val("0");

                $(".tip_select").val("").trigger('change');
                $(".form_select").val("").trigger('change');

                $(".btnlistekaydet").hide();
                $(".btnlisteback").hide();
                $(".btnlisteolustur").show();

            },200);

            return false;
        });


    });

</script>

