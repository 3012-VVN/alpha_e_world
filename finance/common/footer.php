  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="../tel/intlTelInput.js"></script>

  </body>

  </html>

  <script>
$(document).ready(function() {

    $(".changePlan").click(function() {
        $.post("/ResetPlan", {})
            .done(function(data) {
                window.location.reload();
            });
    });

    $(".changePlan1").click(function() {
        $.post("/ResetPlan", {})
            .done(function(data) {
                window.location.reload();
            });
    });
    setTimeout(qq, 1000);
});

function qq() {
    $.post("/Timer", {
            name: "John",
            time: "2pm"
        })
        .done(function(data) {
            $("#timer").html(data);
            setTimeout(qq, 1000);
        });
}
  </script>