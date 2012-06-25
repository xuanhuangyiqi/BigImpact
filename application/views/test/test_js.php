<script type="text/javascript">            
      $(document).ready(function() {      
        $("#1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/session',
                type : 'POST',
                data　: {json:'{"auth":"0","email":"100333524@qq.com","password":"524333"}'},
                complete:function(x,t){ 

                }
            });
          });
        $("#2").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/session',
                type : 'POST',
                data　: {json:'{"auth":"1","email":"100333524@qq.com","password":"524333"}'},
                complete:function(x,t){   
                }
            });
          });
        $("#3").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/session',
                type : 'DELETE',
                date:{},
                complete:function(x,t){   
                }
            });
          });
        $("#4").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/admin',
                type : 'POST',
                data　: {json:'{"email":"100333524@qq.com","first_name":"hui","last_name":"ter"}'},
                complete:function(x,t){   
                }
            });
          });
        $("#5").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/fellow',
                type : 'POST',
                data　: {json:'{"email":"100333524@qq.com","first_name":"hui","last_name":"ter"}'},
                complete:function(x,t){   
                }
            });
          });
        $("#6").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/fellow',
                type : 'GET',
                data　: {},
                complete:function(x,t){   
                }
            });
          });
        $("#7").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/fellow/792090',
                type : 'GET',
                data　: {},
                complete:function(x,t){   
                }
            });
          });
        $("#8").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v1/reset',
                type : 'POST',
                data　: {},
                complete:function(x,t){   
                }
            });
          });
      });
</script>