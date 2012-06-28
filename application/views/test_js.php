<script type="text/javascript">            
      $(document).ready(function() {


        $("#1-1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/reset',
                type : 'POST',
                data　: {},
                complete:function(x,t){
                 if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }  
                }
            });
          });  


        $("#2-1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/session',
                type : 'POST',
                data　: {json:'{"auth":"0","email":"123456@omar.com","password":"123456"}'},
                complete:function(x,t){ 
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 

                }
            });
          });
        $("#2-2").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/session',
                type : 'POST',
                data　: {json:'{"auth":"1","email":"123456@omar.com","password":"123456"}'},
                complete:function(x,t){   
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });
        $("#2-3").click(function(e){
          e.preventDefault();
                $.ajax({
                url : 'api/v2/session',
                type : 'DELETE',
                date:{},
                complete:function(x,t){ 
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });
        $("#2-4").click(function(e){
          e.preventDefault();
                $.ajax({
                url : 'api/v2/session',
                type : 'GET',
                date:{},
                complete:function(x,t){ 
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });


        $("#3-1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/admin',
                type : 'POST',
                data　: {json:'{"email":"huiter.me@gmail.com","first_name":"hui","last_name":"ter"}'},
                complete:function(x,t){   
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });
        $("#3-2").click(function(e){
          e.preventDefault();
                $.ajax({
                url : 'api/v2/fellow',
                type : 'POST',
                data　: {json:'{"email":"huiter.me@gmail.com","first_name":"hui","last_name":"ter"}'},
                complete:function(x,t){ 
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });

        $("#4-1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/fellow',
                type : 'GET',
                data　: {},
                complete:function(x,t){   
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });
        $("#4-2").click(function(e){
          e.preventDefault();
                $.ajax({
                url : 'api/v2/fellow/100002',
                type : 'GET',
                data　: {},
                complete:function(x,t){ 
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });
        $("#4-3").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/fellow',
                type : 'PUT',
                data　: {json: '{"first_name": "John","last_name": "Smith","mail_option": 1,"mail": "xueyuan road","mobile_country_code":"010","mobile":"82318321","country":"China","zip":"100191","state":"Beijing","city":"Beijing","street":"Xueyuan Road","target":"Education","location":"haidian","job":"IT","language":"Chinese","gender":1'},
                complete:function(x,t){   
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  } 
                }
            });
          });


        $("#5-1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/offer',
                type : 'POST',
                data　: {json: '{"title":"送温暖","description":"2012年5月26日","fields":"IT","locations":"beijing","target":"39211411"}'},
                complete:function(x,t){ 
                 if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }  

                }
            });
          });
        $("#5-2").click(function(e) {
        e.preventDefault();
              $.ajax({
              url: 'api/v2/offer/40798',
              type : 'GET',
              data　: {},
              complete:function(x,t){  
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }  
              }
          });
        });
        $("#5-3").click(function(e) {
          e.preventDefault();
                $.ajax({
                url: 'api/v2/offers',
                type : 'GET',
                data　: {json:'{"num":"5","time_stamp":"","orderby":""}'},
                complete:function(x,t){
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }     
                }
            });
          });
          $("#5-4").click(function(e) {
          e.preventDefault();
                $.ajax({
                url: 'api/v2/myoffers/100001',
                type : 'GET',
                data　: {json:'{num":"3","time_stamp":"","orderby":""}'},
                complete:function(x,t){
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }     
                }
            });
          });
          $("#5-5").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/offer/40799',
                type : 'DELETE',
                data　: {},
                complete:function(x,t){
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }     
                }
            });
          });
          $("#6-1").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/followoffer/40799',
                type : 'POST',
                data　: {},
                complete:function(x,t){
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }     
                }
            });
          });
          $("#6-2").click(function(e) {
          e.preventDefault();
                $.ajax({
                url : 'api/v2/followoffer/40799',
                type : 'DELETE',
                data　: {},
                complete:function(x,t){
                  if(x.status==200)
                  {
                    $("#success").show();
                    $("#success").fadeOut(1000);
                  }
                  else
                  {
                    $("#fail").show();
                    $("#fail").fadeOut(1000);
                  }     
                }
            });
          });
});
</script>