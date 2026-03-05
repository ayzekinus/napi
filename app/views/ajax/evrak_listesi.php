<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }



    .jarviswidget header:first-child .nav-tabs li a {
        color: #ccc !important;
    }


    .jarviswidget header:first-child .nav-tabs li a:hover {
        color: #383838 !important;
    }

    .jarviswidget header .nav-tabs>li.active>a, .jarviswidget header .nav-tabs>li.active>a:focus, .jarviswidget header .nav-tabs>li.active>a:hover {
        color: #383838 !important;
        background-color: #fafafa !important;
        border: 1px solid #C2C2C2;
        border-bottom-color: transparent;
        border-top: none;
        cursor: default;
    }


</style>



<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-envelope"></i> </span>
                    <h2>Evrak Listesi </h2>



                    <ul id="widget-tab-1" class="nav nav-tabs pull-right">

                        <li <?php if($evrak_tipi == 'gelen'){echo 'class="active"';}?>>

                            <a class="ajax" href="index/evrak_listesi/gelen"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> Gelen </span> </a>

                        </li>

                        <li <?php if($evrak_tipi == 'giden'){echo 'class="active"';}?>>
                            <a class="ajax" href="index/evrak_listesi/giden"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> Giden </span></a>
                        </li>

                        <li <?php if($evrak_tipi == 'tutanaklar'){echo 'class="active"';}?>>
                            <a class="ajax" href="index/evrak_listesi/tutanaklar"> <i class="fa fa-lg fa-file-text-o"></i> <span class="hidden-mobile hidden-tablet"> Tutanaklar </span></a>
                        </li>

                        <li <?php if($evrak_tipi == 'favori'){echo 'class="active"';}?>>
                            <a class="ajax" href="index/evrak_listesi/favori"> <i class="fa fa-lg  fa-star"></i> <span class="hidden-mobile hidden-tablet"> Hızlı Erişim </span></a>
                        </li>

                    </ul>

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


                                <a href="index/evrak_ekle"  class="btn btn-labeled btn-info ajax btnolusturmodal btnsec"> <span class="btn-label"><i class="fa fa-plus"></i></span>Oluştur </a>
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

                                <th class="hasinput" style="width:400px !important;">
                                    <input type="text" class="form-control column_filter" placeholder="Evrak Konusu" data-column="1" tabindex="1"/>
                                </th>

                                <th class="hasinput" style="width:500px">
                                    <input type="text" class="form-control column_filter" placeholder="İlgili Kurum" data-column="2" tabindex="2"/>
                                </th>


                                <th class="hasinput" style="width:260px">
                                    <input type="text" class="form-control column_filter" placeholder="Evrak Sayı" data-column="3" tabindex="3"/>
                                </th>


                                <th class="hasinput" style="width:120px">
                                    <input type="text" class="form-control column_filter" placeholder="Evrak No" data-column="4" tabindex="4"/>
                                </th>

                                <th class="hasinput" style="width:140px">
                                    <input type="text" class="form-control column_filter" placeholder="Evrak Tarihi" data-column="5" tabindex="5"/>
                                </th>


                                <th class="hasinput" style="width:200px">
                                    <input type="text" class="form-control column_filter" placeholder="Kayıt Tarihi" data-column="6" tabindex="6"/>
                                </th>


                                <th class="hasinput" style="width:130px">

                                    <select name="evrak_oncelik" class="select2 column_filter" style="width: 130px;" data-column="7" tabindex="7">
                                        <option value="Tümü">TÜMÜ</option>

                                        <option value="Düşük">Düşük</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Yüksek">Yüksek</option>

                                    </select>

                                </th>

                                <?php if($evrak_tipi == 'favori'){?>
                                <th class="hasinput" style="width:130px">

                                    <select name="evrak_tipi" class="select2 column_filter" style="width: 130px;" data-column="8" tabindex="8">
                                        <option value="Tümü">TÜMÜ</option>

                                        <option value="Gelen">Gelen</option>
                                        <option value="Giden">Giden</option>

                                    </select>

                                </th>

                                <?php } ?>

                            </tr>

                            <tr>

                                <th data-hide="phone" style="width: 25px;">ID</th>
                                <th data-class="expand" style="width: 100px;"> Evrak Konusu</th>
                                <th data-class="expand" style="width: 260px;">İlgili Kurum</th>
                                <th data-class="expand" style="width: 120px;"> Evrak Sayı</th>
                                <th data-class="expand" style="width: 150px;"> Evrak No</th>
                                <th data-class="expand" style="width: 150px;"> Evrak Tarihi</th>
                                <th data-class="expand" style="width: 130px;"> Kayıt Tarihi</th>
                                <th data-class="expand" style="width: 140px;"> Öncelik</th>

                                <?php if($evrak_tipi == 'favori'){?>
                                    <th data-class="expand" style="width: 140px;"> Evrak Tipi</th>
                                <?php } ?>


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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=21"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.list.js?v=2"></script>


<script type="text/javascript">

    $(document).ready(function() {
        //$.fn.dataTable.moment("DD-MM-YYYY HH:mm");
        dt = robo.datatable;

        dt.source = jsPath + 'index/evrak_listesi_data/<?php echo $evrak_tipi;?>';
        dt.table_name = 'evrak';
        dt.btn_edit = 'evrak_duzenle';
        dt.btn_detail = 'evrak_detay';

        dt.run("#dt_basic");
            
        dt.visible(0);


        <?php if($evrak_tipi !== 'gelen'){?>

            drawBreadCrumb(["Evrak Yönetimi", "Listele"]);

        <?php }?>

    });

</script>

