/*
 Coding by Murat Koker.
 */
var robo = function() {
    return{
        Form: function(form, newdata) {

            var hata = false;
            var req = $('form' + form + ' div#formdata').attr('validate');
            var url = jsPath + $('form' + form + ' div#formdata').attr('url');
            var method = $('form' + form + ' div#formdata').attr('method');
            var vtable = $('form' + form + ' div#formdata').attr('table');
            var vmd5 = $('form' + form + ' div#formdata').attr('md5');
            var vsorting = $('form' + form + ' div#formdata').attr('sorting');
            var dataord = $('form' + form + ' div#formdata').attr('data-ord');
            var formdata = $('form' + form + ' input, form' + form + ' select, form' + form + ' textarea').not('.ignore').serialize() + '&vtable=' + vtable + '&vsorting=' + vsorting + '&vdataord=' + dataord;


            if (newdata != undefined) {
                formdata = formdata + '&' + newdata;
            }

            if (vmd5 != undefined) {
                formdata = formdata + '&vmd5=' + vmd5;
            }


            if (req === "aktif") {
                $(".form-group").removeClass("has-iconed");
                $(".form-group").removeClass("has-error");

                $('form' + form + ' .required').not('.select2-container').each(function() {
                    var kontrol = $.trim($(this).val());
                    if ((kontrol == "") || (kontrol == null) || (kontrol == undefined)) {
                        $(this).parent().addClass("has-iconed");
                        $(this).parent().addClass("has-error");
                        hata = true;
                    }
                });
            }


            if (hata == false) {

                $(".form-group").removeClass("has-iconed");
                $(".form-group").removeClass("has-error");

                $.ajax({
                    type: method,
                    url: url,
                    data: formdata,
                    success: function(mk) {


                        if(vtable == 'anakod' && mk !== '0' && mk !== '1'){
                            robo.tamam('İşleminiz başarıyla tamamlandı.');
                            robo.info('<b>' + mk + '</b> nolu anakod oluşturuldu.');
                            return false;
                        }

                        if (mk == 1) {
                            robo.tamam('İşleminiz başarıyla tamamlandı.');
                            $(".btnduzenlemodal").attr('href', '#');
                            $(".btnsil").attr('href', '#');
                        } else if (mk == 2) {
                            robo.hata('Girdiğiniz şifreler uyuşmuyor!');
                        } else if (mk == 21) {
                            robo.hata('İşlem tamamlanamadı, <strong>Fatura</strong> sistemde mevcut!');
                        }else if (mk == 3) {
                            robo.hata('Şifrenizi eksik veya hatalı girdiniz.');
                        }
                        else if (mk == 112) {
                            robo.hata('Buluntu No daha önce sisteme kayıt edilmiş!');
                        }
                        else if (mk == 111) {
                            robo.tamam('İşleminiz başarıyla tamamlandı.');
                            $(".btnduzenlemodal").attr('href', '#');
                            $(".btnsil").attr('href', '#');
                        }
                        else {
                            //robo.hata(mk);
                            robo.hata('İşleminiz tamamlanamadı, lütfen tekrar deneyin!');
                        }
                    },
                    error: function() {
                        robo.hata('İşlem Tamamlanamadı!');
                    }
                });
            } else {
                //required true ise hata
                robo.hata('Lütfen zorunlu alanları doldurunuz!');
            }


        },
        dogrula: function(name) {
            $(".form-group").removeClass("has-iconed");
            $(".form-group").removeClass("has-error");
            var hata = false;

            $(name + ' .required').each(function() {
                var kontrol = $.trim($(this).val());
                if ((kontrol == "") || (kontrol == null) || (kontrol == undefined)) {
                    $(this).parent().parent().addClass("has-iconed");
                    $(this).parent().parent().addClass("has-error");
                    hata = true;
                }
            });

            if (hata == true) {
                return false;
            } else {
                return true;
            }
        },
        sortable: function(name) {
            $(name).sortable({
                opacity: 0.6,
                update: function() {
                    var url = jsPath + '/' + $('div#formdata').attr('data-url');
                    var vtable = $('div#formdata').attr('data-table');
                    var order = $(this).sortable("serialize") + '&action=updateRecordsListings&table=' + vtable + '&dataID=' + $('div#formdata').attr('data-id') + '&dataOrd=' + $('div#formdata').attr('data-ord');
                    $.post(url, order, function() {
                        robo.tamam('SIRALAMA DEĞİŞTİRİLDİ');
                        setTimeout('robo.kapat()', 4000);
                    });
                }
            });
        },
        duzenle: function() {
            if ($(".secilen_kayit").text() < 1) {
                swal("Hata!", "Bu işlem için önce kayıt seçmelisiniz.", "error");
                return false;
            }

            if (parseInt($(".secilen_kayit").text()) > 1) {
                swal("Hata!", "Sadece düzenlemek istediğiniz kayıt'ı seçmelisiniz.", "error");
                return false;
            }

            $(".duzenle_div").trigger('click');
        },
        sil: function(id, table) {
            swal({
                title: "Emin misiniz?",
                text: "Kaydı silmek için lütfen onaylayın, bu işlem geri alınamayacaktır.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Evet, silebilirsin',
                cancelButtonText: "Hayır, çık!",
                closeOnConfirm: true,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var formdata = 'ID=' + id + '&table=' + table;
                    var git = jsPath + 'post/sil';
                    $.post(git, formdata, function(data) {
                        if (data == 1) {

                            if (table === 'anakod') {
                                RefreshTable('#dt_basic', jsPath + 'index/anakod_listesi_data/');
                            }

                            if (table === 'buluntu_karti') {
                                RefreshTable('#dt_basic', jsPath + 'index/buluntu_listesi_data/');
                            }

                            if (table === 'acma_rapor') {
                                RefreshTable('#dt_basic', jsPath + 'index/acma_rapor_listesi_data/');
                            }

                            if (table === 'evrak_yonetimi') {
                                RefreshTable('#dt_basic', jsPath + 'index/evrak_listesi_data/gelen');
                            }


                            $(".btnduzenlemodal").attr('href', '#');
                            $(".btnsil").attr('href', '#');
                            robo.tamam("Kayıt sistemden silindi.");
                        } else {
                            robo.hata("Kayıt silinemedi, lütfen tekrar deneyin!");
                        }
                    });

                } else {
                    swal("Vazgeçildi", "İşleminiz iptal edildi.", "error");
                }
            });
        },
        sezon_aktif: function(id) {
            swal({
                    title: "Emin misiniz?",
                    text: "Aktif sezonu değiştirmek için onaylayınız..",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Evet, değiştir.',
                    cancelButtonText: "Hayır, çık!",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var formdata = 'ID=' + id;
                        var git = jsPath + 'index/sezon_aktif';
                        $.post(git, formdata, function(data) {
                            if (data !== '0') {

                                $(".sezonlar_tbody").html(data);

                                robo.tamam("Aktif sezon değiştirildi.");
                            } else {
                                robo.hata("Sezon değiştirilemedi, lütfen tekrar deneyin!");
                            }
                        });

                    } else {
                        swal("Vazgeçildi", "İşleminiz iptal edildi.", "error");
                    }
                });
        },
        dosya: function(name) {


            var folder = $('div#formdata1').attr('data-folder');
            var resize = $('div#formdata1').attr('data-resize');
            var width = $('div#formdata1').attr('data-width');
            var twidth = $('div#formdata1').attr('data-twidth');
            var thumb = $('div#formdata1').attr('data-thumb');
            var exts = $('div#formdata1').attr('data-ext');
            var gtable = $('div#formdata1').attr('table');

            //var extFile = '*.xls;*.xlsx;';
            var extFile = '*.jpg;*.jpeg;*.png;*.gif;*.bmp;';

            if(exts === 'file')
                extFile = '*.doc;*.docx;*.xls;*.xlsx;*.odt;*.ods;*.pdf;*.jpg;*.jpeg;*.png';


            $(name).uploadify({
                swf: jsPath + 'assets/img/uploadify.swf',
                uploader: jsPath + 'post/yukle/',
                fileTypeExts: extFile,
                fileTypeDesc: 'Dosyalar',
                buttonImage: jsPath + 'assets/img/upload_icon.png',
                width: 128,
                height: 128,
                'auto': true,
                'multi': true,
                'formData': {
                    'folderFile': folder,
                    'resize': resize,
                    'width': width,
                    'twidth': twidth,
                    'thumb': thumb,
                    'ext': exts
                },
                onUploadSuccess: function(file, data, response) {

                    if (data != 'error') {

                        var ap = '';
                        var d = '';

                        var xyol = 'galeri';
                        var uyari_ek = 'Görsel';

                        if(exts === "image"){
                            ap = '<li><img src="'+jsPath+'uploads/images/thumb/'+data+'"  width="150" height="120" alt="'+data+'" class="galeri_img"/><span><i class="fa fa-times fa-lg btngalerisil"></i></span></li>';

                            /*if (gtable == 'buluntu_galeri' && data == ''){
                                setTimeout(function(){

                                    $.get(jsPath + 'post/yuklenen_dosya',function(d){
                                        if (d != 'error'){
                                            data = d;
                                        }
                                    });

                                },2000);
                            }*/

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

                        $.post(jsPath + 'post/' + xyol,'table='+ gtable +'&dosya=' + data + d, function(data1){
                            if(data1 == "1"){
                                $(".galeri_popup").prepend(ap);
                                robo.tamam(uyari_ek + " Yüklendi.");
                            }else{
                                robo.hata(uyari_ek + " Yüklenemedi!");
                            }
                        });

                    } else {
                        robo.hata("Dosya Yüklenemedi!");
                    }
                }
            });
        },
        tamam: function(str) {
            $.smallBox({
                title: "Tamamlandı",
                content: "<i class='fa fa-clock-o'></i> <i>" + str + "</i>",
                color: "#659265",
                iconSmall: "fa fa-check fa-2x fadeInRight animated",
                timeout: 5000
            });
        },
        hata: function(str) {
            $.smallBox({
                title: "Hata!",
                content: "<i class='fa fa-clock-o'></i> <i>" + str + "</i>",
                color: "#C46A69",
                iconSmall: "fa fa-times fa-2x fadeInRight animated",
                timeout: 5000
            });
        },
        info: function(str) {
            $.smallBox({
                title: "Bilgilendirme!",
                content: "<i class='fa fa-clock-o'></i> <i>" + str + "</i>",
                color: "#9cb4c5",
                iconSmall: "fa fa-bell fa-2x fadeInRight animated",
                timeout: 5000
            });
        },
        kapat: function() {

        }
    };
}();