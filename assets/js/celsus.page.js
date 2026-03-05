/**
 * Created by muratkoker on 18.09.2018.
 */

$(document).ready(function () {

    $(".btnkaydet").click(function () {

        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();

        form.submit("#formk");
        return false;
    });

    $('.btn-aktif').on('click', function () {
        $(this).hide();
        $('.btn-pasif').show();
        $('input[name=durum]').val('0');
        return false;
    });

    $('.btn-pasif').on('click', function () {
        $(this).hide();
        $('.btn-aktif').show();
        $('input[name=durum]').val('1');
        return false;
    });


    $(".gorsel_div").on('click', '.btngorselsil', function () {
        $(this).parent().parent().remove();
        galeri_img();

        return false;
    });


    $('.datepicker').mask('99.99.9999');
    //$('.mask_number').mask('99999999999');
    $('.mask_yil').mask('9999');
    $('.mask_tel').mask('0999 999 99 99');

    $("body").removeClass('modal-open');
    $("body").css('padding-right','0px');

    $(".mask_number").keypress(function (e) {
        if ((e.which != 44 && e.which != 46) && (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))) {
            return false;
        }
    });

});


function forceDownload(url, fileName){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function(){
        var urlCreator = window.URL || window.webkitURL;
        var imageUrl = urlCreator.createObjectURL(this.response);
        var tag = document.createElement('a');
        tag.href = imageUrl;
        tag.download = fileName;
        document.body.appendChild(tag);
        tag.click();
        document.body.removeChild(tag);
    }
    xhr.send();
}

function isWysiwygareaAvailable() {
    if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
        return true;
    }

    return !!CKEDITOR.plugins.get( 'wysiwygarea' );
}

function galeri_img(){
    var data = '';

    $(".gorsel_thumb .gorsel_div img").each(function(i, el){

        if ( i === 0) {
            data =  data + $(this).attr('data-name');
        }else{
            data = data + '#' + $(this).attr('data-name');
        }

    });

    $("#ust_gorsel").val(data);
}