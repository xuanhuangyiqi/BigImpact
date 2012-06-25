    <script type="text/javascript">
      $(document).ready(function() {      
        $("#login").click(function() {
          var email=$("#email").attr("value");
          var password=$("#password").attr("value");
          alert("re");
          $.post("/api/user/login",{email:email,password:password},function( data ) {
                    alert(data['error']);

              },"json");
        });

      });
    </script>