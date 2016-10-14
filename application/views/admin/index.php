<center>
		<div class="demo-card-wide mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Admin Login</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <ul class="demo-list-item mdl-list">
              <form method="POST" action="<?php echo base_url(); ?>Admin/login">
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">User</span>
                  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon2" name="user">
                </div>
            
            
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Pass</span>
                  <input type="text" class="form-control" placeholder="Password" aria-describedby="sizing-addon2" name="pass">
                </div>

                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Login..</button>
              </form>
            </ul>           
          </div>
        </div>
      </div>
</center>