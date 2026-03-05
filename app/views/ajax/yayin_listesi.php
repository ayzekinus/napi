<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }


</style>



<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
                    <h2>Yayın Listesi </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body no-padding" >

                        <div class="toolbox">

                            <div class="butonlar" style="width: 440px; float: right;margin: 13px 0 0 0;">
                                <a href="#" class="btnyaz" style="display:none;"></a>
                                <div clasS="btn-group">
                                    <a href="javascript:void(0);"  class="btn btn-labeled bg-color-blueLight txt-color-white btnyazdir"> <span class="btn-label"><i class="fa fa-print"></i></span>Yazdır </a>
                                    <a class="btn bg-color-blueLight txt-color-white dropdown-toggle" style="margin-left: -3px;border-left: 1px solid grey;" data-toggle="dropdown" href="javascript:void(0);"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0);">Excel olarak indir</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Csv olarak indir</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Pdf olarak indir</a>
                                        </li>
                                    </ul>
                                </div>


                                <a href="index/yayin_ekle"  class="btn btn-labeled btn-info ajax btnolusturmodal btnsec"> <span class="btn-label"><i class="fa fa-plus"></i></span>Oluştur </a>
                                <a href="#"  class="btn btn-labeled btn-primary btnduzenlemodal btnsec" > <span class="btn-label"><i class="fa fa-pencil"></i></span>Düzenle </a>
                                <a href="#" class="btn btn-labeled btn-danger btnsil btnsec"> <span class="btn-label"><i class="fa fa-trash"></i></span>Sil </a>
                            </div>
                        </div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%" >

                            <thead>

                            <tr class="gelismis_arama">
                                <th class="hasinput" style="width:100px">
                                    <input type="text" class="form-control column_filter" placeholder="ID" data-column="0" tabindex="0"/>
                                </th>


                                <th class="hasinput" style="width:900px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Eser Adı" data-column="1" tabindex="1"/>
                                </th>

                                <th class="hasinput" style="width:400px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Yazarı" data-column="2" tabindex="2"/>
                                </th>

                                <th class="hasinput" style="width:150px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Yılı" data-column="3" tabindex="3"/>
                                </th>
                                <th class="hasinput" style="width:150px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Yayin Yeri" data-column="3" tabindex="3"/>
                                </th>


                                <th class="hasinput" style="width:200px">
                                    <select name="yayin_kategorisi" class="select2" style="width: 100%;" placeholder="Kategorisi" data-column="4" tabindex="4">
                                        <option value="Tümü">TÜMÜ</option>

                                        <?php foreach($kategoriler as $k){
                                            echo '<option value="'.$k->list_adi.'">'.$k->list_adi.'</option>';
                                        }?>

                                    </select>
                                </th>


                            </tr>

                            <tr>

                                <th data-hide="phone" style="width: 25px;">ID</th>
                                <th data-class="expand" style="width: 900px;"> Eser Adı</th>
                                <th data-class="expand" style="width: 400px;"> Yazarı</th>
                                <th data-class="expand" style="width: 150px;"> Yılı</th>
                                <th data-class="expand" style="width: 200px;"> Yayin Yeri</th>
                                <th data-class="expand" style="width: 200px;"> Kategorisi</th>
                                
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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=114"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.list.js?v=222"></script>

<script type="text/javascript">

    $(document).ready(function() {

        dt = robo.datatable;

        dt.source = jsPath + 'index/yayin_listesi_data';
        dt.table_name = 'yayinlar';
        dt.btn_edit = 'yayin_duzenle';
        dt.btn_detail = 'yayin_detay';
        dt.popup_print = false;

        dt.run("#dt_basic");

        dt.visible(0);

    });

</script>

