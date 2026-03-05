
<style type="text/css">

    #dt_basic_wrapper .dt-toolbar{ display: none !important; }
    .widget-body .toolbox{width: 100% !important;}

</style>

<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                    <h2>Kullanıcılar </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body no-padding" >

                        <div class="toolbox">
                            <div class="dataTables_filter" style="width: 265px;float:left;margin:13px 0 0 0px;" >
                                <label>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> 
                                    <input type="search" class="form-control dt_arama" placeholder="" aria-controls="dt_basic" style="width: 220px;">
                                </label>
                            </div>


                            <div class="butonlar" style="width: 310px; float: right;margin: 13px 0 0 0;">
                                <a href="index/kullanici_ekle"  class="btn btn-labeled btn-info ajax btnsec"> <span class="btn-label"><i class="fa fa-plus"></i></span>Oluştur </a>
                                <a href="#"  class="btn btn-labeled btn-primary btnduzenlemodal btnsec"> <span class="btn-label"><i class="fa fa-pencil"></i></span>Düzenle </a>
                                <a href="#" class="btn btn-labeled btn-danger btnsil btnsec"> <span class="btn-label"><i class="fa fa-trash"></i></span>Sil </a>
                            </div>
                        </div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%" >

                            <thead>			                
                                <tr>
                                    <th data-hide="phone" style="width: 25px;">ID</th>
                                    <th data-hide="expand" >Ad Soyad</th>
                                    <th data-class="expand" style="width: 120px;"> Kullanıcı ID</th>

                                    <th data-class="expand" style="width: 60px;"> Sistemde</th>
                                    <th data-class="expand" style="width: 200px;"> Geçen Süre</th>

                                    <th data-class="expand" style="width: 140px;"> Oluşturulma Tarihi</th>
                                    <th data-class="expand" style="width: 120px;"> Yetki</th>

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

    $(document).ready(function() {

        dt = robo.datatable;

        dt.source = jsPath + 'index/kullanicilar_data';
        dt.table_name = 'kullanici';
        dt.btn_edit = 'kullanici_duzenle';
        dt.btn_detail = 'kullanici_detay';
        dt.popup_print = false;
        dt.display_length = 50;

        dt.run("#dt_basic");

        //dt.visible(0);

    });

</script>