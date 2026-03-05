<style type="text/css">
    .table-condensed.table>tbody>tr>td, .table-condensed.table>tbody>tr>th{
        padding: 7px 10px !important;
    }

    @page{
        size: auto;
        margin: 10mm 5mm 10mm 5mm;
    }

    body{
        margin: 0px;
        font-family: "Times New Roman";
        font-size: 12pt;
    }

    table{
        border-spacing: 0px;
    }

    table thead tr th{
        padding: 7px 10px !important;
    }


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

                        <div id="myTabContent1" class="tab-content padding-10">
                            <div class="tab-pane fade active in" id="s1">

                                <table class="table table-bordered table-striped table-condensed table-hover" style="" width="100%">
                                    <tbody>

                                    <tr>
                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Anakod</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $q->anakod;?>
                                            </label>
                                        </td>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Durumu</td>
                                        <td>
                                            <label class="input">
                                                <?php if($q->durum == 1){echo '<font style="color: green;">'.Aktif.'</font>';}else{echo '<font style="color: red;">'.Pasif.'</font>';}?>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Buluntu Yeri</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $by;?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Buluntu Yılı</td>
                                        <td>
                                            <label class="input">
                                                <?php echo $q->buluntu_yili;?>
                                            </label>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Plankare</td>
                                        <td >
                                            <label class="input">
                                                <?php echo $q->plankare;?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Tabaka</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $q->tabaka;?>
                                            </label>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Seviye</td>
                                        <td >
                                            <label class="input">
                                                <?php echo $q->seviye;?>
                                            </label>
                                        </td>


                                        <td style="vertical-align:middle;width: 100px;font-weight: bold;">Mezar No</td>
                                        <td style="">
                                            <label class="input">
                                                <?php echo $q->mezarno;?>
                                            </label>
                                        </td>

                                    </tr>


                                    <tr>

                                        <td colspan="4">
                                            <label class="input">
                                                <?php echo $q->aciklama;?>
                                            </label>
                                        </td>

                                    </tr>

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

