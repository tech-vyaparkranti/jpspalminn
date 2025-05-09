<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<!--<script src="assets/bundles/vendorscripts.bundle.js"></script>--> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/normal_vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor --> 
<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/index.js"></script>
<script src="assets/js/pages/charts/jquery-knob.min.js"></script>
<script>
<?php
    if($a_icon){
?>
    swal({
        title: "<?=$a_title?>",
        text: "<?=$a_text?>",
        icon: "<?=$a_icon?>",
        button: "<?=$a_button?>"
    });
<?php
    unset($_SESSION['a_title']);
    unset($_SESSION['a_text']);
    unset($_SESSION['a_icon']);
    unset($_SESSION['a_button']);
}
?>
</script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Please enter only Numbers.");
            return false;
        }
        return true;
    }
</script>

<script>
    $(document).ready(function(){
        $('.change_checkbox').change(function() {
            var isChecked = $(this).is(':checked') ? 1 : 0;
            $(this).val(isChecked);
        });
    });
</script>
</body>
</html>