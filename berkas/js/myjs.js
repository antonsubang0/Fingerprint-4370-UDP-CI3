$(document).ready(function() {
    console.log(location.href);
    $("a[href$='"+ location.href +"']").parents('.collapse').addClass('show');
    $("a[href$='"+ location.href +"']").parent('li').addClass('bg-selector');
    $("a[href$='"+ location.href +"']").removeClass('text-body');
    $("a[href$='"+ location.href +"']").addClass('text-white'); 
    setTimeout ( function () {
        $('.loading-cs').hide();
    }, 300);

    setTimeout( function () {
      $('.notif-time').hide();
    },3000);

    $('.nav-ajs-cs').on("click", function () {
        $('.loading-cs').show();

        if ($('#download').is(":checked")){
            setTimeout ( function () {
                $('.loading-cs').hide();
            }, 3000);
        }
    });
    $('.ubahnama').on('click', function(event) {
        event.preventDefault();
        // console.log($(this).children('td').eq(3).html());
        if($(this).children('td').eq(3).html()=='ADMIN') {
            var role = 14;
        } else {
            var role = 0;
        };  
        console.log(role);
        $('#cuid').val($(this).children('td').eq(1).html());
        $('#cuser').val($(this).children('td').eq(2).html());
        $('#crole').val(role);
    });
});
