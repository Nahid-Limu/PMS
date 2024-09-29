<!-- Vendor JS Files -->

<script src="{{ asset('adminAssets/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('adminAssets/assets/js/main.js') }}"></script>

<!-- JS FUNCTIONS -->
<script>
    //call deleteModal
    function deleteModal(Id,Name,List) {
      // alert(List);
      $("#data").text('[ '+Name+' ]');
      $("#data_id").val(Id);
      $("#listName").text('[ '+List+' ]');
    }
    
    //reset form
    function onCloseModal(fromName) {
      $("#form_result").text('');
      $('#'+fromName).trigger("reset");
      $(".summerNote").summernote('reset');
    }

    //summernote
    $(document).ready(function() {
      $(".summerNote").summernote({
        height: 300,   //don't use px
      });
    });

    //ajax flash msg 
    function SuccessMsg() {
      $("#success_message").fadeTo(3000, 500).slideUp(500, function(){
          $("#success_message").alert('close');
      });
    }

    //flash msg php form submit
    setTimeout(function() {
      $('#successMessage').fadeOut('fast');
    }, 3000);
</script>

<script>

</script>