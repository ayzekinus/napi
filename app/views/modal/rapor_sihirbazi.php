<script type="text/javascript" src="<?php echo Url::base();?>assets/js/fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="<?php echo Url::base();?>assets/js/fusioncharts/themes/fusioncharts.theme.fint.js"></script>

<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                    <h2><strong>Rapor</strong> <i>Sihirbazı</i></h2>

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
                                        <a href="#s1" data-toggle="tab">Rapor Kriterleri </a>
                                    </li>
                                </ul>

                                <div id="myTabContent1" class="tab-content padding-10">
                                    <div class="tab-pane fade active in" id="s1">


                                        <table class="table table-bordered table-striped table-condensed table-hover">


                                            <thead>
                                            <tr>
                                                <th colspan="4">Rapor Kriterleri</th>
                                            </tr>
                                            </thead>

                                            <tbody>



                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yeri </td>

                                                <td class="buluntu_select" style="width: 350px;">
                                                    <select name="bk_buluntuyeri_id[]" class="select2 " multiple style="width: 100%;">
                                                    </select>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Buluntu Yılı </td>
                                                <td>


                                                    <label class="input" style="width: 48%; float: left;margin-right: 4%;">
                                                        <input name="buluntu_yili_ilk" class="mask_yil" type="text" placeholder="" value="" >
                                                    </label>


                                                    <label class="input" style="width: 48%;float:left;">
                                                        <input name="buluntu_yili_son" type="text" placeholder="" class="mask_yil" value="<?php echo date('Y');?>" >
                                                    </label>
                                                </td>



                                            </tr>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Üretim Yeri</td>

                                                <td class="uretimyeri_select">
                                                    <select name="bk_uretimyeri_id[]" class="select2" multiple style="width: 100%;">
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Dönem</td>
                                                <td class="donem_select">
                                                    <select name="bk_donem_id[]" class="select2 " multiple style="width: 100%;">
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Form/Obje </td>

                                                <td class="formobje_select">
                                                    <select name="bk_formobje_id[]" class="select2 " multiple style="width: 100%;">
                                                    </select>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Yapım Malzemesi </td>
                                                <td class="yapimmalzemesi_select">
                                                    <select name="bk_yapim_mlz_id[]" class="select2 " multiple style="width: 100%;">
                                                    </select>
                                                </td>

                                            </tr>


                                            <tr>


                                                <td style="width: 150px;vertical-align:middle;">Tip</td>

                                                <td class="tip_select">
                                                    <select name="bk_tip_id[]" class="select2" multiple style="width: 100%;">

                                                    </select>
                                                </td>

                                                <td colspan="2"></td>


                                            </tr>


                                            </tbody>
                                        </table>


                                        <br>

                                        <table class="table table-bordered table-striped table-condensed table-hover">


                                            <thead>
                                            <tr>
                                                <th colspan="4">Grafik Seçenekleri</th>
                                            </tr>
                                            </thead>

                                            <tbody>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Grafik Tipi</td>

                                                <td style="vertical-align:middle;" colspan="3" >

                                                    <div class="inline-group" style="float: left;padding-top: 5px;">


                                                        <label class="radio" >
                                                            <input type="radio" name="grafik_tipi" value="pie3d" checked="checked">
                                                            <i></i>Pie</label>

                                                        <label class="radio">
                                                            <input type="radio" name="grafik_tipi" value="doughnut3d">
                                                            <i></i>Donut</label>


                                                        <label class="radio" >
                                                            <input type="radio" name="grafik_tipi" value="column3d">
                                                            <i></i>Column</label>

                                                        <label class="radio" >
                                                            <input type="radio" name="grafik_tipi" value="bar3d">
                                                            <i></i>Bar</label>


                                                    </div>


                                                    <button type="button" class="btn btn-info btnraporolustur" style="float: right;">
                                                        <i class="fa fa-bolt"></i> Oluştur
                                                    </button>

                                                </td>



                                            </tr>



                                            </tbody>

                                        </table>

                                        <br>


                                        <table class="table table-bordered table-striped table-condensed table-hover">


                                            <thead>
                                            <tr>
                                                <th colspan="4">Rapor Sonucu</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td colspan="4" style="background: white !important;">

                                                    <div class="row rapor_grafik">


                                                    </div>

                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                            <footer>
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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=4"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>


<script type="text/javascript">

    $(document).ready(function () {


        $(".btnraporolustur").on('click', function(){

            $.post(jsPath + 'index/rapor_olustur', $("#formk").serialize(), function(data){

                $(".rapor_grafik").html(data);

            });

            return false;
        });




        form = robo.form;
        form.url = "index/rapor_olustur";
        form.validate = true;

        form.use.select2();

        robo.data.load('anakod', '.anakod_select','search');

        robo.data.load('buluntu', '.buluntu_select','open');
        robo.data.load('formobje', '.formobje_select','open');
        robo.data.load('yapim_malzemesi', '.yapimmalzemesi_select','open');
        robo.data.load('uretim_yeri', '.uretimyeri_select','open');
        robo.data.load('donem', '.donem_select','open');
        robo.data.load('tip', '.tip_select','open');


        $(".mask_yil").TouchSpin({
            min: 1900,
            max: year,
            verticalbuttons: true
        });

    });

</script>