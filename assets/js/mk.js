$(document).ready(function() {

    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
    });


});

function strpos(haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}

function RefreshTable(tableId, urlData) {
    $.getJSON(urlData, null, function(json) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnClearTable(this);

        //var data = localStorage.getItem('DataTables_' + window.location.pathname);
        //table.oApi._fnAddData(oSettings(JSON.parse(data)));


        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        table.fnDraw();
    });
}

