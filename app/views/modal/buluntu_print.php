<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }

    @page{
        size: auto;
        margin: 10mm 5mm 10mm 5mm;
    }

    body
    {
        margin: 0px;
        font-family: "Times New Roman";
        font-size: 11pt;
    }

    table{
        border-spacing: 0px;
    }


    table thead tr th{
        padding: 7px 10px !important;
    }

    #aktif_tab{
        width: 100%; overflow-y: visible;
    }

    .gorsel_div{
        margin:0 auto !important;
    }
    .alt_gorsel img{width: 330px !important; margin-bottom :20px; margin-right: 10px; }


    .gorsel_thumb .gorsel_div .alt_gorsel {float: left; margin-right: 5px !important; margin-bottom: 10px !important;}
    .gorsel_thumb .gorsel_div .alt_gorsel .gorsel_img{float: left;}

    .gorsel_kucuk img{float: left; border: 1px solid black; }

    .gorsel_img{border-style: solid; display: block; max-width: 60%; height: auto; !important;}
    .gorsel_img:hover{cursor: pointer;border: 1px solid #CCD0D1 !important;}

</style>


<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-teal" id="wid-id-1" data-widget-deletebutton="true" data-widget-fullscreenbutton="true" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div id="widgetRefresh" class="widget-body no-padding">


                <form id="formk" action="" class="smart-form">

                    <div id="formdata"></div>

                    <div style="margin: 10px;">

                        <div id="myTabContent1" class="tab-content padding-10" >

                            <div class="tab-pane fade active in" id="aktif_tab">

                                <table class="table table-bordered table-striped table-condensed table-hover" style="" width="100%">

                                    <tbody>

                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Anakod</td>

                                        <td>
                                            <label class="input">
                                                <?php echo $anakod;?>
                                            </label>

                                        </td>


                                    </tr>


                                    <tr>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu No</td>

                                        <td>
                                            <label class="input">
                                                <?php echo $q->buluntu_num;?>
                                            </label>

                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Tarihi</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->buluntu_tarihi);?>
                                            </label>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Tip</td>
                                        <td>
                                            <?php echo $tip;?>
                                        </td>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Şube</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->sube);?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kazı Env. No</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->kazienv_no);?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Müze Env. No</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->muzeenv_no);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Form/Obje</td>

                                        <td>
                                            <?php echo $formobje;?>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Yapım Malzemesi *</td>
                                        <td >
                                            <?php echo $yapim_malzemesi;?>
                                        </td>

                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Üretim Yeri</td>
                                        <td>
                                            <?php echo $uretimyeri;?>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Dönem</td>
                                        <td >
                                            <?php echo $donem;?>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Yeri</td>
                                        <td >
                                            <?php echo $by;?>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Buluntu Şekli</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->buluntu_sekli);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Plankare</td>
                                        <td style="width: 300px;">
                                            <label class="input">
                                                <?php echo stripslashes($q->plankare);?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Tabaka</td>
                                        <td style="width: 350px;">
                                            <label class="input">
                                                <?php echo stripslashes($q->tabaka);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Seviye</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->seviye);?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Mezar No</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->mezarno);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Eser Tarihi</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->eser_tarihi);?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">B. Yeri Diğer</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->buluntu_yeri_diger_bilgi);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Yükseklik</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->yukseklik). " cm";?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Ağız Çapı</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->agiz_capi). " cm";?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kaide/Dip Çapı</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->dip_capi). " cm";?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kalınlık/Cidar</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->derinlik). " cm";?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Uzunluk</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->uzunluk). " cm";?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Genişlik</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->genislik). " cm";?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Çap</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->cap). " cm";?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Gram</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->gram). " gr";?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Hamur Rengi</td>
                                        <td >
                                            <?php echo $hamur_rengi;?>
                                        </td>


                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Astar Rengi</td>
                                        <td >
                                            <?php echo $astar_rengi;?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Kalıp Yönü</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->kalip_yonu);?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 200px;font-weight: bold;">Diğer Renk</td>
                                        <td>
                                            <label class="input">
                                                <?php echo stripslashes($q->diger_renk);?>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>

                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;">Tanım / Bezeme</span>
                                            <br/>

                                            <label class="textarea">
                                                <?php echo stripslashes($q->tanim);?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <span style="vertical-align:middle;width: 200px;font-weight: bold;">Kaynak ve Referans</span>
                                            <br/>

                                            <label class="textarea">
                                                <?php echo stripslashes($q->kaynak_referans);?>
                                            </label>
                                        </td>
                                    </tr>



                                    <?php if(count($galeri) > 0){?>

                                        <tr>
                                            <td colspan="4" class="gorsel_thumb" style="">
                                                <span style="vertical-align:middle;width: 200px;font-weight: bold;">Resimler</span>
                                                <br/>
                                                <div class="gorsel_div" ">

                                                    <?php foreach($galeri as $g){?>
                                                        <div class="alt_gorsel" style="float:left; width: calc(100%/3);">
                                                            <img src="<?php echo Url::base();?>uploads/images/thumb/<?php echo $g->dosya;?>" class="gorsel_img" data-name="<?php echo $g->dosya;?>">
                                                        </div>
                                                    <?php }?>
                                                </div>

                                            </td>
                                        </tr>

                                    <?php } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
