/**
 * Created by muratkoker on 16.09.2018.
 */
var robo = {
    form: {

        url: '',
        method: 'POST',
        data: '',
        validate: false,
        updatefunc: '',


        submit: function(form){

            var update = this.updatefunc;
            var error = false;
            var formdata = $('form' + form + ' input, form' + form + ' select, form' + form + ' textarea').not('.ignore').serialize();

            if (this.url == undefined || this.url == ''){
                console.log("Robo: Url is required.");
                return false;
            }

            if (this.data != undefined && this.data != '') {
                formdata = formdata + '&' + this.data;
            }

            if (this.validate) {
                $(".form-group").removeClass("has-iconed");
                $(".form-group").removeClass("has-error");

                $('form' + form + ' .required').not('.select2-container').each(function() {
                    var control = $.trim($(this).val());
                    if ((control == "") || (control == null) || (control == undefined)) {
                        $(this).parent().addClass("has-iconed");
                        $(this).parent().addClass("has-error");
                        error = true;
                    }
                });
            }

            if (!error) {

                $(".form-group").removeClass("has-iconed");
                $(".form-group").removeClass("has-error");

                $.ajax({
                    type: this.method,
                    url: this.url,
                    data: formdata,
                    success: function(mk) {

                        var json = JSON.parse(mk);

                        if(json.success && (json.anakod != undefined && json.anakod != '')){
                            robo.msg.okey("Tamamlandı",'İşleminiz başarıyla tamamlandı.');
                            robo.msg.info("Bilgilendirme!", '<b>' + json.anakod + '</b> nolu anakod oluşturuldu.');
                            return false;
                        }

                        if (json.success) {
                            robo.msg.okey(json.msg_title, json.msg_text);
                            $(".btnduzenlemodal").attr('href', '#');
                            $(".btnsil").attr('href', '#');
                        }  else {
                            robo.msg.error(json.msg_title, json.msg_text);

                            if(json.data_id == '#'){
                                setTimeout(function(){
                                    location.href = jsPath;
                                },1500);
                            }
                        }

                        if(update != ''){
                            $.get(update);
                        }

                    },
                    error: function() {
                        robo.msg.error("Hata!","İşlem Tamamlanamadı!");
                    }
                });
            } else {
                robo.msg.error("Hata!","Lütfen zorunlu alanları doldurunuz!");
            }
        },
        use: {

            editor_height: 150,

            select2: function(){
                $(".select2").select2({allowClear: true, placeholder: "Seçim yapın.." });
            },
            ckeditor: function(name){

                if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
                    CKEDITOR.tools.enableHtml5Elements( document );

                CKEDITOR.config.height = this.editor_height;
                CKEDITOR.config.width = 'auto';

                var wysiwygareaAvailable = isWysiwygareaAvailable(),
                    isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

                var editorElement = CKEDITOR.document.getById( name );

                // Depending on the wysiwygare plugin availability initialize classic or inline editor.
                if ( wysiwygareaAvailable ) {
                    CKEDITOR.replace( name, {
                        cloudServices_tokenUrl: jsPath + 'index/token',
                        cloudServices_uploadUrl: ''
                    });

                } else {
                    editorElement.setAttribute( 'contenteditable', 'true' );
                    CKEDITOR.inline( name );
                    editorElement.window.$.getSelection().removeAllRanges();
                }

            },
            datepicker: function(){

                $('.datepicker').Zebra_DatePicker({
                    show_icon: true,
                    show_select_today: false,
                    default_position: 'below',
                    offset: [-120, -10],
                    readonly_element: false
                });

            }
        }
    },
    file: {

        folder: '',
        image_resize: false,
        image_width: '',
        image_thumb: false,
        image_twidth: '',
        file_type: 'image',
        file_exts: '.jpg,.jpeg,.png,.gif,.bmp',
        post_table: '',
        upload: function(name){

            if(this.file_type === 'file')
                this.file_exts = '.doc,.docx,.xls,.xlsx,.odt,.ods,.pdf,.jpg,.jpeg,.png';

            var table = this.post_table;
            var type = this.file_type;

            var folderFile = this.folder;
            var resize = this.image_resize;
            var width = this.image_width;
            var twidth = this.image_twidth;
            var thumb = this.image_thumb;
            var exts = this.file_exts;

            $(name).dropzone({
                url: jsPath + 'post/yukle',
                paramName: "file",
                acceptedFiles: exts,
                addRemoveLinks : false,
                maxFilesize: 100,
                uploadMultiple: false,
                parallelUploads: 5,
                maxFiles: 20,
                dictResponseError: 'Error uploading file!',
                init: function() {
                    var cd;

                    this.on("sending", function(file, xhr, formData) {
                        formData.append("folderFile", folderFile);
                        formData.append("resize", resize);
                        formData.append("width", width);
                        formData.append("twidth", twidth);
                        formData.append("thumb", thumb);
                        formData.append("ext", type);
                    });

                    this.on("success", function(file, response) {
                        $('.dz-progress').hide();
                        $('.dz-size').hide();
                        $('.dz-error-mark').hide();
                        //console.log(response);
                        //console.log(file);
                        cd = response;

                        var data = cd;

                        if (data !== 'error') {

                            var ap = '';
                            var d = '';

                            var xyol = 'galeri';
                            var uyari_ek = 'Görsel';

                            if(type === "image"){
                                ap = '<li><img src="'+jsPath+'uploads/images/thumb/'+data+'"  width="150" height="120" alt="'+data+'" class="galeri_img"/><span><i class="fa fa-times fa-lg btngalerisil"></i></span></li>';

                            }else{

                                uyari_ek = 'Dosya';
                                var uzanti = data.split('.');
                                uzanti = uzanti[1];

                                var file = 'diger.png';

                                switch (uzanti){
                                    case "jpg":
                                    case "jpeg":
                                    case "png":
                                        file = 'jpeg.png';
                                        break;
                                    case "pdf":
                                        file = 'pdf.png';
                                        break;
                                    case "doc":
                                    case "docx":
                                    case "odt":
                                        file = 'word.png';
                                        break;
                                    case "xls":
                                    case "xlsx":
                                    case "ods":
                                        file = 'excel.png';
                                        break;
                                    default:
                                        file = 'diger.png';

                                }

                                ap = '<li><img src="'+jsPath+'assets/img/file_icon/'+file+'"  width="96" height="96" data-name="'+data+'"  alt="'+data+'" class="galeri_img"/><span><i class="fa fa-times fa-lg btngalerisil"></i></span></li>';
                            }

                            $.post(jsPath + 'post/' + xyol,'table='+ table +'&dosya=' + data + d, function(data1){
                                if(data1 == "1"){
                                    $(".galeri_popup").prepend(ap);
                                    robo.msg.okey("Tamamlandı", uyari_ek + " Yüklendi.");
                                }else{
                                    robo.msg.error("Hata!",uyari_ek + " Yüklenemedi!");
                                }
                            });

                        } else {
                            robo.msg.error("Hata!", "Dosya Yüklenemedi!");
                        }


                    });
                }
            });

        }

    },
    data: {
        load: function(name, element, method){

            var select = ' .select2';
            var event = 'select2-open';

            if(method == '' || method == undefined || method === 'search'){
                select = ' .select2-input';
                event = 'keypress';
            }

            $(element + select).on(event, function(){

                var value = $(this).val();
                var q = '';

                if(method == '' || method == undefined || method === 'search')
                    q = value;

                var selectdata = $(element + ' .select2').select2("data");

                if(!$(element).hasClass('hasOpen') || method === 'search'){

                    $.ajax({
                        type: 'GET',
                        url: jsPath + 'index/select_data/'+ name +'?q=' + q,
                        success: function(data) {
                            if(data != undefined && data != ''){

                                var json = JSON.parse(data);
                                var result = json.results;

                                var x = '<option value=""></option>';
                                var id = 0;
                                var selected = '';

                                if(selectdata != null )
                                    id = selectdata.id;

                                if(id > 0 && method == 'search'){
                                    x = x + '<option value="'+ id +'" selected>' + selectdata.text + '</option>';
                                }

                                for(var k in result){
                                    selected = '';
                                    if((id == result[k].id) && method == "open"){selected = 'selected';}

                                    if(selectdata != null){
                                        if(selectdata.length > 1){
                                            for(var a in selectdata){
                                                if(method == "open" && result[k].id == selectdata[a].id){selected = 'selected';}
                                            }
                                        }
                                    }


                                    x = x + '<option value="'+result[k].id+'" '+selected+'>' + result[k].text + '</option>';
                                }

                                $(element + ' select').empty().append(x);

                                if(method === 'open'){
                                    $(element).addClass('hasOpen');
                                    $(element + ' select').data().select2.search.trigger('keyup-change');
                                }

                            }
                        }
                    });

                }

            });
        },
        list_edit: function(id, tip){

            var list_adi = $("#" + id + " td:eq(1)").text();
            var form = $("#" + id + " td:eq(2)").text();

            $("input[name=list_adi]").val(list_adi);
            $("input[name=list_id]").val(id);

            $(".tip_select").val(tip).trigger('change');
            $(".form_select").val(form).trigger('change');

            $(".btnlisteolustur").hide();
            $(".btnlistekaydet").show();
            $(".btnlisteback").show();

        },
        envanterlik: function(id){

            var anakod = $("#" + id + " td:eq(0)").html();
            var buluntu = $("#" + id + " td:eq(1)").html();

            swal({
                    title: "Emin misiniz?",
                    html: true,
                    text: "Yapacağınız işlem sonucunda <b>"+anakod + " " + buluntu +"</b> nolu buluntunun <b>Envanterlik</b> durumu değiştirilecektir.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#D0D0D0',
                    confirmButtonText: 'Evet, eminim.',
                    cancelButtonText: "Hayır, çık!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var formdata = 'id=' + id;
                        var git = jsPath + 'post/envanterlik';
                        $.post(git, formdata, function(data) {
                            if (data == 1) {
                                swal("Tamamlandı", "İşleminiz başarıyla gerçekleşti.", "success");
                                robo.datatable.refresh();
                                href_temizle();
                            } else if(data == 2 || data == 3){
                                swal({ html: true,  type: "warning", title:'Uyarı', text:'Seçmiş olduğunuz buluntu ' + year + ' <b>Envanterlik</b> listesinden çıkarıldı.'});
                                robo.datatable.refresh();
                                href_temizle();
                            } else {
                                swal("Hata", "İşleminiz gerçekleşmedi, lütfen terkar deneyiniz.", "error");
                            }
                        });

                    } else {
                        swal("Vazgeçildi", "İşleminiz iptal edildi.", "error");
                    }
                });
        },
        konservasyon: function(id){
            $.post(jsPath + 'index/konservasyon_get', 'id=' + id, function(data){

                if(data == 1){

                    $(".btnkonservasyon_islem").removeClass("ajax");
                    $(".btnkonservasyon_islem").attr("href", "index/konservasyon_detay/" + id + "/0");
                    $(".btnkonservasyon_islem").attr("data-toggle","modal");
                    $(".btnkonservasyon_islem").attr("data-target","#remoteModal");
                    $(".btnkonservasyon_islem").trigger('click');

                }else if(data == 0){
                    swal("Hata", "Seçmiş olduğunuz buluntu, konservasyon kriterlerini taşımıyor.", "error");
                    href_temizle();
                }else{

                    $(".btnkonservasyon_islem").attr("data-toggle","");
                    $(".btnkonservasyon_islem").attr("data-target","");

                    $(".btnkonservasyon_islem").addClass("ajax");
                    $(".btnkonservasyon_islem").attr("href", "index/konservasyon_islem/" + id + "/0/" + data);
                    $(".btnkonservasyon_islem").trigger('click');

                }
            });
        },
        restorasyon: function(id){
            $.post(jsPath + 'index/restorasyon_get', 'id=' + id, function(data){

                if(data == 1){

                    $(".btnrestorasyon_islem").removeClass("ajax");
                    $(".btnrestorasyon_islem").attr("href", "index/restorasyon_detay/" + id + "/0");
                    $(".btnrestorasyon_islem").attr("data-toggle","modal");
                    $(".btnrestorasyon_islem").attr("data-target","#remoteModal");
                    $(".btnrestorasyon_islem").trigger('click');

                }else if(data == 0){
                    swal("Hata", "Seçmiş olduğunuz buluntu, restorasyon kriterlerini taşımıyor.", "error");
                    href_temizle();
                }else{

                    $(".btnrestorasyon_islem").attr("data-toggle","");
                    $(".btnrestorasyon_islem").attr("data-target","");

                    $(".btnrestorasyon_islem").addClass("ajax");
                    $(".btnrestorasyon_islem").attr("href", "index/restorasyon_islem/" + id + "/0/" + data);
                    $(".btnrestorasyon_islem").trigger('click');

                }
            });
        },
        delete: function(id, table) {
            swal({
                    title: "Emin misiniz?",
                    text: "Kaydı silmek için lütfen onaylayın.",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    closeOnCancel: false,
                    cancelButtonText: "Hayır, çık!",
                    confirmButtonColor: '#D0D0D0',
                    confirmButtonText: 'Evet, silebilirsin',
                    reverseButtons: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var formdata = 'ID=' + id;
                        var git = jsPath + 'post/delete/' + table;
                        $.post(git, formdata, function(data) {

                            var json = JSON.parse(data);

                            if (json.success) {
                                robo.msg.okey(json.msg_title, json.msg_text);
                                $(".btnduzenlemodal").attr('href', '#');
                                $(".btnsil").attr('href', '#');

                                robo.datatable.refresh();
                            }  else {
                                robo.msg.error(json.msg_title, json.msg_text);
                            }

                        });

                    } else {
                        swal("Vazgeçildi", "İşleminiz iptal edildi.", "error");
                    }
                });
        },
        time_difference: function(time_calc){
            var x = Math.round((new Date()).getTime() / 1000);

            var time_difference = x - time_calc;
            var seconds = time_difference;
            var minutes = Math.round(time_difference / 60);
            var hours = Math.round(time_difference / 3600);
            var days = Math.round(time_difference / 86400);

            var saniye;
            var dakika;
            var saat;
            var gun;
            var hesap;


            if (seconds <= 60) {
                saniye = seconds + " saniye";
            }
            else if (seconds > 60 && minutes <= 60) {

                if (minutes == 1) {
                    dakika = "1 dakika";
                }

                if(minutes > 1){
                    dakika = " " + minutes + " dakika";
                }
            }
            else if (hours <= 24) {

                if (hours == 1) {
                    saat = "1 saat";
                }

                if(hours >= 1){
                    saat = " " + hours + "  saat";

                    hesap = hours * 60;
                    dakika = " " + Math.abs(hesap - minutes) + " dakika";
                }

            }
            else {

                if (days == 1) {
                    gun = "1 gün";
                } else {
                    gun = days + " gün";
                }
            }

            var sonuc = '';

            if(gun != undefined && gun !== 'NaN')
                sonuc = sonuc + gun;

            if(saat != undefined && saat !== 'NaN')
                sonuc = sonuc + saat;

            if(dakika != undefined && dakika !== 'NaN')
                sonuc = sonuc + dakika;

            if(saniye != undefined && saniye !== 'NaN')
                sonuc = sonuc + saniye;

            return sonuc;
        }
    },
    datatable: {

        oTable: null,
        table_id : null,
        serverside: true,
        source: '',
        sorting_column: 0,
        sorting: 'desc',
        display_length: 25,
        colvis_exclude: '',
        prev_text: 'Önceki',
        next_text: 'Sonraki',

        table_name: '',
        btn_edit: '',
        btn_detail: '',
        popup_print: true,
        popup_detail: true,

        run: function(name){

            this.table_id = name;
            var table = this.table_name;
            var btn_edit = this.btn_edit;
            var btn_detail = this.btn_detail;
            var popup_print = this.popup_print;
            var popup_detail = this.popup_detail;


            this.oTable = $(name).dataTable({
                "bProcessing": false,
                "bServerSide": this.serverside,
                "sAjaxSource": this.source,
                "aaSorting": [[this.sorting_column, this.sorting]],
                "iDisplayLength": this.display_length,
                "sDom": "<'dt-toolbar'C>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": this.prev_text,
                        "sNext": this.next_text
                    }
                },
                "oColVis": {
                    "aiExclude": this.colvis_exclude
                },
                "aoColumnDefs": [],
                "fnServerData": function(sSource, aoData, fnCallback) {
                    $.ajax({
                        "dataType": 'json',
                        "type": "POST",
                        "url": sSource,
                        "data": aoData,
                        "success": fnCallback
                    });
                },
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                    $(nRow).attr("ID", aData[0]);


                    var zero = '/0';
                    var printed = '';
                    var detail = '';
                    //var envanter = '';
                    var print_move = '';


                    if(!popup_print){
                        zero = '';
                        printed = 'display:none;';
                    }


                    if(!popup_detail)
                        detail = 'display:none;';

                    /*
                    if(table !== 'buluntu'){
                        envanter = 'display:none';
                        print_move = 'margin-left: 220px;';
                    }*/

                    var append = '<td class="td_toolbar"><ul>';

                    append += '<li><a href="javascript:robo.print.show(\'index/'+btn_detail+'/'+ aData[0] +'/1\');" class="btntool" style="'+ printed + print_move + '" ><i class="fa fa-print fa-lg"></i></a></li>';
                    append += '<li><a href="index/'+btn_detail+'/'+ aData[0] +'" class="btntool" data-toggle="modal" data-target="#remoteModal" style="'+detail+'"><i class="fa fa-search fa-lg"></i></a></li>';

                    if(table == 'listeler'){
                        append += '<li><a href="javascript:robo.data.list_edit('+aData[0]+','+aData[4]+');" class="btntool"><i class="fa fa-pencil fa-lg"></i></a></li>';
                    }else{
                        append += '<li><a href="index/'+btn_edit+'/'+aData[0]+'" class="btntool ajax"><i class="fa fa-pencil fa-lg"></i></a></li>';
                    }

                    append += '<li><a href="javascript:robo.data.delete(\''+aData[0]+'\',\'' + table + '\');" class="btntool"><i class="fa fa-trash fa-lg"></i></a></li>';
                    append += '</ul></td>';

                    $(nRow).append(append);

                    //append += '<li><a href="javascript:robo.data.envanterlik('+aData[0]+');" class="btntool" style="'+envanter+'"><i class="fa fa-tags fa-lg"></i></a></li>';
                    //append += '<li><a href="javascript:robo.data.konservasyon('+aData[0]+');" class="btntool" style="'+envanter+'"><i class="fa fa-file-text fa-lg"></i></a></li>';
                    //append += '<li><a href="javascript:robo.data.restorasyon('+aData[0]+');" class="btntool" style="'+envanter+'"><i class="fa fa-list-alt fa-lg"></i></a></li>';

                    if(table === 'buluntu' && aData[14] == 1)
                        $(nRow).addClass('row_selected_envanterlik');


                    if (table === 'acma_rapor') {
                        $('td:eq(0)', nRow).html(aData[1].replace('\\',''));
                    }

                    if (table === 'islem_gecmisi') {
                        $('td:eq(1)', nRow).html(aData[1].replace('\\',''));
                    }

                    if (table === 'yayinlar') {
                        $('td:eq(0)', nRow).html(aData[1].replace('\\',''));
                        $('td:eq(1)', nRow).html(aData[2].replace('\\',''));
                    }
                    
                    if (table === 'evrak') {
                        $('td:eq(0)', nRow).html(aData[1].replace('\\',''));
                        $('td:eq(1)', nRow).html(aData[2].replace('\\',''));
                    }





                    if (table === 'kullanici') {

                        if (aData[7] == 0)
                            $(nRow).addClass('row_selected_pasif');


                        if(aData[3] == 0){
                            $('td:eq(3)', nRow).html('');
                            $('td:eq(4)', nRow).html('');
                        }else{
                            $('td:eq(3)', nRow).html('<font color="#006400">Evet</font>');
                            $('td:eq(4)', nRow).html(robo.data.time_difference(aData[4]));
                        }

                        if (aData[6] == 'S')
                            $('td:eq(6)', nRow).html('<font color="red">Supervisor</font>');

                        if (aData[6] == 'D')
                            $('td:eq(6)', nRow).html('Düzenleme');

                        if (aData[6] == 'O')
                            $('td:eq(6)', nRow).html('Oluşturma');

                        if (aData[6] == 'G')
                            $('td:eq(6)', nRow).html('Görüntüleme');

                    }

                    if(table === 'konservasyon'){
                        $(nRow).attr("data-tip", aData[6]);
                        var str = aData[6];
                        str = str.charAt(0).toUpperCase() + str.substr(1);
                        $('td:eq(5)', nRow).html(str.replace('Tas', 'Taş'));
                    }


                    if(table === 'restorasyon'){
                        $(nRow).attr("data-tip", aData[6]);
                        var str = aData[4];
                        str = str.charAt(0).toUpperCase() + str.substr(1);
                        $('td:eq(3)', nRow).html(str.replace('Tas', 'Taş'));
                    }

                    if(table === 'islem_gecmisi'){
                        var str = aData[3];

                        if(str == 'Oluşturuldu'){
                            $(nRow).addClass('row_olusturuldu');
                        }else{
                            $(nRow).addClass('row_guncellendi');
                        }

                        $('td:eq(2)', nRow).html('<span class="row_kayit_tipi">'+aData[2]+'</span>');
                    }

                    return nRow;
                },
                "preDrawCallback": function() {
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(name), breakpointDefinition);
                    }
                },
                "rowCallback": function(nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function(oSettings) {
                    responsiveHelper_dt_basic.respond();
                }

            });

            return this.oTable;
        },
        visible: function(id){
            this.oTable.fnSetColumnVis(id, false, false);
        },
        filter: function(value, column){
            this.oTable.fnFilter(value, column, false);
        },
        refresh: function(){
            this.oTable.fnDraw();
        }
    },
    print: {
        message: 'Yazdırılıyor',

        show: function(url){
            $("body").append(robo.print.messageBox(this.message));
            $("#printMessageBox").css("opacity", 0);
            $("#printMessageBox").animate({opacity:1}, 300, function() { robo.print.addIframeToPage(url); });
        },
        addIframeToPage: function (url){
            if(!$('#printPage')[0]){
                $("body").append(robo.print.iframe(url));
                $('#printPage').on("load",function() {  robo.print.printit();  });
            }else{
                $('#printPage').attr("src", url);
            }
        },
        printit: function(){
            frames.printPage.focus();
            frames.printPage.print();

            robo.print.unloadMessage();
        },
        unloadMessage: function(){
            $("#printMessageBox").delay(1000).animate({opacity:0}, 300, function(){
                $(this).remove();
                $("#printPage").remove();
            });
        },
        iframe: function(url){
            return '<iframe id="printPage" name="printPage" src='+url+' style="position: absolute; top: -1000px; @media print { display: block; }"></iframe>';
        },
        messageBox: function(message){
            return "<div id='printMessageBox' style='\
          position:fixed;\
          top:50%; left:50%;\
          text-align:center;\
          margin: -60px 0 0 -155px;\
          width:310px; height:150px; font-size:16px; padding:10px; color:#222; font-family:helvetica, arial;\
          opacity:0;\
          background:#fff url(data:image/gif;base64,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) center 40px no-repeat;\
          border: 6px solid #555;\
          border-radius:8px; -webkit-border-radius:8px; -moz-border-radius:8px;\
          box-shadow:0px 0px 10px #888; -webkit-box-shadow:0px 0px 10px #888; -moz-box-shadow:0px 0px 10px #888'>\
          "+message+"</div>";
        }
    },
    msg: {
        okey: function(title, message){

            $.smallBox({
                title: title,
                content: "<i class='fa fa-clock-o'></i> <i>" + message + "</i>",
                color: "#659265",
                iconSmall: "fa fa-check fa-2x fadeInRight animated",
                timeout: 5000
            });

        },
        error: function(title, message){

            $.smallBox({
                title: title,
                content: "<i class='fa fa-clock-o'></i> <i>" + message + "</i>",
                color: "#C46A69",
                iconSmall: "fa fa-times fa-2x fadeInRight animated",
                timeout: 5000
            });

        },
        info: function(title, message){

            $.smallBox({
                title: title,
                content: "<i class='fa fa-clock-o'></i> <i>" + message + "</i>",
                color: "#9cb4c5",
                iconSmall: "fa fa-bell fa-2x fadeInRight animated",
                timeout: 5000
            });

        }

    }
};