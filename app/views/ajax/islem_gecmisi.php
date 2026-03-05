<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }

    #dt_basic2_wrapper .dt-toolbar{margin:0px !important; padding: 0px !important; height: 0px !important;}

    #dt_basic2_wrapper .dt-toolbar .ColVis{ display: none !important; }

</style>


<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-star"></i> </span>
                    <h2>İşlem Geçmişi </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body no-padding" >
                        <table id="dt_basic2" class="table table-striped table-bordered table-hover" width="100%" >

                            <thead>

                            <tr class="gelismis_arama">
                                <th class="hasinput" style="width: 100px">
                                    <input type="text" class="form-control column_filter" placeholder="ID" data-column="0" tabindex="0"/>
                                </th>


                                <th class="hasinput" style="width:700px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Kayıt" data-column="1" tabindex="1"/>
                                </th>

                                <th class="hasinput" style="width:165px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Kayıt Tipi" data-column="2" tabindex="2"/>
                                </th>

                                <th class="hasinput" style="width:70px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="İşlem Tipi" data-column="3" tabindex="3"/>
                                </th>

                                <th class="hasinput" style="width:170px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Kullanıcı" data-column="4" tabindex="4"/>
                                </th>

                                <th class="hasinput" style="width:130px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Tarih" data-column="5" tabindex="5"/>
                                </th>

                            </tr>

                            <tr>
                                <th data-hide="phone" style="">ID</th>
                                <th data-class="expand" style="width: 800px;">Kayıt</th>
                                <th data-class="expand" style="width: 155px;">Kayıt Tipi</th>
                                <th data-class="expand" style="width: 70px;">İşlem Tipi</th>
                                <th data-class="expand" style="width: 110px;">Kullanıcı</th>
                                <th data-class="expand" style="width: 130px;"> Tarih</th>

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

        dt.source = jsPath + 'index/islem_gecmisi_data';
        dt.table_name = 'islem_gecmisi';
        dt.btn_edit = '';
        dt.btn_detail = '';

        dt.run("#dt_basic2");

        //dt.visible(0);

    });

</script>

