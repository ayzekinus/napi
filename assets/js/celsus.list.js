$(document).ready(function() {

    $(".btnduzenlemodal").on('click', function() {
        if ($(this).attr('href') == '#') {
            robo.msg.info('Hata!','Bu işlem için bir kayıt seçmelisiniz!');
            return false;
        }
    });

    $(".btnsil").on('click', function() {
        if ($(this).attr('href') == '#') {
            robo.msg.info('Hata!','Bu işlem için bir kayıt seçmelisiniz!');
            return false;
        }
    });

    $(".btnenvanterlik").on('click', function() {
        var id = $(this).attr('data-id');

        if (id == '0') {
            robo.msg.info('Hata!','Bu işlem için bir kayıt seçmelisiniz!');
            return false;
        }

        robo.data.envanterlik(id);

        return false;
    });


    $(".btnkonservasyon").on('click', function() {
        var id = $(this).attr('data-id');

        if (id == '0') {
            robo.msg.info('Hata!','Bu işlem için bir kayıt seçmelisiniz!');
            return false;
        }

        robo.data.konservasyon(id);

        return false;
    });


    $(".btnrestorasyon").on('click', function() {
        var id = $(this).attr('data-id');

        if (id == '0') {
            robo.msg.info('Hata!','Bu işlem için bir kayıt seçmelisiniz!');
            return false;
        }

        robo.data.restorasyon(id);

        return false;
    });



    $('#dt_basic tbody').on('mouseover', 'tr', function() {
        var ID = $(this).attr("id");

        $(".td_toolbar").hide();
        $("#" + ID + " td:last").show();
    });

    $('#dt_basic tbody').on('mouseout', 'tr', function() {
        $(".td_toolbar").hide();
    });

    $(document).on('click','.btntool', function(){
        $(".row_selected").removeClass('row_selected');
        $("#dt_basic tbody tr").css("opacity","1");
    });

    $('#dt_basic tbody').on('click', 'tr', function() {

        var ID = $(this).attr("id");

        $(".row_selected").not($(this)).removeClass('row_selected');

        var $this = $(this);

        if ($this.hasClass('clicked')) {
            /*
             * Eger double click yapilmis ise bu bolum calisir..
             */

            $this.removeClass('clicked');

            if(dt.popup_print){
                $(".btnduzenlemodal").attr('href', 'index/' + dt.btn_detail + '/' + ID + '/0');
            }else{
                $(".btnduzenlemodal").attr('href', 'index/' + dt.btn_detail + '/' + ID);
            }

            $(".btnduzenlemodal").attr('data-toggle', 'modal');
            $(".btnduzenlemodal").attr('data-target', '#remoteModal');

            $("#" + ID).removeClass('row_selected');

            $(".btnduzenlemodal").removeClass('ajax');
            $(".btnduzenlemodal").click();

            setTimeout(function(){
                $(".btnduzenlemodal").attr('href', '#');
                $(".btnsil").attr('href', '#');

            },200);

            return;
        } else {
            $this.addClass('clicked');
            setTimeout(function() {
                $this.removeClass('clicked');
            }, 200);

            if ($(this).hasClass('row_selected')) {
                $("#" + ID).removeClass('row_selected');
                $(".btnsec").attr('href', '#');
                $(".btnduzenlemodal").removeClass('ajax');
                $(".btnduzenlemodal").attr('data-toggle', '');
                $(".btnduzenlemodal").attr('data-target', '');

                if(dt.table_name === 'anakod'){
                    $(".btnbuluntuolustur").attr('href', '#');
                }

                if(dt.table_name === 'buluntu'){
                    $(".btnenvanterlik").attr("data-id",0);
                    $(".btnkonservasyon").attr("data-id",0);
                }

                $("#dt_basic tbody tr").css("opacity","1");


            } else {
                var sil = "javascript:robo.data.delete('" + ID + "','" + dt.table_name + "')";
                $("#" + ID).addClass('row_selected');
                $(".btnduzenlemodal").addClass('ajax');
                $(".btnduzenlemodal").attr('href', 'index/' + dt.btn_edit + '/' + ID);

                $(".btnduzenlemodal").attr('data-toggle','');
                $(".btnduzenlemodal").attr('data-target','');

                $(".btnsil").attr('href', sil);

                if(dt.table_name === 'buluntu'){
                    $(".btnenvanterlik").attr("data-id", ID);
                    $(".btnkonservasyon").attr("data-id", ID);
                    $(".btnrestorasyon").attr("data-id", ID);
                }

                if(dt.table_name === 'anakod'){
                    $(".btnbuluntuolustur").attr('href', 'index/buluntu_ekle/' + ID);
                }

                var sec = $("#dt_basic tbody tr.row_selected");

                $("#dt_basic tbody tr").not(sec).css("opacity","0.5");
                $("#dt_basic tbody tr.row_selected").css("opacity","1");

            }
        }
    });

    $(".select2").select2();

    $(".select2").on('change',function(){
        var column = $(this).attr("data-column");
        var data = $(this).select2('data');
        var name = $(this).attr("name");
        var value = data.text;

        if(name === "envanterlik" && value !== "TÜMÜ"){
            value = data.id;
        }

        if(value === "TÜMÜ"){
            value = "";
        }

        dt.filter(value, column);
    });

    $('.dt_arama').keyup(function() {
        dt.filter($(this).val(), null);
    });

    $('.column_filter').on('keyup', function(e) {

        if(e.keyCode != 40 && e.keyCode != 38){
            var column = $(this).attr("data-column");
            var value = $(this).val();
            dt.filter(value, column);
        }else{
            $(this).focusout();
        }

    });

    $(document).unbind('keydown').bind('keydown', '#dt_basic tbody tr', function(e) {

        if (e.keyCode == 68 && e.altKey) {
            $(".btnduzenlemodal").trigger('click');
            //Duzenleme
        }

        if (e.keyCode == 79 && e.altKey) {
            $(".btnolusturmodal").trigger('click');
            //Olusturma
        }

        if (e.keyCode == 83 && e.altKey) {
            var ID = $("#dt_basic tbody tr.row_selected").attr("id");
            robo.data.delete(ID, dt.table_name);
            //Silme
        }

        if (e.keyCode == 32 && e.ctrlKey) {
            $(".anakod_search").focus();
            $(".anakod_search").val("");
            href_temizle();
            //alt space
            return false;
        }

        //console.log(e.keyCode);

        if(e.keyCode == 40){

            if(!$("#dt_basic tbody tr").hasClass("row_selected")){
                $("#dt_basic tbody tr:first").addClass("row_selected");
                $("#dt_basic tbody tr:first").focus();
            }else{
                var sec = $("#dt_basic tbody tr.row_selected");
                $(sec).removeClass("row_selected");
                $(sec).next('tr').addClass("row_selected");
            }

            td_select($("#dt_basic tbody tr.row_selected"));
            //ASAGI OK

        }

        if(e.keyCode == 38){
            var sec = $("#dt_basic tbody tr.row_selected");
            $(sec).removeClass("row_selected");
            $(sec).prev('tr').addClass("row_selected");

            td_select($("#dt_basic tbody tr.row_selected"));
            //YUKARI OK
        }

        if(e.keyCode == 27){
            href_temizle();
            //ESC
        }

    });

    document.ondblclick = function(evt) {
        //Double click isleminin sonunda secilmis olan text alani iptal eder..
        if (window.getSelection)
            window.getSelection().removeAllRanges();
        else if (document.selection)
            document.selection.empty();
    };

    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
    });

    $(".mask_char").keypress(function (e) {
        if (e.charCode === 32 || e.charCode === 0) {
            return true;
        }
        var regex = new RegExp("^[a-zA-ZşŞıİçÇöÖüÜĞğ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;

    });

    $(".mask_number").keypress(function (e) {
        if ((e.which != 44 && e.which != 46) && (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))) {
            return false;
        }
    });


});


