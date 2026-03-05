<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
                    <h2><strong>Demirbaş</strong> <i>Oluştur</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/demirbas_listesi" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
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
                                                <th colspan="4">Demirbaş Bilgileri</th>
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
                                                <td style="width: 150px;vertical-align:middle;">Alınış Tarihi <i class="fa fa-asterisk reqicon"></i></td>

                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="alinis_tarihi" type="text" placeholder="Alınış Tarihi" class="required form-control datepicker hasDatepicker" value="<?php echo date('d.m.Y');?>">
                                                    </label>
                                                </td>


                                                <td style="width: 150px;vertical-align:middle;">Alınış Şekli</td>

                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="alinis_sekli" type="text" placeholder="Alınış Şekli" class="form-control" value="">
                                                    </label>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td style="vertical-align:middle;">Bulunduğu Yer <i class="fa fa-asterisk reqicon"></i></td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="bulundugu_yer" type="text" placeholder="" class="required">
                                                    </label>
                                                </td>


                                                <td style="vertical-align:middle;">Zimmetlenen Personel</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="zimmetlenen_personel" type="text" placeholder="">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Marka</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="malzeme_marka" type="text" placeholder="">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Model</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="malzeme_model" type="text" placeholder="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Kdv</td>
                                                <td >
                                                    <select name="kdv" class="select2 kdv" style="width: 100%;">
                                                        <option value=""></option>
                                                        <option value="0">%0 (sıfır)</option>
                                                        <option value="1">%1 (bir)</option>
                                                        <option value="8">%8 (sekiz)</option>
                                                        <option value="18" selected>%18 (onsekiz)</option>
                                                    </select>
                                                </td>


                                                <td colspan="2">
                                                    <div class="inline-group" style="margin-top: 5px;">
                                                        <label class="radio">
                                                            <input name="kdv_tipi" type="radio" value="0" checked class="kdv_tipi ">
                                                            <i></i>Dahil</label>

                                                        <label class="radio">
                                                            <input name="kdv_tipi" type="radio" value="1" class="kdv_tipi">
                                                            <i></i>Hariç</label>
                                                    </div>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>

                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                            <tbody class="demirbas-detay">
                                            <tr>
                                                <th style="width: 521px;text-align: center;">Malzeme Adı <i class="fa fa-asterisk reqicon"></i></th>
                                                <th style="text-align: center;">Miktar <i class="fa fa-asterisk reqicon"></i></th>
                                                <th style="text-align: center;">Birim Fiyat</th>
                                                <th style="text-align: center;">Tutar</th>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label class="input">
                                                        <input class="required" name="malzeme_adi" type="text" placeholder="">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="input">
                                                        <input class="required adet_input" name="miktar" type="text" style="text-align: center;">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="input">
                                                        <input class="required fiyat_input" name="birim_fiyat" type="text" style="text-align: center;">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="input">
                                                        <input class="tutar_input" name="toplam_tutar" type="text" style="text-align: center;">
                                                        <input  name="genel_toplam" type="hidden" value="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr style="background-color: #f9f9f9;">
                                                <td style="text-align: right;font-family: Tahoma,Sans-Serif; font-size: 13px;" colspan="4">
                                                    <div style="font-weight: bold;float: right;width: 210px;"><span style="width: 110px;text-align: left;float:left;">Malzeme Bedeli</span><span style="width: 90px;float: right;" class="mal_dip"></span> </div><br/>
                                                    <div style="font-weight: bold;float: right;width: 210px;"><span style="width: 110px;text-align: left;float:left;" class="kdv_kac">Kdv %</span><span style="width: 90px;float: right;" class="kdv_dip"></span> </div><br/>
                                                    <div style="font-weight: bold;float: right;width: 210px;"><span style="width: 110px;text-align: left;float:left;">G. Toplam</span><span style="width: 90px;float: right;" class="genel_dip"></span> </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <br/>


                                        <table class="table table-bordered table-striped table-condensed table-hover">


                                            <thead>
                                            <tr>
                                                <th colspan="4">Firma Bilgileri</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Firma Adı</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="firma_adi" type="text" placeholder="" class="">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Firma Yetkilisi</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="firma_yetkilisi" type="text" placeholder="" class="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Telefon</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="firma_telefon" type="text" placeholder="" class="">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Faks</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="firma_faks" type="text" placeholder="" class="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">E-Posta</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="firma_eposta" type="text" placeholder="" class="">
                                                    </label>
                                                </td>

                                                <td style="width: 150px;vertical-align:middle;">Adres</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                        <input name="firma_adres" type="text" placeholder="" class="">
                                                    </label>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Özel Not</td>
                                                <td colspan="3">
                                                    <label class="input">
                                                        <input name="firma_not" type="text" placeholder="Firmaya özel not girebilirsiniz." class="">
                                                    </label>
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>


                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Açıklama & Özel Notlar</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <label class="textarea">
                                                        <textarea name="aciklama" id="editor"></textarea>
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
                                <a href="index/demirbas_listesi" type="button" class="ajax btn btn-default"
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
        form.url = "post/insert/demirbas_listesi";
        form.validate = true;

        form.use.select2();
        form.use.datepicker();
        form.use.ckeditor('editor');

        $("input[name='miktar']").TouchSpin({
            min: 1,
            max: 99999,
            initval: 1,
            verticalbuttons: true
        });


        $(".demirbas-detay").on('keyup','.fiyat_input',function(){
            kdv_hesapla($(this));
            dip_toplam();

            return false;
        });

        $(".demirbas-detay").on('change','.adet_input',function(){

            $(".fiyat_input").each(function(){
                kdv_hesapla($(this));
            });

            dip_toplam();

            return false;
        });

        $(".demirbas-detay").on('keypress','.fiyat_input, .adet_input',function(e) {
            //44 virgul
            //46 nokta
            if ((e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) && (e.which != 44 && e.which != 46)) {
                return false;
            }
        });

        $(".demirbas-detay").on('keypress','.tutar_input',function(e) {
            return false;
        });

        $(".kdv").change(function(){
            $(".fiyat_input").each(function(){
                kdv_hesapla($(this));
            });

            dip_toplam();
            return false;
        });

        $(".kdv_tipi:radio").on('click',function(){
            $(".fiyat_input").each(function(i,item){
                kdv_hesapla($(this));
            });

            dip_toplam();
        });

    });


    function kdv_hesapla(deger){
        var fiyat = $(deger).val();
        var adet = $(".adet_input").val();

        var kdv = $(".kdv :selected").val();
        var kdv_tipi = $("input[name=kdv_tipi]:checked").val();//0 dahil 1 haric

        var tutar = parseFloat(parseInt(adet) *  parseFloat(fiyat.replace(",",".")));

        if(kdv_tipi == 0){
            var kdv_hesap = parseFloat(tutar) / (1 + parseFloat(kdv) / 100);
            kdv_hesap = parseFloat(kdv_hesap).toFixed(2);
            tutar =  parseFloat(kdv_hesap);
        }


        if(!isNaN(tutar)){
            $(".tutar_input").val(tutar);
        }

        if(fiyat == ""){
            $(".tutar_input").val("");
        }

        if(adet == ""){
            $(".tutar_input").val("");
        }
    }

    function dip_toplam(){
        var tutar = 0;
        $(".tutar_input").each(function(){
            var deger = $(this).val();


            if(!isNaN(deger) && (deger != "")) {
                tutar = parseFloat(tutar) + parseFloat(deger);
            }
        });

        $(".mal_dip").text(parseFloat(tutar).toFixed(2));

        var kdv = $(".kdv :selected").val();
        var kdv2 = $(".kdv :selected").val();
        var kdv_tipi = $("input[name=kdv_tipi]:checked").val();//0 dahil 1 haric

        if((kdv != "") && (parseFloat(tutar) > 0)){

            var kdv_hesapla = 0;

            if(kdv == 18){
                kdv = '0.' + kdv;
            }else{
                kdv = '0.0' + kdv;
            }

            kdv_hesapla = (parseFloat(tutar) * parseFloat(kdv));
            $(".kdv_dip").text(parseFloat(kdv_hesapla).toFixed(2));
            $(".kdv_kac").text("KDV %" + kdv2);

            var genel_toplam = parseFloat(tutar) + parseFloat(kdv_hesapla);
            $(".genel_dip").text(parseFloat(genel_toplam).toFixed(2));

        }

        $("input[name=genel_toplam]").val(parseFloat(genel_toplam).toFixed(2));

    }

</script>