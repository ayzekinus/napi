<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                    <h2><strong>Kullanıcı</strong> <i>Düzenle</i></h2>

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
                                                    <a href="#" class="btn btn-labeled btn-success btn-aktif" <?php if($q->durum == 0){echo ' style="display: none;" ';}?>> <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Aktif </a>
                                                    <a href="#" class="btn btn-labeled btn-danger btn-pasif"  <?php if($q->durum == 1){echo ' style="display: none;" ';}?>> <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Pasif </a>
                                                    <input type="hidden" name="durum" type="text" value="<?php echo $q->durum;?>"/>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Ad Soyad</td>
                                                <td colspan="4">
                                                    <label class="input">
                                                        <input name="adsoyad" class="required" type="text"
                                                               placeholder="" value="<?php echo stripslashes($q->adsoyad);?>">
                                                    </label>
                                                </td>


                                            </tr>


                                            <tr>

                                                <td style="vertical-align:middle;">Kullanıcı ID</td>
                                                <td colspan="4">
                                                    <label class="input">
                                                        <input name="kullanici" class="required" type="text" placeholder="Sisteme giriş yapabilmek için kullanılacak alandır, kullanıcı tarafından değiştirelemez." value="<?php echo stripslashes($q->_kullanici);?>">
                                                    </label>
                                                </td>

                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Şifre</td>
                                                <td>
                                                    <label class="input">
                                                        <input name="sifre1"  type="password">
                                                    </label>
                                                </td>

                                                <td style="vertical-align:middle;">Şifre Tekrar</td>
                                                <td colspan="2">
                                                    <label class="input">
                                                        <input name="sifre2" type="password">
                                                    </label>
                                                </td>
                                            </tr>



                                            <tr>
                                                <td style="vertical-align:middle;">Sistem Yetkisi</td>


                                                <td style="vertical-align:middle;" colspan="4">

                                                    <div class="inline-group">
                                                        <label class="radio" >
                                                            <input type="radio" name="yetki" class="yetki_sec"
                                                                   value="G" <?php if($q->yetki == 'G'){echo ' checked';}?>>
                                                            <i></i>Görüntüleme</label>

                                                        <label class="radio">
                                                            <input type="radio" name="yetki" value="O" class="yetki_sec" <?php if($q->yetki == 'O'){echo ' checked';}?>>
                                                            <i></i>Oluşturma</label>

                                                        <label class="radio">
                                                            <input type="radio" name="yetki" value="D" class="yetki_sec" <?php if($q->yetki == 'D'){echo ' checked';}?>>
                                                            <i></i>Düzenleme</label>


                                                        <label class="radio">
                                                            <input type="radio" name="yetki" value="S" class="yetki_sec" <?php if($q->yetki == 'S'){echo ' checked';}?>>
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
                                                        <textarea name="aciklama" placeholder="Kullanıcıya özel açıklama veya not ekleyebilirsiniz, kullanıcı tarafından görülmez."><?php echo stripslashes($q->aciklama);?></textarea>
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
                                                        <input name="eposta" type="text" placeholder="" value="<?php echo stripslashes($q->eposta);?>">
                                                    </label>
                                                </td>


                                                <td style="vertical-align:middle;">Telefon</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="telefon" type="text" placeholder="" value="<?php echo stripslashes($q->telefon);?>">
                                                    </label>
                                                </td>


                                            </tr>


                                            <tr>
                                                <td style="vertical-align:middle;">Öğrenim Durumu</td>
                                                <td >
                                                    <select name="ogrenim_durumu" class="select2" style="width: 100%;">
                                                        <option value=""></option>

                                                        <option value="İlköğretim" <?php if($q->ogrenim_durumu == 'İlköğretim'){echo ' selected';}?>>İlköğretim</option>
                                                        <option value="Lise" <?php if($q->ogrenim_durumu == 'Lise'){echo ' selected';}?>>Lise</option>
                                                        <option value="Ön Lisans" <?php if($q->ogrenim_durumu == 'Ön Lisans'){echo ' selected';}?>>Ön Lisans</option>
                                                        <option value="Lisans" <?php if($q->ogrenim_durumu == 'Lisans'){echo ' selected';}?>>Lisans</option>
                                                        <option value="Yüksek Lisans" <?php if($q->ogrenim_durumu == 'Yüksek Lisans'){echo ' selected';}?>>Yüksek Lisans</option>
                                                        <option value="Doktora" <?php if($q->ogrenim_durumu == 'Doktora'){echo ' selected';}?>>Doktora</option>
                                                    </select>
                                                </td>


                                                <td style="vertical-align:middle;">Üniversitesi</td>
                                                <td >
                                                    <label class="input">
                                                        <input name="universite" type="text" placeholder="" value="<?php echo stripslashes($q->universite);?>">
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

                            <?php $k = explode(",",$q->kisitlamalar);

                            //.A0, .B0, .AR0, .EY0, .DL0, .PD0, .E0, .R0
                            //.A1, .B1, .AR1, .EY1, .DL1, .PD1, .E1, .R1
                            //.A2, .B2, .AR2, .EY2, .DL2, .PD2, .E2, .R2
                            //.A3, .B3, .AR3, .EY3, .DL3, .PD3, .E3, .R3

                            ?>

                            <ul>
                                <li>
                                    <span><i class="fa fa-lg fa-folder-open"></i> Kısıtlamalar</span>


                                    <ul class="kisitlama_ul">
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Anakod</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]"  value="A0" class="A0" <?php if(in_array("A0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="A1" class="A1" <?php if(in_array("A1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="A2" class="A2" <?php if(in_array("A2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="A3" class="A3" <?php if(in_array("A3",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Buluntu</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]"  value="B0" class="B0" <?php if(in_array("B0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="B1" class="B1" <?php if(in_array("B1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="B2" class="B2" <?php if(in_array("B2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="B3" class="B3" <?php if(in_array("B3",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Açma Rapor</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]"  value="AR0" class="AR0" <?php if(in_array("AR0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="AR1" class="AR1" <?php if(in_array("AR1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="AR2" class="AR2" <?php if(in_array("AR2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="AR3" class="AR3" <?php if(in_array("AR3",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Evrak Yönetimi</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]"  value="EY0" class="EY0" <?php if(in_array("EY0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="EY1" class="EY1" <?php if(in_array("EY1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="EY2" class="EY2" <?php if(in_array("EY2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="EY3" class="EY3" <?php if(in_array("EY3",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Demirbaş Listesi</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]"  value="DL0" class="DL0" <?php if(in_array("DL0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="DL1" class="DL1" <?php if(in_array("DL1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="DL2" class="DL2" <?php if(in_array("DL2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="DL3" class="DL3" <?php if(in_array("DL3",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Depo</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]"  value="PD0" class="PD0" <?php if(in_array("PD0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="PD1" class="PD1" <?php if(in_array("PD1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="PD2" class="PD2" <?php if(in_array("PD2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="PD3" class="PD3" <?php if(in_array("PD3",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Yayınlar</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" value="Y0" class="Y0" <?php if(in_array("Y0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="Y1" class="Y1" <?php if(in_array("Y1",$k)){echo ' checked';}?>><i></i>Oluşturma</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="Y2" class="Y2" <?php if(in_array("Y2",$k)){echo ' checked';}?>><i></i>Düzenleme</label> </span></li>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox"  name="kisitlamalar[]" value="Y3" class="Y3" <?php if(in_array("Y0",$k)){echo ' checked';}?>><i></i>Silme</label> </span></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> İstatistikler</span>
                                            <ul>
                                                <li style="display:none"><span> <label class="checkbox inline-block"><input type="checkbox" name="kisitlamalar[]" value="R0" class="R0" <?php if(in_array("R0",$k)){echo ' checked';}?>><i></i>Görüntüleme</label></span></li>
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
        form.url = "post/update/kullanici/<?php echo $q->ID;?>";
        form.validate = true;

        form.use.select2();

        $(".menu_ayarlar").addClass("active");
        drawBreadCrumb(["Düzenle"]);

        $(".btnkaydetu").click(function () {
            var kisitlama = $("#formk2").serialize();

            form.data = kisitlama;
            form.submit("#formk");

            return false;
        });

        $(".yetki_sec").on('click',function(){
            var yetki = $(this).val();

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
            var mytreebranch=$(".tree").find("li:has(ul)").addClass("parent_li").attr("role","treeitem").find(" > span").attr("title","Collapse this branch");
            $(".tree > ul").attr("role","tree").find("ul").attr("role","group"),mytreebranch.on("click",function(a){var b=$(this).parent("li.parent_li").find(" > ul > li");b.is(":visible")?(b.hide("fast"),$(this).attr("title","Expand this branch").find(" > i").addClass("fa-minus-circle").removeClass("fa-minus-sign")):(b.show("fast"),$(this).attr("title","Collapse this branch").find(" > i").addClass("fa-minus-sign").removeClass("fa-minus-circle")),
                a.stopPropagation()});
        }


    });


</script>

