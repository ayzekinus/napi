<style type="text/css">

    .alt_gorsel {
        text-align: center;
        outline: solid 1px #ccc;
        background: rgba(0,0,0,0.05);
        padding: 5px;
        margin: 8px 8px !important;
        display: inline-block;
    }
    .alt_gorsel img:hover{cursor: pointer;}

</style>



<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-editbutton="false"
                 data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                    <h2><strong>Yayın</strong> <i>Düzenle</i></h2>

                    <div class="jarviswidget-ctrls" role="menu" ><a href="index/yayin_listesi" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>

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
                                                <th colspan="4">Genel Bilgiler</th>
                                            </tr>
                                            </thead>

                                            <tbody>


                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Eser Adı <i class="fa fa-asterisk reqicon"></i></td>
                                                <td colspan="3">
                                                    <label class="input">
                                                        <input name="eser_ad" type="text" placeholder="" class="required" value="<?php echo stripslashes($q->eser_ad);?>">
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>


                                                <td style="vertical-align:middle;">Yayın Kategorisi <i class="fa fa-asterisk reqicon"></i></td>
                                                
                                                    <td style="width:350px;" class="kategori_select">

                                                    <select name="kategori_id" class="select2 required" style="width: 100%;">
                                                        <?php  if($q->kategori_id > 0) echo '<option value="'.$q->kategori_id.'" selected>'.$kategori->list_adi.'</option>'; ?>
                                                    </select>
                                                </td>
                                                <td style="vertical-align:middle;">Yayın Yeri</td>
                                                <td style="width: 350px;">
                                                    <label class="input">
                                                       <input name="eser_yayinyeri" type="text" placeholder=""  value="<?php echo stripslashes($q->eser_yayinyeri);?>">
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>



                                                <td style="width: 150px;vertical-align:middle;">Yazarı</td>
                                                <td >
                                                    <label class="input" style="width: 100%; float: left;margin-right: 4%;">
                                                        <input name="eser_yazar" type="text" placeholder="" value="<?php echo stripslashes($q->eser_yazar);?>">
                                                    </label>
                                                </td>
                                                <td style="width: 150px;vertical-align:middle;">Yılı</td>
                                                <td>
                                                    <label class="input" style="width: 48%;float:left;">
                                                       <input name="eser_yil" type="text" placeholder="" class="mask_number" value="<?php echo $q->eser_yil;?>">
                                                    </label>

                                                </td>

                                            </tr>


                                            </tbody>
                                        </table>

                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th colspan="4"> Açıklama & Özel Not</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td colspan="4">
                                                    <textarea name="aciklama" id="editor"><?php echo stripslashes($q->aciklama);?></textarea>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <br/>

                                        <table class="table table-bordered table-striped table-condensed table-hover">

                                            <thead>
                                            <tr>
                                                <th colspan="4">Yüklenecek Yayınlar</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr>
                                                <td style="width: 150px;vertical-align:middle;">Yayın Seçimi</td>
                                                <td colspan="3" class="gorsel_thumb">
                                                    <input type="hidden" name="yayin_x_secimi" id="ust_gorsel" value=""/>
                                                    <a href="index/yayin_yukle/<?php echo $q->id;?>" data-target="#remoteModal"
                                                       data-toggle="modal"
                                                       class="btn btn-labeled bg-color-blueDark txt-color-white btn-gorselsec "> <span
                                                            class="btn-label"><i
                                                                class="glyphicon glyphicon-folder-open"></i></span>Gözat
                                                    </a>

                                                </td>
                                            </tr>

                                            <tr>

                                                <td colspan="4" class="gorsel_thumb" style="background-color: #FCFCF9 !important;">
                                                    <div class="gorsel_div">


                                                        <?php

                                                        foreach($dosyalar as $d){

                                                            $uzanti = explode('.', $d->dosya);
                                                            $uzanti = $uzanti[1];


                                                            $file = 'diger.png';

                                                            switch ($uzanti){
                                                                case "jpg":
                                                                case "jpeg":
                                                                case "png":
                                                                    $file = 'jpeg.png';
                                                                    break;
                                                                case "pdf":
                                                                    $file = 'pdf.png';
                                                                    break;
                                                                case "doc":
                                                                case "docx":
                                                                case "odt":
                                                                    $file = 'word.png';
                                                                    break;
                                                                case "xls":
                                                                case "xlsx":
                                                                case "ods":
                                                                    $file = 'excel.png';
                                                                    break;

                                                            }


                                                            ?>


                                                            <div class="alt_gorsel">
                                                                <img src="<?php echo Url::base('assets/img/file_icon/' . $file);?>" width="96" height="96" class="gorsel_img" data-name="<?php echo $d->dosya;?>">
                                                                <span style="width: 96px !important; margin: 80px 0 0 -96px !important;"><i class="fa fa-times fa-lg btngorselsil"></i></span>
                                                            </div>

                                                        <?php }?>

                                                    </div>
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
                                <a href="index/yayin_listesi" type="button" class="ajax btn btn-default"
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

    <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: none !important;">

            </div>
        </div>
    </div>

</section>

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=4"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.page.js?v=1"></script>


<script type="text/javascript">

    $(document).ready(function () {

        form = robo.form;
        form.url = "post/update/yayinlar/<?php echo $q->id;?>";
        form.validate = true;

        form.use.select2();
        form.use.ckeditor('editor');

        robo.data.load('yayin_kategorisi', '.kategori_select','open');

        $("input[name='eser_yil']").TouchSpin({
            min: 1900,
            max: year,
            verticalbuttons: true
        });


        $(".gorsel_div").on('click','.alt_gorsel img',function(){

            var name = $(this).attr("data-name");
            var url = '<?php echo Url::base("uploads/publications/");?>' + name;

            forceDownload(url,name);

            return false;
        });


    });

</script>