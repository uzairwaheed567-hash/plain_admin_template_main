<!-- ========== footer start =========== -->
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 order-last order-md-first">
        <div class="copyright text-center text-md-start">
          <p class="text-sm">
            Designed and Developed by
            <a href="https://plainadmin.com" rel="nofollow" target="_blank">
              PlainAdmin
            </a>
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="terms d-flex justify-content-center justify-content-md-end">
          <a href="#0" class="text-sm">Term & Conditions</a>
          <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
        </div>
      </div>
          <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
  </body>
</html>
<script>

function getBranch(school_id){

    if(school_id != ""){

        $.ajax({
            url: "Ajax_function.php",
            type: "POST",
            data: { school_id: school_id },
            success: function(response){
                $("#branch_id").html(response);
            },
            error: function(){
                alert("AJAX Error");
            }
        });

    } 
}

function getSection(class_id){
    if(class_id != ""){
        $.ajax({
            url: "Ajax_function.php",
            type: "POST",
            data: { class_id: class_id },
            success: function(response){
                $("#section_id").html(response);
            },
            error: function(){
                alert("AJAX Error");
            }
        });

    } 
}

</script>
    </div>
  </div>
</footer>
<!-- ========== footer end =========== -->
