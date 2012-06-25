<script type="text/javascript">            
      $(document).ready(function() {      
        $("#login").click(function(e) {
          e.preventDefault();
          var email = $("#email").attr('value');
          var password = $("#password").attr('value');
                $.ajax({
                url : 'api/auth/AdminLogin',
                type : 'POST',
                data　: {email:email,password:password},
                complete:function(x,t){
                  if(x.status==200){
                    window.location.href='/admin_manage';
                  }
                  else
                  {
                    $("#message").html("<div class='alert'><button class='close' data-dismiss='alert'>×</button>username or password is not correct</div>");
                  }
                }
            });
        });
      });
</script>