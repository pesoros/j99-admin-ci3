$(document).ready(function () {
    "use strict"; // Start of use strict

    //back to top
    $('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
    $(window).on("scroll", function () {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $('#toTop').on("click", function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    //lobipanel
    $('.lobidrag').lobiPanel({
        sortable: true,
        editTitle: {
            icon: 'ti-pencil'
        },
        unpin: {
            icon: 'ti-move'
        },
        reload: {
            icon: 'ti-reload'
        },
        minimize: {
            icon: 'ti-minus',
            icon2: 'ti-plus'
        },
        close: {
            icon: 'ti-close'
        },
        expand: {
            icon: 'ti-fullscreen',
            icon2: 'ti-fullscreen'
        }
    });

    $('.lobidisable').lobiPanel({
        reload: false,
        close: false,
        editTitle: false,
        sortable: true,
        unpin: {
            icon: 'ti-move'
        },
        minimize: {
            icon: 'ti-minus',
            icon2: 'ti-plus'
        },
        expand: {
            icon: 'ti-fullscreen',
            icon2: 'ti-fullscreen'
        }
    });

    //datatable
    $('.datatable').DataTable({ 
        responsive: true,  
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ] 
    });

    //datatable2
    $('.datatable2').DataTable({ 
        responsive: true, 
        paging: false,
        dom: "<'row'<'col-sm-8'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ] 
    });
 

    // select 2 dropdown 
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "Select option",
        allowClear: true
    });

    //datepicker
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        autoclose: true, 
        yearRange: "-90:+00"
    }); 

    //timepicker
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm:ss',
        stepMinute: 5,
        stepSecond: 15
    });

    //datetimepicker 
    $('.datetimepicker').appendDtpicker();


    //tags prevent duplicate
    $('.tokenfield').on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });


 
    //tinymce editor
    tinymce.init({
      selector: '.tinymce',
      height: 150,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars  fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | print preview media code | forecolor backcolor emoticons',
      image_advtab: true, 
       autoclose: true, 
     });
    //ends tinymce


    //preloader
    $(window).load(function() {
        $(".se-pre-con").fadeOut("slow");;
    });

    
  
});


//print a div
function printContent(el){
    var restorepage  = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    window.close();
    $('body').html(restorepage);
    location.reload();
}
 