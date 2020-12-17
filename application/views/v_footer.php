    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="<?= base_url(); ?>/berkas/js/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url(); ?>/berkas/js/bootstrap.bundle.min.js"></script>
    <?php if ($jstable==1) : ?>
        <script src="<?= base_url(); ?>/berkas/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/berkas/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
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

            var tabeltarik = $('#tabeltarik').DataTable();
            var tabelreport = $('#tabelreport').DataTable({
                responsive: true,
                pageLength: 100
            });
            var tabelreport = $('#tabeluser').DataTable({
                responsive: true,
                pageLength: 100
            });
            var tabelmachine = $('#tabelmachine').DataTable({
                responsive: true,
                pageLength: 10,
                ajax : 'setting/ajaxdaftarmesin',
                createdRow : function( row, data, dataIndex ) {
                    $(row).addClass('managementmesin');
                },
                columns : [
                    { "data": "no" },
                    { "data": "namamesin" },
                    { "data": "ipmesin" },
                    { "data": "restart" },
                    { "data": "delete" }
                ]
            });
        </script>
    <?php endif;?>
    <?php if ($jspicker==1) : ?>
        <script src="<?= base_url(); ?>/berkas/js/jquery.datetimepicker.full.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datetimepicker').datetimepicker({
                    format:'d-m-Y H:i',
                    allowTimes:[
                      '00:00', '00:30','01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
                      '04:00', '04:30','05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
                      '08:00', '08:30','09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
                      '12:00', '12:30','13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
                      '16:00', '16:30','17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
                      '20:00', '20:30','21:00', '21:30', '22:00', '22:30', '23:00', '23:30'
                     ]
                });
                $('#datepicker').datetimepicker({
                    timepicker : false,
                    format:'d-m-Y'
                });
                $('#datepicker1').datetimepicker({
                    timepicker : false,
                    format:'d-m-Y'
                });
            });
        </script>
    <?php endif;?>
    <script src="<?= base_url(); ?>/berkas/js/myjs.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>