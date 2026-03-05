<style type="text/css">
    figure
    {
        text-align: center;
        outline: solid 1px #ccc;
        background: rgba(0,0,0,0.05);
        padding: 5px;
        margin: 8px 8px !important;
        display: inline-block;
    }

    figure > figcaption
    {
        margin-top: 5px !important;
        text-align: center;
        display: block; /* For IE8 */
    }


    .image-clean > figcaption
    {
        font-size: .9em;
        text-align: right;
    }


    .image-grayscale img, img.image-grayscale
    {
        filter: grayscale(100%);
    }


    @page{

        size: auto;
        margin: 10mm;
    }

    body
    {
        margin: 0px;
        width: 100%; overflow-y: hidden;
    }

    .print_line{
        width: 100%;
        float: left;
        color: black;
        font-family: "Times New Roman" !important;
        font-size: 12pt !important;
    }

    .print_line .title{width: 210px;height: 20px; float: left;font-weight: bold;padding: 2px 5px !important;}
    .print_line .data{ height: 20px; float :left;padding: 2px 5px !important;}
    .print_line .content{width: 695px; padding: 10px 5px 0 5px; }


</style>
<div class="print_line">
    <div class="content" style="text-align: center;margin-bottom: 25px;">
        <span style="font-weight: bold; font-size: 16pt;">Parion Kazısı <?php echo $q->calisma_yili;?> yılı <?php echo $by;?> Çalışma Sektörü </span>
        <br>
        <span style="font-weight: bold;font-size: 14pt;">

   <?php echo stripslashes($q->plankare);?> Plankare Numaralı <?php echo $q->yazim_tarihi;?> Tarihli <?php echo $q->rapor_tipi;?>'u
        </span>
    </div>
</div>

<div style="width: 100%;">

    <div class="print_line">
        <span class="title">Adı Soyadı:</span>
        <span class="data"><?php echo stripslashes($q->adsoyad);?></span>
    </div>

    <div class="print_line">
        <span class="title">Yazım Tarihi:</span>
        <span class="data"><?php echo $q->yazim_tarihi;?></span>
    </div>

    <div class="print_line">
        <span class="title">Plankare:</span>
        <span class="data"><?php echo stripslashes($q->plankare);?></span>
    </div>

    <div class="print_line">
        <span class="title">Çalışma Alanı(Buluntu Yeri):</span>
        <span class="data"><?php echo $by;?></span>
    </div>

    <div class="print_line">
        <span class="title">Çalışma Yılı:</span>
        <span class="data"><?php echo $q->calisma_yili;?></span>
    </div>
<br/>
    <div class="print_line">
        <span class="title">Rapor:</span>

        <div class="content">
            <?php echo stripslashes($q->detay);?>
        </div>
    </div>
</div>