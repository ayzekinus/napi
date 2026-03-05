<link rel='stylesheet' href='<?php echo Url::base(); ?>assets/js/jquery.qtip.custom/jquery.qtip.min.css?v=4'>

<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }


    .galeri_div{width: 100%; margin: 0px; padding: 0px; overflow: hidden !important; background: #EDEDED; border-top: 1px solid #DDDDDD; }
    .galeri_icerik{width: 100%; margin: 0px; padding: 0px; overflow: hidden !important; background: #EDEDED; border-top: 1px solid #DDDDDD; }
    .galeri_icerik img{


    }
    .galeri_icerik img:hover{cursor: pointer;}


    .pasif {

        -webkit-filter: grayscale(100%);
        -webkit-transition: .5s ease-in-out;
        -moz-filter: grayscale(100%);
        -moz-transition: .5s ease-in-out;
        -o-filter: grayscale(100%);
        -o-transition: .5s ease-in-out;

    }

    .aktif{
        -webkit-filter: grayscale(0%);
        -webkit-transition: .5s ease-in-out;
        -moz-filter: grayscale(0%);
        -moz-transition: .5s ease-in-out;
        -o-filter: grayscale(0%);
        -o-transition: .5s ease-in-out;
    }

</style>


<section id="widget-grid" class="">
    <br/>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Buluntu Galerisi </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body no-padding" style="background: #fafafa !important;">

                        <div class="toolbox" style="width: 100%; height: 55px; background: #fafafa !important; padding-top: 10px;">
                            <div class="col-sm-12 col-xs-12 hidden-xs">

                                <form id="formk" name="formk">

                                <div style="width: 235px; float: left;margin-right: 10px;" class="buluntu_select">

                                    <select name="buluntu_yeri[]" class="select2" multiple style="width: 100%;" placeholder="Buluntu Yeri">
                                        <option value=""></option>

                                    </select>

                                </div>

                                <div style="width: 235px; float: left;margin-right: 10px;" class="formobje_select">

                                    <select name="form_obje[]" class="select2" multiple style="width: 100%;" placeholder="Form Obje">
                                        <option value=""></option>

                                    </select>

                                </div>

                                <div style="width: 235px; float: left;margin-right: 10px;" class="yapimmalzemesi_select">

                                    <select name="yapim_malzemesi[]" class="select2" multiple style="width: 100%;" placeholder="Yapım Malzemesi">
                                        <option value=""></option>

                                    </select>

                                </div>


                                <div style="width: 200px; float: left;margin-right: 10px;" class="">


                                    <select name="buluntu_yili[]" class="select2" multiple style="width: 100%;" placeholder="Buluntu Yılı">
                                        <option value=""></option>

                                        <?php foreach($yillar as $y){
                                            echo '<option value="'.$y->buluntu_yili.'">'.$y->buluntu_yili.'</option>';
                                        }?>

                                    </select>

                                </div>

                                </form>


                                <div class="dataTables_paginate paging_bootstrap" style="float: right;">
                                    <ul class="pagination pagination-sm">
                                        <li class="prev"><a href="#"><i class="fa fa-double-angle-left"></i> Geri</a></li>
                                        <li class="next"><a href="#">İleri <i class="fa fa-double-angle-right"></i></a></li>
                                    </ul>
                                </div>


                                <!--<div class="dataTables_info" id="dt_basic_info" style="float: right;">Toplam <?php echo $toplam_adet; ?> kayıt</div>-->
                            </div>


                        </div>


                        <div class="galeri_div">

                            <div class="galeri_icerik">
                                <?php foreach($galeri as $g){?>
                                    <img src="<?php echo Url::base() . 'uploads/images/thumb/' . $g->dosya;?>" data-tooltip="<b>Anakod: </b> <?php echo $g->anakod;?> <br/> <b>Buluntu No: </b> <?php echo $g->buluntu_no;?> <br/><b>Buluntu Yeri: </b> <?php echo $g->buluntu_yeri;?> <br/> <b>Buluntu Tarihi: </b> <?php echo $g->buluntu_tarihi;?><br/><b>Form/Obje: </b> <?php echo $g->formobje;?>">
                                <?php }?>
                            </div>


                        </div>


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
<script src="<?php echo Url::base(); ?>assets/js/jquery.balanced-gallery.js"></script>
<script src="<?php echo Url::base(); ?>assets/js/jquery.qtip.custom/jquery.qtip.min.js?v=2"></script>


<script type="text/javascript">

    pageSetUp();

    $(function() {

        robo.data.load('buluntu', '.buluntu_select','open');
        robo.data.load('formobje', '.formobje_select','open');
        robo.data.load('yapim_malzemesi', '.yapimmalzemesi_select','open');



        $(".select2").on('change',function(){

           /*
            var data = $(this).select2('data');

            if(data.length > 1){
                for(i = 0; i <= data.length - 1; i++){
                    console.log(data[i].id);
                }
            }else{
                console.log(data[0].id);
            }*/

            var formdata = $("#formk").serialize();

            $.post(jsPath + 'index/buluntu_listesi_galeri_data', formdata, function(data){

                $(".galeri_icerik").html(data);

                setTimeout(function(){

                    //$('.galeri_icerik img').css("border", "1px dashed #ADA9A9");$(".galeri_icerik img").hover(function(){$(this).css("border", "1px solid #ADA9A9").addClass("aktif");$(".galeri_icerik img").not("aktif").addClass("pasif");}, function(){$(this).css("border", "1px dashed #ADA9A9").removeClass("aktif");$(".galeri_icerik img").removeClass("pasif");});

                    $(".galeri_div").html(data);


                    $('[data-tooltip!=""]').qtip({
                        content: {
                            title: 'Buluntu Detayı',
                            attr: 'data-tooltip'
                        },
                        position: {
                            target: 'mouse',
                            adjust: { x: -123, y: 10 }
                        },
                        style: {
                            width: 210
                        }
                    });


                },500);


            });


        });


        /*$('.galeri_icerik').BalancedGallery({

            autoResize: false,       // re-partition and resize the images when the window size changes
            background: null,       // the css properties of the gallery's containing element
            idealHeight: 200,      // ideal row height, only used for horizontal galleries, defaults to half the containing element's height
            idealWidth: null,       // ideal column width, only used for vertical galleries, defaults to 1/4 of the containing element's width
            maintainOrder: true,    // keeps images in their original order, setting to 'false' can create a slightly better balance between rows
            orientation: 'horizontal',          // 'horizontal' galleries are made of rows and scroll vertically; 'vertical' galleries are made of columns and scroll horizontally
            padding: 20, // pixels between images
            shuffleUnorderedPartitions: true,   // unordered galleries tend to clump larger images at the begining, this solves that issue at a slight performance cost
            viewportHeight: null,   // the assumed height of the gallery, defaults to the containing element's height
            viewportWidth: null
        });*/



        $('.galeri_icerik img').css("border", "1px dashed #ADA9A9");

        $(".galeri_icerik img").hover(function(){
            $(this).css("border", "1px solid #ADA9A9").addClass("aktif");

            $(".galeri_icerik img").not("aktif").addClass("pasif");
        }, function(){
            $(this).css("border", "1px dashed #ADA9A9").removeClass("aktif");
            $(".galeri_icerik img").removeClass("pasif");
        });



        $('[data-tooltip!=""]').qtip({
            content: {
                title: 'Buluntu Detayı',
                attr: 'data-tooltip'
            },
            position: {
                target: 'mouse',
                adjust: { x: -123, y: 10 }
            },
            style: {
                width: 210
            }
        });

    });

</script>

