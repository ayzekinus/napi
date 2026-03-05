
<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
                    <h2><strong>Kullanıcı</strong> <i>Oluştur</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/kullanicilar" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>
                </header>


                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form id="formk" action="" class="smart-form">

                            <input type="hidden" name="token" value="<?php echo $token;?>">

                            <input type="hidden" name="supervisor_" value="yok" class="supervisor_">


                            <div style="margin: 10px;">

                                <ul id="myTab1" class="nav nav-tabs bordered">
                                    <li class="active">
                                        <a href="#s1" data-toggle="tab">Genel Bilgiler </a>
                                    </li>

                                    <li>
                                        <a href="#s2" data-toggle="tab">Kişisel Bilgiler </a>
                                    </li>
                                </ul>

                                <div id="myTabContent1" class="tab-content padding-10">
                                    <div class="tab-pane fade active in" id="s1">


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="5">Genel Bilgiler</th>
                                            </tr>

                                            </thead>

                                            <tbody>


                                            <tr>

                                                <td style="width: 150px;vertical-align:middle;">Durumu</td>
                                                <td colspan="4">
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
                                                <td style="vertical-align:middle;">Ad Soyad</td>
                                                <td colspan="4">
                                                    <label class="input">
                                                        <input name="adsoyad" class="required" type="text"
                                                               placeholder="">
                                                    </label>
                                                </td>


                                            </tr>


                                            <tr>

                                                <td style="vertical-align:middle;">Kullanıcı ID</td>
                                                <td colspan="4">
                                                    <label class="input">
                                                        <input name="kullanici" class="required" type="text" placeholder="Sisteme giriş yapabilmek için kullanılacak alandır, kullanıcı tarafından değiştirelemez.">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Şifre</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="sifre1" class="required" type="password">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Şifre Tekrar</td>
                                                <td colspan="2">
                                                    <label class="input">
                                                        <input name="sifre2" class="required" type="password">
                                                    </label>
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="vertical-align:middle;">Sistem Yetkisi</td>


                                                <td style="vertical-align:middle;" colspan="4">

                                                    <div class="inline-group">
                                                        <label class="radio" >
                                                            <input type="radio" name="yetki" checked="checked" class="yetki_sec"
                                                                   value="G">
                                                            <i></i>Görüntüleme</label>

                                                        <label class="radio">
                                                            <input type="radio" name="yetki" value="O" class="yetki_sec">
                                                            <i></i>Oluşturma</label>

                                                        <label class="radio">
                                                            <input type="radio" name="yetki" value="D" class="yetki_sec">
                                                            <i></i>Düzenleme</label>


                                                        <label class="radio">
                                                            <input type="radio" name="yetki" value="S" class="yetki_sec">
                                                            <i></i>Supervisor</label>

                                                    </div>

                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <br/>
                                        <br/>
                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Açıklama ve Özel Notlar</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Açıklama</td>
                                                <td colspan="3">
                                                    <label class="textarea">
                                                        <textarea name="aciklama" placeholder="Kullanıcıya özel açıklama veya not ekleyebilirsiniz, kullanıcı tarafından görülmez."></textarea>
                                                    </label>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>


                                    <div class="tab-pane fade in" id="s2">


                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="5">Kişisel Bilgiler</th>
                                            </tr>

                                            </thead>

                                            <tbody>



                                            <tr>
                                                <td style="vertical-align:middle;">E-Posta</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="eposta" type="text" placeholder="">
                                                    </label>
                                                </td>


                                                <td style="vertical-align:middle;">Telefon</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="telefon" type="text" placeholder="">
                                                    </label>
                                                </td>


                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Öğrenim Durumu</td>
                                                <td >
                                                    <select name="ogrenim_durumu" class="select2" style="width: 100%;">
                                                        <option value=""></option>

                                                        <option value="İlköğretim">İlköğretim</option>
                                                        <option value="Lise">Lise</option>
                                                        <option value="Ön Lisans">Ön Lisans</option>
                                                        <option value="Lisans">Lisans</option>
                                                        <option value="Yüksek Lisans">Yüksek Lisans</option>
                                                        <option value="Doktora">Doktora</option>
                                                    </select>
                                                </td>


                                                <td style="vertical-align:middle;">Üniversitesi</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="universite" type="text" placeholder="">
                                                    </label>
                                                </td>


                                            </tr>




                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>


                            <footer>
                                <button type="button" class="btn btn-info btnkaydetu">
                                    <i class="fa fa-save"></i> Kaydet
                                </button>
                                <a href="index/kullanicilar" type="button" class="ajax btn btn-default"
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



        <article class="col-xs-3 col-sm-3 col-md-3 col-lg-3" >
            <div class="jarviswidget jarviswidget-color-orangeDark" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-unlock"></i> </span>
                    <h2>Yetki & Kısıtlamalar</h2>
                </header>


                <!-- widget div-->
                <div style="height: 504px; overflow-y: scroll;">
                    <!-- widget content -->
                    <div class="widget-body no-padding" >



                        <div class="tree smart-form" >
                            <form id="formk2" action="" class="smart-form">
                            <ul>
                                <li>
                                    <span><i class="fa fa-lg fa-folder-open"></i> Kısıtlamalar</span>
                                    <ul class="kisitlama_ul">
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Anakod</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="A0" class="A0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="A1" class="A1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="A2" class="A2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="A3" class="A3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Buluntu</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="B0" class="B0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="B1" class="B1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="B2" class="B2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="B3" class="B3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Açma Rapor</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="AR0" class="AR0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="AR1" class="AR1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="AR2" class="AR2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="AR3" class="AR3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Evrak Yönetimi</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="EY0" class="EY0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="EY1" class="EY1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="EY2" class="EY2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="EY3" class="EY3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Demirbaş Listesi</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="DL0" class="DL0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="DL1" class="DL1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="DL2" class="DL2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="DL3" class="DL3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Depo</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="PD0" class="PD0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="PD1" class="PD1"><i></i>Oluşturma</label> </span></li>                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="PD2" class="PD2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="PD3" class="PD3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Yayınlar</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="Y0" class="Y0"><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="Y1" class="Y1"><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="Y2" class="Y2"><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="Y3" class="Y3"><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> İstatistikler</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" checked="checked" value="R0" class="R0"><i></i>Görüntüleme</label></span></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                                </form>
                        </div>





                    </div>
                    <!-- end widget content -->


                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>

    </div>

