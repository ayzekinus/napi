<style type="text/css">

    .select2-container .select2-choice{ font-family:Tahoma, Sans-Serif; font-size: 12px !important; font-weight: normal !important;}
    .select2-results{  font-family:Tahoma, Sans-Serif;font-size: 12px !important; }

</style>

<section id="widget-grid" class="">
    <br/>


    <div class="row">


        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                <h1>Parion Forum</h1>

                <!-- widget div-->
                <div>

                    <!-- widget content -->
                    <div class="widget-body" >


                        <table id="dt_basic" class="table table-striped table-bordered" width="100%" >

                            <thead>
                            <tr>
                                <th colspan="5">Son Mesajlar</th>
                            </tr>

                            <tr>

                                <th data-hide="phone" style="width: 25px;">ID</th>
                                <th data-class="expand" style="width: 300px;">Konu</th>
                                <th data-class="expand" style="width: 50px;">Toplam Mesaj</th>
                                <th data-class="expand" style="width: 90px;">Gönderen</th>
                                <th data-class="expand" style="width: 90px;">Son Mesaj</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($sm as $f) {

                                echo '<tr><td>'.$f->ID.'</td><td><a href="#">'.stripslashes($f->konu).'</a></td><td>'.$f->adet.'</td><td>1</td><td>1</td></tr>';

                            }?>

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

<script src="<?php echo Url::base(); ?>assets/js/robov2.js?v=5"></script>
<script src="<?php echo Url::base(); ?>assets/js/celsus.list.js?v=4"></script>

<script type="text/javascript">

    $(document).ready(function() {


        dt = robo.datatable;

        dt.source = jsPath + 'index/forum_data';
        dt.serverside = false;
        dt.table_name = 'forum';
        dt.btn_edit = 'forum_duzenle';
        dt.btn_detail = 'forum_detay';

        dt.run("#dt_basic");

        dt.visible(0);


    });

</script>

