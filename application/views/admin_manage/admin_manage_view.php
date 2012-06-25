
      <header class="jumbotron masthead">
          <div class="inner">
            <h1>Hi,admin!</h1>
              <p class="download-info">
                <a data-toggle="modal" href="#CreateAdmin" class="btn btn-large">Create Admin</a>
                <a data-toggle="modal" href="#CreateFellow" class="btn btn-large">Create Fellow</a>
                <a data-toggle="modal" href="#Magane" class="btn btn-large disabled">Magange Tag</a>
              </p>
          </div>
      </header>
      <div id="message">
      </div>
      <div id="CreateAdmin" class="span8 modal hide fade in " style="display: none; ">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">×</button>
              <h3>Create a Admin</h3>
            </div>
            <div class="modal-body">
             <form class="form-horizontal">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="email">Email Address</label>
            <div class="controls">
              <input type="email" class="" id="admin-email">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="firstname">First Name</label>
            <div class="controls">
              <input type="email" class="" id="admin-firstname">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="lastname">Last Name</label>
            <div class="controls">
              <input type="email" class="" id="admin-lastname">
              <p class="help-block"></p>
            </div>
          </div>
        </fieldset>
      </form>
          <hr>
      </div>
        <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal">Close</a>
          <a href="#" class="btn btn-primary" id="admin-create">Create</a>
        </div>
      </div>


            <div id="CreateFellow" class="span8 modal hide fade in " style="display: none; ">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">×</button>
              <h3>Create a Fellow</h3>
            </div>
            <div class="modal-body">
             <form class="form-horizontal">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="email">Email Address</label>
            <div class="controls">
              <input type="email" class="" id="fellow-email">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="firstname">First Name</label>
            <div class="controls">
              <input type="email" class="" id="fellow-firstname">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="lastname">Last Name</label>
            <div class="controls">
              <input type="email" class="" id="fellow-lastname">
              <p class="help-block"></p>
            </div>
          </div>
        </fieldset>
      </form>
          <hr>
      </div>
        <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal">Close</a>
          <a href="#" class="btn btn-primary" id="fellow-create">Create</a>
        </div>
      </div>
      <div class="row">
          <a href="#" class="btn span12" data-dismiss="modal" id="quit">Quit</a>
      </div>


      <footer class="footer">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>Copyright ©2012 BigImpact, All Rights Reserved.</p>
      </footer>