<script type="text/javascript">            
      $(document).ready(function() { 

    
          $.ajax({
              url : 'api/auth/IsAdminLogin/',
              type : 'POST',
              complete : function(x,t){
                if(x.status==403){
                    window.location.href='/admin';
                }
                else
                {
                  
                }
              }
          });
        $("#quit").click(function(e) {
            e.preventDefault();
            $.ajax({
              url : 'api/auth/AdminLogout/',
              type : 'POST',
              complete : function(x,t){
                window.location.href='/';
              }
          });
         
        });

        $("#admin-create").click(function(e) {
          $("#message").html("");
          e.preventDefault();
          var email = $("#admin-email").attr('value');
          var firstname = $("#admin-firstname").attr('value'); 
          var lastname = $("#admin-lastname").attr('value');
          var data={email:email,firstname:first_name,last_name:lastname};
          dataText=JSON.stringify(data); 
                $.ajax({
                url : 'api/wxy/admin/',
                type : 'POST',  
                data : {json:dataText},
                //data : {json:'{email:'+email+',first_name:'+firstname+',last_name:'+lastname+'}'},
                complete : function(x,t){
                  
                  if(x.status==200){
                    $('#CreateAdmin').modal('hide');
                    $("#message").html("<div class='alert alert-success'><button class='close' data-dismiss='alert'>×</button>create success</div>");
                  }
                  else
                  {
                    $('#CreateAdmin').modal('hide');
                    $("#message").html("<div class='alert'><button class='close' data-dismiss='alert'>×</button>create fail</div>");
                  }
                }
            });
        });

        $("#fellow-create").click(function(e) {
          $("#message").html("");
          e.preventDefault();
          var email = $("#fellow-email").attr('value');
          var firstname = $("#fellow-firstname").attr('value');
          var lastname = $("#fellow-lastname").attr('value');
          var data={email:email,first_name:firstname,last_name:lastname};
          dataText=JSON.stringify(data); 
                $.ajax({
                url : 'api/wxy/member/',
                type : 'POST',
                data : {json:dataText},
                //data : {'json':{'email':email,'first_name':firstname,'last_name':lastname}},
                complete : function(x,t){
                  
                  if(x.status==200){
                    $('#CreateFellow').modal('hide');
                    $("#message").html("<div class='alert alert-success'><button class='close' data-dismiss='alert'>×</button>create success</div>");
                  }
                  else
                  {
                    $('#CreateFellow').modal('hide');
                    $("#message").html("<div class='alert'><button class='close' data-dismiss='alert'>×</button>create fail</div>");
                  }
                }
            });
        });
});
</script>