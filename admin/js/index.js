$(function () {
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
    $(document).ready(function(){
        $('#myTable1').DataTable();
    });

    $('.menu-toggle').on('click', function(){
        $('.ml-menu').toggle('display');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#imgPreview1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    $("#anh_hh").change(function() {
        readURL(this);
    });
})