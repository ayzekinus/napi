
<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-teal " id="wid-id-1" data-widget-deletebutton="true" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-folder-open"></i> </span>
            <h2><strong>Evrak Seçimi</strong></h2>

            <div class="jarviswidget-ctrls" role="menu" ><a href="#" data-dismiss="modal" class="ajax button-icon" style="color: white !important;"><i class="fa fa-times"></i></a></div>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body no-padding">

                <div id="formk" class="smart-form">

                    <div style="margin: 10px;">

                        <ul id="myTab2" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#ss1" data-toggle="tab">Evraklar</a>
                            </li>

                            <li >
                                <a href="#ss2" data-toggle="tab">Yükle</a>
                            </li>

                        </ul>

                        <div id="myTabContent1" class="tab-content padding-10">
                            <div class="tab-pane fade active in" id="ss1">

                                <ul class="galeri_popup">
                                    <?php foreach($dosyalar as $d){

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

                                       <li><img src="<?php echo Url::base('assets/img/file_icon/' . $file);?>"  width="96" height="96" class="gorsel_img" data-name="<?php echo $d->dosya;?>"/><span><i class="fa fa-times fa-lg btngalerisil"></i></span></li>
                                    <?php }?>
                                </ul>

                                <div style="clear: left;"></div>
                            </div>

                            <div class="tab-pane fade in" id="ss2">
                                <form id="mydropzone" action="" class="dropzone"></form>
                            </div>

                        </div>
                    </div>

                    <footer>
                        <button type="button" class="btn btn-default btnkapat" data-dismiss="modal" >
                            <i class="fa fa-remove"></i> Kapat
                        </button>
                    </footer>
                </div>


            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>


<script src="<?php echo Url::base(); ?>assets/js/plugin/dropzone/dropzone.min.js"></script>
<script src="<?php echo Url::base(); ?>assets/js/robov2.js?ver=5"></script>


<script type="text/javascript">
    $(document).ready(function() {
        var file = robo.file;

        file.file_type = "file";
        file.folder = "uploads/docs";
        file.image_resize = false;
        file.image_thumb = false;
        file.image_width = 800;
        file.image_twidth = 460;
        file.post_table = "evrak_yonetimi_dosya";

        file.upload("#mydropzone");

        $("#ss1").on('click','.galeri_popup li img',function(){
            var img = $(this).attr("src");
            var name = $(this).attr("data-name");
            var thumb = '<div class="alt_gorsel"><img src="'+ img +'"  width="96" height="96" class="gorsel_img" data-name="'+name+'" /><span style="width: 96px !important; margin: 80px 0 0 -96px !important;"><i class="fa fa-times fa-lg btngorselsil"></i></span></div>';

            $(".gorsel_thumb .gorsel_div").append(thumb);

            galeri_img();

            return false;
        });

        $(".btngalerisil").on('click',function(){

            var alt = $(this).parent().parent().children().attr("data-name");
            var sec = $(this).parent().parent();
            swal({
                    title: "Emin misiniz?",
                    text: "Kaydı silmek için lütfen onaylayın, bu işlem geri alınamayacaktır.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Hayır, çık!",
                    confirmButtonColor: '#D0D0D0',
                    confirmButtonText: 'Evet, silebilirsin',
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        var formdata = 'table=evrak_yonetimi_dosya&dosya=' + alt;
                        var git = jsPath + 'post/galeri_sil';
                        $.post(git, formdata, function(data) {
                            if (data == 1) {
                                $(sec).fadeOut();
                                robo.msg.okey("Tamamlandı","Kayıt sistemden silindi.");
                            } else {
                                robo.msg.error("Hata!","Kayıt silinemedi, lütfen tekrar deneyin!");
                            }
                        });

                    } else {
                        swal("Vazgeçildi", "İşleminiz iptal edildi.", "error");
                    }
                });

            return false;
        });

    });



</script>


