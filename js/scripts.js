$(document).ready(function () {
// Tablesorter
    $.extend($.tablesorter.themes.bootstrap, {
        table: 'table'
    });
    $(".tablesorter")
            .tablesorter({
                theme: "bootstrap",
                widthFixed: true,
                sortReset: true,
                headerTemplate: '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
                widgets: ["uitheme", "pager", "zebra"],
                widgetOptions: {
                    filter_reset: ".reset"
                }
            })
            .tablesorterPager({
                container: $(".pager"),
                cssGoto: ".pagenum",
                removeRows: false,
                output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
            });
// Popovers
    $(".popover-hover").popover({
        trigger: 'hover',
        html: true,
        container: 'body'
    });
    $(".popover-click, table#smallCal div.label").popover({
        trigger: 'click',
        html: true,
        container: 'body',
        placement: 'auto'
    });
    $("table#bigCal div.label").popover({
        trigger: 'click',
        html: true,
        container: 'body',
        placement: 'auto'
    });

    $(".modal-popover").popover({
        trigger: 'hover',
        placement: 'auto',
        html: true,
        container: 'body'
    });
// Tooltips
    $(".tooltips").tooltip({
        container: 'body',
        html: true
    });
// Form datepicker
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        todayHighlight: true,
        calendarWeeks: true,
        weekStart: 1,
        autoclose: true,
        language: "da"
    });
    $('.time').timepicker({
        showMeridian: false,
        template: false,
        showInputs: false,
        defaultTime: false
    });

// Select2
    $("select").select2({
        minimumResultsForSearch: -1,
        allowClear: true
    });

// iCheck
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
    });
});