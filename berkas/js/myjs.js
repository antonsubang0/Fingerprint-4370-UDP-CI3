$(document).ready(function() {
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

        if ($('#downloadhoriz').is(":checked")){
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
    $('body').on('click', '.downloaduser', function(event) {
        event.preventDefault();
        /* Act on the event */
        var url = $(this).attr('href');
        $('.loading-cs').show();
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json'
        })
        .done(function(response) {
            if (response.message=='success') {
                notifsuccess(response.data);
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Check Connection.');
        });  
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
                        uid : uid,
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
            notiffailed("Error.");
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
                if (response.message=='success') {
                    notifsuccess(response.data);
                    ini.addClass('text-danger');
                    setTimeout(function () {
                        tabeldevisi.row('#'+ id).remove().draw( false );
                    }, 2000);    
                } else {
                    notiffailed(response.data);
                }                
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
                if (response.message=='success') {
                    notifsuccess(response.data);
                    tabeldevisi.ajax.reload();    
                } else {
                    notiffailed(response.data);
                }
                 
            })
            .fail(function() {
                notiffailed('Error position to be add.')
            });
        } else {
            notiffailed('Form check again.');
        }
    });
    $('body').on('click', '.downloadabsen', function(event) {
        event.preventDefault();
        /* Act on the event */
        var url = $(this).attr('href');
        $('.loading-cs').show();
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json'
        })
        .done(function(response) {
            if (response.message=='success') {
                notifsuccess(response.data);
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Check Connection.');
        });      
    });
    $('body').on('change', '#changeStatus', function(event) {
        event.preventDefault();
        /* Act on the event */
        var no = $(this).parents('tr').attr('id');
        var status = $(this).val();
        var ini = $(this);
        var warnatgl = $(this).parents('tr').children('td').eq(4);
        $('.loading-cs').show();
        $.ajax({
            url: 'report/ajaxubahstatus',
            type: 'post',
            dataType: 'json',
            data: { 
                no : no,
                status : status
            },
        })
        .done(function(response) {
            if (response.message=='success') {
                notifsuccess(response.data);
                if (status==0) {
                    setTimeout(function () {
                        ini.removeClass('text-warning');
                        ini.removeClass('text-danger');
                        ini.addClass('text-success');
                        warnatgl.removeClass('text-warning');
                        warnatgl.removeClass('text-danger');
                        warnatgl.addClass('text-success');
                    }, 1500);
                } 
                if (status==1) {
                    setTimeout(function () {
                        ini.removeClass('text-warning');
                        ini.removeClass('text-success');
                        ini.addClass('text-danger');
                        warnatgl.removeClass('text-warning');
                        warnatgl.removeClass('text-success');
                        warnatgl.addClass('text-danger');
                    }, 1500);
                }
                if (status==5) {
                    setTimeout(function () {
                        ini.removeClass('text-danger');
                        ini.removeClass('text-success');
                        ini.addClass('text-warning');
                        warnatgl.removeClass('text-danger');
                        warnatgl.removeClass('text-success');
                        warnatgl.addClass('text-warning');
                    }, 1500);
                }
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Nothing Changed.');
        });      
    });
    $('body').on('click', '.deleteabsensi', function(event) {
        event.preventDefault();
        /* Act on the event */
        var id = $(this).parents('tr').attr('id');
        var ini = $(this).parents('tr');
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
        $(".yadeleteabsen").on('click', function(event) {
            event.preventDefault();
            $('.loading-cs').show();
            /* Act on the event */
            $.ajax({
                url: 'report/ajaxdeleteabsensi',
                type: 'post',
                dataType: 'json',
                data: { no: id},
            })
            .done(function(response) {
                $('#modaldelete').modal('hide');
                if (response.message=='success') {
                    notifsuccess(response.data);
                    ini.addClass('text-danger');
                    setTimeout(function () {
                        tabelreport.row('#'+ id).remove().draw( false );
                    }, 2000);
                } else {
                    notiffailed(response.data);
                }
            })
            .fail(function() {
                notiffailed('Error delete data');
            });
            
        });
    });
    $('body').on('click', '.addrecord', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('#TambahAtt').modal('hide');
        var num = $('#lastnum').html();
        var uid = $('#ruser').val();
        var status = $('#rstatus').val();
        var time = $('#datetimepicker').val();
        $.ajax({
            url: 'report/ajaxaddabsensi',
            type: 'post',
            dataType: 'json',
            data: { 
                uid : uid,
                inout : status,
                time : time
            },
        })
        .done(function(response) {
            var tgla = new Date((response.data1.time-(90*60))*1000);
            var tglb = tgla.toLocaleString('id-ID').split('/');
            var tglc = tglb[2].split('.');
            var tgld = tglb[0] + '-' +  tglb[1] +'-'+ tglc[0] + ':' + tglc[1] +':'+ tglc[2];
            if (response.data1.inout==0) {
                var inout = `<select id='changeStatus' class='form-control text-success' name='inout[]'>
                                <option class='text-danger' value='1'>Keluar</option>
                                <option class='text-success' value='0' selected>Masuk</option>
                                <option class='text-warning' value='5'>Mengulang</option>
                            </select>`;
                var tgl = `<label class='text-success'>`+ tgld +`</label>`;
            }
            if (response.data1.inout==1) {
                var inout = `<select id='changeStatus' class='form-control text-danger' name='inout[]'>
                                <option class='text-danger' value='1' selected>Keluar</option>
                                <option class='text-success' value='0'>Masuk</option>
                                <option class='text-warning' value='5'>Mengulang</option>
                            </select>`;
                var tgl = `<label class='text-danger'>`+ tgld +`</label>`;
            }

            if (response.data1.inout==5) {
                var inout = `<select id='changeStatus' class='form-control text-warning' name='inout[]'>
                                <option class='text-danger' value='1'>Keluar</option>
                                <option class='text-success' value='0'>Masuk</option>
                                <option class='text-warning' value='5' selected>Mengulang</option>
                            </select>`;
                var tgl = `<label class='text-warning'>`+ tgld +`</label>`;
            }
              
            if (response.message=='success') {
                notifsuccess(response.data);
                tabelreport.row.add( [
                    num,
                    response.data1.uid,
                    response.data1.nama,
                    response.data1.bnama,
                    tgl,
                    inout,
                    "<b><svg class='text-danger deleteabsensi' xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-x' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/></svg></b>"
                ]).draw( false ).node().id=response.data1.no;
                num++;
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Failed add record.');
        });
    });
    $('body').on('click', '#showhoriz', function() {
        /* Act on the event */
        $('.showcount').hide();
        $('#showcount').prop('checked', false);
    });
    $('body').on('click', '#downloadhoriz', function() {
        /* Act on the event */
        $('.showcount').show();
    });
    $('body').on('click', '.restartmesin', function(event) {
        event.preventDefault();
        /* Act on the event */
        var mesin = $(this).data('mesin');
        $('.loading-cs').show();
        $.ajax({
            url: 'setting/ajaxrestartmesin/' + mesin,
            type: 'get',
            dataType: 'json'
        })
        .done(function(response) {
            if (response.message=='success') {
                notifsuccess(response.data);
                tabelmachine.ajax.reload();
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Error.');
        });   
    });
    $('body').on('click', '.deletemesin', function(event) {
        event.preventDefault();
        /* Act on the event */
        var mesin = $(this).data('mesin');
        $.ajax({
            url: 'setting/ajaxdeletemesin/' + mesin,
            type: 'get',
            dataType: 'json'
        })
        .done(function(response) {
            if (response.message=='success') {
                notifsuccess(response.data);
                tabelmachine.ajax.reload();
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Error.');
        });   
    });
    $('body').on('click', '#addmachine', function(event) {
        event.preventDefault();
        /* Act on the event */
        var namamesin = $('#addnamamesin').val();
        var ipmesin = $('#addipmesin').val();
        $.ajax({
            url: 'setting/ajaxaddmesin',
            type: 'post',
            dataType: 'json',
            data: {
                ip : ipmesin,
                nama : namamesin
            },
        })
        .done(function(response) {
            if (response.message=='success') {
                notifsuccess(response.data);
                tabelmachine.ajax.reload();
                $('#exampleModal').modal('hide');
                $('#addnamamesin').val('');
                $('#addipmesin').val('');
            } else {
                notiffailed(response.data);
            }
        })
        .fail(function() {
            notiffailed('Error');
        });
    });
    $('body').on('click', '.btnretoremesin', function(event) {
        event.preventDefault();
        /* Act on the event */
        var mesin = $(this).data('mesin');
        $('#modalrestore').modal('show');
        $('.yesrestoremachine').on('click', function(event) {
            event.preventDefault();
            /* Act on the event */
            $('#modalrestore').modal('hide');
            $('.loading-cs').show();
            $.ajax({
                url: 'ajaxrestorefinger',
                type: 'post',
                dataType: 'json',
                data: { mesin : mesin },
            })
            .done(function(response) {
                if (response.message=='success') {
                    notifsuccess(response.data);
                } else {
                    notiffailed(response.data);
                }
            })
            .fail(function() {
                notiffailed('Error');
            });
        });
    });
});
