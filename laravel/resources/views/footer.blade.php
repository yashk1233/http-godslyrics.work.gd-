<!-- /.content-wrapper -->
<footer class="main-footer d-none">
</footer>

<!-- iOS Style Confirm Modal -->
<div id="ios-confirm-modal" class="ios-modal-overlay" style="display: none;">
    <div class="ios-modal">
        <div class="ios-modal-header" style="padding-bottom: 15px;">
            <h4>Restricted Action</h4>
            <p>This action is restricted. Are you sure you want to proceed?</p>
        </div>
        <div class="ios-modal-footer">
            <button type="button" class="ios-modal-btn" id="ios-confirm-cancel">Cancel</button>
            <button type="button" class="ios-modal-btn ios-modal-btn-confirm" id="ios-confirm-proceed" style="color: #ff3b30;">Proceed</button>
        </div>
    </div>
</div>

<!-- iOS Style PIN Modal -->
<div id="ios-pin-modal" class="ios-modal-overlay" style="display: none;">
    <div class="ios-modal">
        <div class="ios-modal-header">
            <h4>Passcode Required</h4>
            <p>Please enter passcode to proceed.</p>
        </div>
        <div class="ios-modal-body">
            <input type="tel" id="ios-pin-input" class="ios-pin-input" placeholder="Passcode" maxlength="4" pattern="[0-9]*" inputmode="numeric" autocomplete="off" style="-webkit-text-security: disc; text-security: disc;">
        </div>
        <div class="ios-modal-footer">
            <button type="button" class="ios-modal-btn" id="ios-pin-cancel">Cancel</button>
            <button type="button" class="ios-modal-btn ios-modal-btn-confirm" id="ios-pin-confirm">OK</button>
        </div>
    </div>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src='{{asset("plugins/jquery-ui/jquery-ui.min.js")}}'></script>
  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

    // Make the body fully scrollable on touch devices
    document.addEventListener('touchstart', function() {}, {passive: true});

    // Global PIN Modal Logic
    let globalPinAction = null;

    window.requirePin = function(actionCallback) {
        globalPinAction = actionCallback;
        $('#ios-confirm-modal').show();
        setTimeout(() => {
            $('#ios-confirm-modal').addClass('show');
        }, 10);
    }

    $('#ios-confirm-cancel').on('click', function() {
        $('#ios-confirm-modal').removeClass('show');
        setTimeout(() => {
            $('#ios-confirm-modal').hide();
        }, 200);
    });

    $('#ios-confirm-proceed').on('click', function() {
        $('#ios-confirm-modal').removeClass('show');
        setTimeout(() => {
            $('#ios-confirm-modal').hide();
            // Now show PIN modal
            $('#ios-pin-input').val('').removeClass('error');
            $('#ios-pin-modal').show();
            setTimeout(() => {
                $('#ios-pin-modal').addClass('show');
                $('#ios-pin-input').focus();
            }, 10);
        }, 200);
    });

    function hidePinModal() {
        $('#ios-pin-modal').removeClass('show');
        setTimeout(() => {
            $('#ios-pin-modal').hide();
        }, 200);
    }

    $('#ios-pin-cancel').on('click', hidePinModal);

    $('#ios-pin-confirm').on('click', function() {
        let pin = $('#ios-pin-input').val();
        if (pin === '3399') {
            hidePinModal();
            if (globalPinAction) globalPinAction();
        } else {
            $('#ios-pin-input').addClass('error').val('');
            setTimeout(() => $('#ios-pin-input').removeClass('error'), 400);
        }
    });

    $('#ios-pin-input').on('keypress', function(e) {
        if(e.which === 13) {
            $('#ios-pin-confirm').click();
        }
    });
</script>
<!-- Bootstrap 4 -->
<!-- <script src="../../"></script> -->
<script src='{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<!-- ChartJS -->
<!-- <script src='{{asset("plugins/chart.js/Chart.min.js")}}'></script> -->
<!-- Sparkline -->
<!-- <script src='{{asset("plugins/sparklines/sparkline.js")}}'></script> -->
<!-- JQVMap -->
<!-- <script src='{{asset("plugins/jqvmap/jquery.vmap.min.js")}}'></script> -->
<!-- <script src='{{asset("plugins/jqvmap/maps/jquery.vmap.usa.js")}}'></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src='{{asset("plugins/jquery-knob/jquery.knob.min.js")}}'></script> -->
<!-- daterangepicker -->
<!-- <script src='{{asset("plugins/moment/moment.min.js")}}'></script> -->
<!-- <script src='{{asset("plugins/daterangepicker/daterangepicker.js")}}'></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src='{{asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}'></script> -->
<!-- Summernote -->
<!-- <script src='{{asset("plugins/summernote/summernote-bs4.min.js")}}'></script> -->
<!-- overlayScrollbars -->
<!-- <script src='{{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}'></script> -->
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src='{{asset("dist/js/demo.js")}}'></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src='{{asset("dist/js/pages/dashboard.js")}}'></script> -->



<script src='{{asset("plugins/datatables/jquery.dataTables.min.js")}}'></script>
<script src='{{asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}'></script>
<script src='{{asset("plugins/datatables-responsive/js/dataTables.responsive.min.js")}}'></script>
<script src='{{asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}'></script>
<script src='{{asset("plugins/datatables-buttons/js/dataTables.buttons.min.js")}}'></script>
<script src='{{asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}'></script>
<!-- <script src='{{asset("plugins/jszip/jszip.min.js")}}'></script> -->
<!-- <script src='{{asset("plugins/pdfmake/pdfmake.min.js")}}'></script> -->
<!-- <script src='{{asset("plugins/pdfmake/vfs_fonts.js")}}'></script> -->
<script src='{{asset("plugins/datatables-buttons/js/buttons.html5.min.js")}}'></script>
<script src='{{asset("plugins/datatables-buttons/js/buttons.print.min.js")}}'></script>
<script src='{{asset("plugins/datatables-buttons/js/buttons.colVis.min.js")}}'></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>



</body>

</html>