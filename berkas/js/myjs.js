$(document).ready(function() {
    console.log(location.href);
    $("a[href$='"+ location.href +"']").parents('.collapse').addClass('show');
    $("a[href$='"+ location.href +"']").parent('li').addClass('bg-selector');
    $("a[href$='"+ location.href +"']").removeClass('text-body');
    $("a[href$='"+ location.href +"']").addClass('text-white'); 

    setTimeout ( function () {
        $('.loading-cs').hide();
    }, 100);

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

    function notifsuccess(note) {
        $('.loading-cs').hide();
        $('.notifikasi-cs').children('.alert').html(note);
        $('.notifikasi-cs').children('.alert').removeClass('alert-danger');
        $('.notifikasi-cs').children('.alert').addClass('alert-success');
        $('.notifikasi-cs').show();
        setTimeout(function () {
            $('.notifikasi-cs').hide();
        }, 1000);
    }

    function notiffailed(note) {
        $('.loading-cs').hide();
        $('.notifikasi-cs').children('.alert').html(note);
        $('.notifikasi-cs').children('.alert').removeClass('alert-success');
        $('.notifikasi-cs').children('.alert').addClass('alert-danger');
        $('.notifikasi-cs').show();
        setTimeout(function () {
            $('.notifikasi-cs').hide();
        }, 1000);
    }

    var table = $('#cobacoba').DataTable({
        responsive: true,
        pageLength: 100,
        ajax : 'ajaxalldata',
        createdRow : function( row, data, dataIndex ) {
            $(row).addClass('managementuser');
        },
        columns : [
            { "data": "no" },
            { "data": "uid" },
            { "data": "nama" },
            { "data": "role" },
            { "data": "bagian" }
        ]
    });

    var tabeldevisi = $('#tabeldevisi').DataTable({
        responsive: true,
        pageLength: 10,
        ajax : 'ajaxalldevisi',
        createdRow : function( row, data, dataIndex ) {
            $(row).addClass('managementdevisi');
        },
        columns : [
            { "data": "no" },
            { "data": "bagian" },
            { "data": "delete" }
        ]
    });

    $('body').on('click','.managementuser', function(event) {
        event.preventDefault();
        /* Act on the event */
        var ini = $(this);
        var uid = $(this).attr('id');
        if (uid==null) {
            return;
        }
        var htmluid = $(this).children('td').eq(1);
        var htmlnama = $(this).children('td').eq(2);
        var htmlrole = $(this).children('td').eq(3);
        var htmlbagian = $(this).children('td').eq(4);
        $.ajax({
            url: 'ajaxsingleuser/' + uid,
            type: 'get',
            dataType: 'json'
        })
        .done(function(response) {
            $('#ubahnama').show();
            $('#cuid').val(response.uid);
            $('#cuser').val(response.nama);
            $('#crole').val(response.role);
            $('#cdevisi').val(response.bagian);
            $('#ubahnama').modal('show');
            $('.close').on('click', function(event) {
                event.preventDefault();
                $('#ubahnama').modal('hide'); 
            });
            $('#saveuser').on('click',  function(event) {
                event.preventDefault();
                /* Act on the event */
                $('.loading-cs').show();
                $.ajax({
                    url: 'ajaxsaveuser',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        uid : $('#cuid').val(),
                        nama : $('#cuser').val(),
                        role : $('#crole').val(),
                        bagian : $('#cdevisi').val()
                    },
                })
                .done(function(respon1) {
                    if (respon1.message=='success'){
                        // bagus
                        $('.loading-cs').hide();
                        $('#ubahnama').modal('hide'); 
                        ini.addClass('text-info');
                        var role= 'User';
                        if (respon1.data.role==14) {
                            role= 'Admin';
                        };
                        notifsuccess('Data user was changed.');
                        htmluid.html(respon1.data.uid);
                        htmlnama.html(respon1.data.nama);
                        htmlrole.html(role);
                        htmlbagian.html(respon1.data.bnama);
                        setTimeout(function () {
                            ini.removeClass('text-info')
                        }, 2000);
                    }
                        
                })
                .fail(function(err) {
                    notiffailed('Nothing Changed');
                });
            });
            $("#deleteuser").on('click', function(event) {
                event.preventDefault();
                /* Act on the event */
                $('.loading-cs').show();
                var uid = $('#cuid').val();
                $.ajax({
                    url: 'ajaxdeleteuser',
                    type: 'post',
                    dataType: 'json',
                    data: {uid : uid},
                })
                .done(function(response) {
                    if (response.message=='success') {
                        // bagus
                        $('.loading-cs').hide();
                        $('#ubahnama').modal('hide');
                        notifsuccess('Data user was deleted.');
                        ini.addClass('text-danger');
                        setTimeout(function () {
                            table.row('#'+ uid).remove().draw( false );
                        }, 2000);
                    };
                })
                .fail(function() {
                    notiffailed('Nothing Deleted.');
                });
                
            });
            $(".sendregisteruser").on('click', function(event) {
                event.preventDefault();
                var mesinid = $(this).data('nomesin');
                var uid = $('#cuid').val();
                $('.loading-cs').show();
                $.ajax({
                    url: 'ajaxsendregister/'+ mesinid +'/'+ uid,
                    type: 'get',
                    dataType: 'json'
                })
                .done(function(respon2) {
                    if (respon2.message=='success') {
                        notifsuccess(respon2.data);
                    } else {
                        notiffailed(respon2.data);
                    }
                })
                .fail(function(error) {
                    notiffailed("Error can't be register.");
                });
            });
            $(".sendinfouser").on('click', function(event) {
                event.preventDefault();
                var mesinid = $(this).data('nomesin');
                var uid = $('#cuid').val();
                $('.loading-cs').show();
                $.ajax({
                    url: 'ajaxsendinfouser/'+ mesinid +'/'+ uid,
                    type: 'get',
                    dataType: 'json'
                })
                .done(function(respon2) {
                    if (respon2.message=='success') {
                        notifsuccess(respon2.data);
                    } else {
                        notiffailed(respon2.data);
                    }
                })
                .fail(function(error) {
                    notiffailed("Error can't be sent.");
                });
            });
        })
        .fail(function() {
            console.log("error");
        });
    });
    $('body').on('click', '#tambahuser', function(event) {
        event.preventDefault();
        /* Act on the event */
        var uid = $('#tuid').val();
        var nama = $('#tuser').val();
        var bagian = $('#tbagian').val();
        var role = $('#trole').val();
        $('.loading-cs').show();

        if (uid !== null && nama !== null) {
            $.ajax({
                url: 'ajaxtambahuser',
                type: 'post',
                dataType: 'json',
                data: {
                    tuid : uid,
                    tuser : nama,
                    trole : role,
                    tdevisi : bagian
                },
            })
            .done(function(response) {
                if (response.message=='success') {
                    $('#exampleModal').modal('hide');
                    notifsuccess(response.data);
                } else {
                    notiffailed(response.data);
                }
                table.ajax.reload();     
            })
            .fail(function() {
                notiffailed('Failed user to be add.');
            });   
        } else {
            notiffailed('Form check again.');
        }
    });
    $('body').on('click', '.deletedevisi', function(event) {
        event.preventDefault();
        /* Act on the event */
        var ini = $(this).parents('tr');
        var id = $(this).parents('tr').attr('id');
        console.log(id);
        $("#modaldelete").modal('show');
        $(".close").on('click', function(event) {
            event.preventDefault();
            /* Act on the event */
            $("#modaldelete").modal('hide');
            id = '';
            ini = '';
        });
        $(".cancel").on('click', function(event) {
            event.preventDefault();
            /* Act on the event */
            $("#modaldelete").modal('hide');
            id = '';
            ini = '';
        });
        $(".yadeletedevisi").on('click', function(event) {
            event.preventDefault();
            /* Act on the event */
            $.ajax({
                url: 'ajaxdeletedevisi',
                type: 'post',
                dataType: 'json',
                data: { dbagian : id}
            })
            .done(function(response) {
                $('#modaldelete').modal('hide');
                notifsuccess(response.data);
                ini.addClass('text-danger');
                setTimeout(function () {
                    tabeldevisi.row('#'+ id).remove().draw( false );
                }, 2000);
            })
            .fail(function() {
                notiffailed("Failed position deleted.")
            });
        });
    });
    $('body').on('click', '#tambahdevisi', function(event) {
        event.preventDefault();
        /* Act on the event */
        var tbagian = $('#tbagian').val();
        if (tbagian !=='') {
            $.ajax({
                url: 'ajaxtambahdevisi',
                type: 'post',
                dataType: 'json',
                data: {tbagian: tbagian}
            })
            .done(function(response) {
                $('#exampleModal').modal('hide');
                notifsuccess(response.data);
                tabeldevisi.ajax.reload(); 
            })
            .fail(function() {
                notiffailed('Error position to be add.')
            });
            
        } else {
            notiffailed('Form check again.');
        }
    });
});