function td_select(yeni){

    if($(yeni).hasClass("row_selected")){

        var ID = $(yeni).attr("id");

        var sil = "javascript:robo.data.delete('" + ID + "',"+ dt.table_name+ ")";
        $(".btnduzenlemodal").attr('href', 'index/' + dt.btn_edit + '/' + ID);
        $(".btnduzenlemodal").addClass('ajax');
        $(".btnsil").attr('href', sil);

        if(dt.table_name === 'anakod'){
            $(".btnbuluntuolustur").attr('href', 'index/buluntu_ekle/' + ID);
        }

        var sec = $("#dt_basic tbody tr.row_selected");

        $("#dt_basic tbody tr").not(sec).css("opacity","0.5");
        $("#dt_basic tbody tr.row_selected").css("opacity","1");

    }
}

function href_temizle(){
    $("#dt_basic tbody tr.row_selected").removeClass("row_selected");

    $(".btnsec").attr('href', '#');
    $(".btnduzenlemodal").removeClass('ajax');
    $(".btnduzenlemodal").attr('data-toggle', '');
    $(".btnduzenlemodal").attr('data-target', '');

    if(dt.table_name === 'buluntu'){
        $(".btnenvanterlik").attr("data-id","0");
        $(".btnkonservasyon").attr("data-id","0");
        $(".btnrestorasyon").attr("data-id","0");
    }

    if(dt.table_name === 'anakod'){
        $(".btnbuluntuolustur").attr('href', 'index/buluntu_ekle');
    }

    $("#dt_basic tbody tr").css("opacity","1");
}

function RefreshTable(tableId, urlData) {
    $.getJSON(urlData, null, function(json) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnClearTable(this);

        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        table.fnDraw();
    });
}

function strpos(haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}