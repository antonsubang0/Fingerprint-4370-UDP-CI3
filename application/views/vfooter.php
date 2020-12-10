            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
               Subang @ 2020.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(); ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url(); ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url(); ?>/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url(); ?>/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url(); ?>/dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="<?= base_url(); ?>/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?= base_url(); ?>/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?= base_url(); ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
	<script src="<?= base_url(); ?>/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/select2/dist/js/select2.min.js"></script>
	<script src="<?= base_url(); ?>/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
		$(".select2").select2();
		jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
		jQuery('#datepicker-autoclose1').datepicker({
            autoclose: true,
            todayHighlight: true
        });
		
		jQuery('#datepicker-autoclose2').datepicker({
            autoclose: true,
            todayHighlight: true
        });
		jQuery('#datepicker-autoclose3').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>

</body>

</html>