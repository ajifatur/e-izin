
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('templates/vali-admin/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('templates/vali-admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('templates/vali-admin/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
    <script src="{{ asset('templates/vali-admin/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('templates/vali-admin/js/plugins/pace.min.js') }}"></script>
    <!-- Additional JavaScript -->
    <script type="text/javascript">
        // Button Toggle Password
        $(document).on("click", ".btn-toggle-password", function(e){
            e.preventDefault();
            if($(this).find("i").hasClass("fa-eye")){
                $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
                $("input[name=password]").attr("type","text");
            }
            else{
                $(this).find("i").addClass("fa-eye").removeClass("fa-eye-slash");
                $("input[name=password]").attr("type","password");
            }
        });
    </script>