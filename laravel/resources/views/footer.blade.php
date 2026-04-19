<!-- /.content-wrapper -->
<footer class="main-footer d-none">
</footer>

<!-- iOS Style Confirm Modal (Restricted Action) -->
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

<!-- iOS Style General Confirm Modal -->
<div id="ios-general-confirm-modal" class="ios-modal-overlay" style="display: none; z-index: 9999;">
    <div class="ios-modal" style="width: 280px; text-align: center;">
        <div class="ios-modal-header" style="padding: 20px 15px 15px; border-bottom: none;">
            <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px;">Confirmation</h4>
            <p id="ios-general-confirm-message" style="font-size: 0.95rem; color: #1c1c1e; margin: 0; line-height: 1.4;"></p>
        </div>
        <div class="ios-modal-footer" style="padding: 0; border-top: 1px solid #e5e5ea; display: flex;">
            <button type="button" class="ios-modal-btn" id="ios-general-confirm-cancel" style="flex: 1; padding: 12px; color: #007aff; font-weight: 400; border: none; border-right: 1px solid #e5e5ea; background: transparent; font-size: 1.05rem; cursor: pointer;">Cancel</button>
            <button type="button" class="ios-modal-btn ios-modal-btn-confirm" id="ios-general-confirm-proceed" style="flex: 1; padding: 12px; color: #ff3b30; font-weight: 600; border: none; background: transparent; font-size: 1.05rem; cursor: pointer;">Confirm</button>
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

<!-- iOS Style Alert Modal -->
<div id="ios-alert-modal" class="ios-modal-overlay" style="display: none; z-index: 9999;">
    <div class="ios-modal" style="width: 280px; text-align: center;">
        <div class="ios-modal-header" style="padding: 20px 15px 15px; border-bottom: none;">
            <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px;">Notification</h4>
            <p id="ios-alert-message" style="font-size: 0.95rem; color: #1c1c1e; margin: 0; line-height: 1.4;"></p>
        </div>
        <div class="ios-modal-footer" style="padding: 0; border-top: 1px solid #e5e5ea; display: flex;">
            <button type="button" class="ios-modal-btn ios-modal-btn-confirm" id="ios-alert-ok" style="flex: 1; padding: 12px; color: #007aff; font-weight: 600; border: none; background: transparent; font-size: 1.05rem; cursor: pointer;">OK</button>
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

    // Override Default Alert
    window.alert = function(message, callback) {
        $('#ios-alert-message').text(message);
        $('#ios-alert-modal').show();
        setTimeout(() => {
            $('#ios-alert-modal').addClass('show');
        }, 10);
        
        $('#ios-alert-ok').off('click').on('click', function() {
            $('#ios-alert-modal').removeClass('show');
            setTimeout(() => {
                $('#ios-alert-modal').hide();
                if(callback && typeof callback === 'function') {
                    callback();
                }
            }, 200);
        });
    };

    // General Confirm
    window.iosConfirm = function(message, callback) {
        $('#ios-general-confirm-message').text(message);
        $('#ios-general-confirm-modal').show();
        setTimeout(() => {
            $('#ios-general-confirm-modal').addClass('show');
        }, 10);

        $('#ios-general-confirm-cancel').off('click').on('click', function() {
            $('#ios-general-confirm-modal').removeClass('show');
            setTimeout(() => {
                $('#ios-general-confirm-modal').hide();
            }, 200);
        });

        $('#ios-general-confirm-proceed').off('click').on('click', function() {
            $('#ios-general-confirm-modal').removeClass('show');
            setTimeout(() => {
                $('#ios-general-confirm-modal').hide();
                if(callback && typeof callback === 'function') {
                    callback();
                }
            }, 200);
        });
    };

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