    <script type="text/javascript">           
      $(document).ready(function() { 

          $.ajax({
              url : 'api/auth/IsMemberLogin/',
              type : 'POST',
              complete : function(x,t){
                if(x.status==403){
                    window.location.href='/';
                }
                else
                {
                  
                }
              }
          });
        $("#login").click(function() {
          var email=$("#email").attr("value");
          var password=$("#password").attr("value");
          alert("re");
          $.post("/api/user/login",{email:email,password:password},function( data ) {
                    alert(data['error']);

              },"json");
        });
          $("#quit").click(function(e) {
            e.preventDefault();
            $.ajax({
              url : 'api/auth/MemberLogout/',
              type : 'POST',
              complete : function(x,t){
                window.location.href='/';
              }
          });
         
        });

      });
    </script>