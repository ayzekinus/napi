<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }

    #dt_basic > tbody > tr.even.row_selected_envanterlik td { background-color: #FCF9EA ; }
    #dt_basic > tbody > tr.odd.row_selected_envanterlik td { background-color: #FCF9EA; }

</style>

<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Envanterlik Eserler </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body no-padding" >

                        <div class="toolbox">

                            <div class="butonlar" style="width: 575px; float: right;margin: 13px 0 0 0;">
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


                                <div clasS="btn-group">
                                    <a href="javascript:void(0);"  class="btn btn-labeled bg-color-blueDark txt-color-white"> <span class="btn-label"><i class="fa fa-share-alt"></i></span>İşlemler </a>
                                    <a class="btn bg-color-blueDark txt-color-white dropdown-toggle" style="margin-left: -3px;border-left: 1px solid grey;" data-toggle="dropdown" href="javascript:void(0);"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="" class="btnenvanterlik" data-id="0"> <i class="fa fa-tags"></i> Envanterlik </a>
                                        </li>

                                        <li>
                                            <a href="" class="btnkonservasyon_islem" style="display:none;"></a>
                                            <a href="#" class=" btnkonservasyon" data-id="0"> <i class="fa fa-file-text"></i> Konservasyon </a>
                                        </li>

                                        <li>
                                            <a href="" class="btnrestorasyon_islem" style="display:none;"></a>
                                            <a href="#" class=" btnrestorasyon" data-id="0"> <i class="fa fa-list-alt"></i> Restorasyon </a>
                                        </li>
                                    </ul>
                                </div>

                                <a href="index/buluntu_ekle"  class="btn btn-labeled btn-info ajax btnolusturmodal btnsec"> <span class="btn-label"><i class="fa fa-plus"></i></span>Oluştur </a>
                                <a href="#"  class="btn btn-labeled btn-primary btnduzenlemodal btnsec"> <span class="btn-label"><i class="fa fa-pencil"></i></span>Düzenle </a>
                                <a href="#" class="btn btn-labeled btn-danger btnsil btnsec"> <span class="btn-label"><i class="fa fa-trash"></i></span>Sil </a>
                            </div>
                        </div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%" >

                            <thead>

                            <tr class="gelismis_arama">
                                <th class="hasinput" style="width:120px">
                                    <input type="text" class="form-control column_filter " placeholder="ID" data-column="0" tabindex="0"/>
                                </th>

                                <th class="hasinput" style="width:160px !important;">
                                    <input type="text" class="form-control column_filter anakod_search" placeholder="Anakod" data-column="1" tabindex="1"/>
                                </th>

                                <th class="hasinput" style="width:150px">
                                    <input type="text" class="form-control column_filter" placeholder="Buluntu No" data-column="2" tabindex="2"/>
                                </th>

                                <th class="hasinput" style="width:430px">
                                    <input type="text" class="form-control column_filter" placeholder="Buluntu Yeri" data-column="3" tabindex="3"/>
                                </th>


                                <th class="hasinput" style="width:250px">
                                    <input type="text" class="form-control column_filter" placeholder="Yapım Malzemesi" data-column="4" tabindex="4"/>
                                </th>


                                <th class="hasinput" style="width:250px">
                                    <input type="text" class="form-control column_filter" placeholder="Buluntu Tarihi" data-column="5" tabindex="5"/>
                                </th>

                                <th class="hasinput" style="width:250px">
                                    <input type="text" class="form-control column_filter" placeholder="Dönem" data-column="6" tabindex="6"/>
                                </th>


                                <th class="hasinput" style="width:400px">
                                    <input type="text" class="form-control column_filter" placeholder="Form/Obje" data-column="7" tabindex="7"/>
                                </th>


                                <th class="hasinput" style="width:150px">
                                    <input type="text" class="form-control column_filter" placeholder="Sezon" data-column="8" tabindex="8"/>
                                </th>


                            </tr>

                            <tr>

                                <th data-hide="phone" style="width: 25px;">ID</th>
                                <th data-class="expand" style="width: 160px;"> Anakod</th>
                                <th data-class="expand" style="width: 120px;"> Buluntu No</th>
                                <th data-class="expand" style="width: 430px;"> Buluntu Yeri</th>
                                <th data-class="expand" style="width: 200px;"> Yapım Malzemesi</th>
                                <th data-class="expand" style="width: 250px;"> Buluntu Tarihi</th>
                                <th data-class="expand" style="width: 250px;"> Dönem</th>
                                <th data-class="expand" style="width: 400px;"> Form/Obje</th>
                                <th data-class="expand" style="width: 150px;"> Sezon</th>
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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=4"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.list.js?v=2"></script>

<script type="text/javascript">

    $(document).ready(function(){

        dt = robo.datatable;

        dt.source = jsPath + 'index/buluntu_envanterlik_data';
        dt.table_name = 'buluntu';
        dt.btn_edit = 'buluntu_duzenle';
        dt.btn_detail = 'buluntu_detay';

        dt.run("#dt_basic");

        dt.visible(0);

    });


</script>