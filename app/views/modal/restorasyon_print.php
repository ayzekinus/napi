<style type="text/css">

    @page{
        size: auto;
        margin: 8mm;
    }

    body
    {
        margin: 0px;
        width: 100%; overflow-y: hidden;

        color: black;
        font-family: "Times New Roman" !important;
        font-size: 12pt !important;
    }

    .print_line_head{
        width: 100%;
        float: left;
        color: black;
        font-family: "Times New Roman" !important;
        font-size: 12pt !important;
    }

    .print_line_head .content{ width: 695px; padding: 10px 5px 0 5px; }

    .print_line{
        width: 220px;
        float: left;
        color: black;
        font-family: "Times New Roman" !important;
        font-size: 12pt !important;
        text-align: center;
    }

    .print_line .title{width: 220px; line-height:40px; font-weight: bold;padding: 2px 5px !important;}
    .print_line .data{ width: 220px; padding: 2px 5px !important;}

    table{
        border-spacing: 0;
        border-collapse: collapse;
        width: 730px;
    }

    table tr td {
        border: 1px solid black;
        padding: 10px;
    }

</style>

<div class="print_line_head">
    <div class="content" style="text-align: center;margin-bottom: 25px;">
        <span style="font-weight: bold; font-size: 12pt;">EK-18 </span>
        <br><br>
        <span style="font-weight: bold;font-size: 12pt;">
            PARİON KAZISI KORUMA/ONARIM FİŞİ*
        </span>
    </div>
</div>


<table>

    <tbody>

    <tr style="font-weight: bold;">

        <td>
            Fiş No: <br>
            <?php echo $qq->anakod . " - " . $qq->buluntu_no;?>

        </td>
        <td>Eserin Adı:</td>
        <td>
            <?php echo $qq->form_obje . "<br>" . $qq->yapim_malzemesi;?>
        </td>
        <td>Kazı Envanter No</td>
        <td><?php echo $qq->kazienv_no;?></td>

    </tr>

    <tr style="font-weight: bold;text-align: center;">
        <td>Eserin Mevcut Durumu</td>
        <td>Uygulanan İşlemler</td>
        <td colspan="2">Kullanılan Malzeme</td>
        <td>Uygulayan</td>
    </tr>

    <tr style="height:650px;vertical-align: top;">
        <td><?php echo stripslashes($q->mevcut_durum);?></td>
        <td><?php echo stripslashes($q->uygulanan_islemler);?></td>
        <td colspan="2"><?php echo stripslashes($q->kullanilan_malzeme);?></td>
        <td><?php echo stripslashes($q->uygulayan);?></td>
    </tr>

    </tbody>
</table>




<div class="print_line" style="margin-top:10px;margin-left: 45px;">
    <span class="title">Konservatör / Restoratör</span>
    <br>
    <span class="data"><?php echo stripslashes($q->konservator);?></span>
</div>

<div class="print_line" style="margin-top:10px;">
    <span class="title">Bakanlık Temsilcisi</span>
    <br>
    <span class="data"><?php echo stripslashes($q->temsilci);?></span>
</div>

<div class="print_line" style="margin-top:10px;">
    <span class="title" >Kazı Başkanı</span>
    <br>
    <span class="data"><?php echo stripslashes($baskan);?></span>
</div>

<div class="print_line">
    <div class="content">
        <?php echo stripslashes($q->aciklama);?>
    </div>
</div>

<div class="print_line_head" style="margin-top: 100px;">
    * Rapor ekinde gönderilmez, istenildiğinde verilmek üzere kazı arşivinde saklanır.
</div>