</section>

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=1"></script>


<script type="text/javascript">

    $(document).ready(function () {

        form = robo.form;
        form.url = "post/insert/kullanici";
        form.validate = true;

        form.use.select2();

        $(".menu_ayarlar").addClass("active");
        drawBreadCrumb(["Oluştur"]);

        /*
        var kisitlama = '';
        $(".kisitlama_ul input").each(function(){
            var x = $(this).val();
            if(x[1] == 3 || x[2] == 3){
                kisitlama = kisitlama + x + ',';
            }

        });
        alert(kisitlama);

         //A0,B0,AR0,EY0,DL0,PD0,E0,R0,
         //A1,B1,AR1,EY1,DL1,PD1,E1,R1,
         //A2,B2,AR2,EY2,DL2,PD2,E2,R2,
         //A3,B3,AR3,EY3,DL3,PD3,E3,R3,

        */


        $(".btnkaydetu").click(function () {
            var kisitlama = $("#formk2").serialize();

            form.data = kisitlama;
            form.submit("#formk");

            return false;
        });

        $(".yetki_sec").on('click',function(){
            var yetki = $(this).val();

            //.A0, .B0, .AR0, .EY0, .DL0, .PD0, .E0, .R0
            //.A1, .B1, .AR1, .EY1, .DL1, .PD1, .E1, .R1
            //.A2, .B2, .AR2, .EY2, .DL2, .PD2, .E2, .R2
            //.A3, .B3, .AR3, .EY3, .DL3, .PD3, .E3, .R3


            if(yetki === "G"){

                $(".A0, .B0, .AR0, .EY0, .DL0, .PD0, .R0, .Y0").prop('checked', true);

                $(".A1, .B1, .AR1, .EY1, .DL1, .PD1, .Y1").prop('checked', false);
                $(".A2, .B2, .AR2, .EY2, .DL2, .PD2, .Y2").prop('checked', false);
                $(".A3, .B3, .AR3, .EY3, .DL3, .PD3, .Y3").prop('checked', false);
                $(".supervisor_").val("yok");
            }else if(yetki === "O"){
                $(".A0, .B0, .AR0, .EY0, .DL0, .PD0, .R0, .Y0").prop('checked', true);
                $(".A1, .B1, .AR1, .EY1, .DL1, .PD1, .Y1").prop('checked', true);

                $(".A2, .B2, .AR2, .EY2, .DL2, .PD2, .Y2").prop('checked', false);
                $(".A3, .B3, .AR3, .EY3, .DL3, .PD3, .Y3").prop('checked', false);
                $(".supervisor_").val("yok");

            }else if(yetki === "D"){
                $(".A0, .B0, .AR0, .EY0, .DL0, .PD0, .R0, .Y0").prop('checked', true);
                $(".A1, .B1, .AR1, .EY1, .DL1, .PD1, .Y1").prop('checked', true);
                $(".A2, .B2, .AR2, .EY2, .DL2, .PD2, .Y2").prop('checked', true);

                $(".A3, .B3, .AR3, .EY3, .DL3, .PD3, .Y3").prop('checked', false);

                $(".supervisor_").val("yok");

            }else if(yetki === "S"){
                $(".A0, .B0, .AR0, .EY0, .DL0, .PD0, .R0, .Y0").prop('checked', true);
                $(".A1, .B1, .AR1, .EY1, .DL1, .PD1, .Y1").prop('checked', true);
                $(".A2, .B2, .AR2, .EY2, .DL2, .PD2, .Y2").prop('checked', true);
                $(".A3, .B3, .AR3, .EY3, .DL3, .PD3, .Y3").prop('checked', true);

                $(".supervisor_").val("var");
            }
        });

        $('.btn-aktif').on('click', function () {
            $(this).hide();
            $('.btn-pasif').show();
            $('input[name=durum]').val('0');
            return false;
        });

        $('.btn-pasif').on('click', function () {
            $(this).hide();
            $('.btn-aktif').show();
            $('input[name=durum]').val('1');
            return false;
        });

        if($(".tree > ul")&&!mytreebranch)
        {
            var mytreebranch = $(".tree").find("li:has(ul)").addClass("parent_li").attr("role","treeitem").find(" > span").attr("title","");
            $(".tree > ul").attr("role","tree").find("ul").attr("role","group"),mytreebranch.on("click",function(a){var b=$(this).parent("li.parent_li").find(" > ul > li");b.is(":visible")?(b.hide("fast"),$(this).attr("title","Expand this branch").find(" > i").addClass("fa-minus-circle").removeClass("fa-minus-sign")):(b.show("fast"),$(this).attr("title","").find(" > i").addClass("fa-minus-sign").removeClass("fa-minus-circle")),
                a.stopPropagation()});
        }



    });

</script>

