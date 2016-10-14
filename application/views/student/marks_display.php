<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
?>
<div ng-app="MarksApp" ng-controller="MarksCtlr" ng-init="display()">

<div class="mdl-grid outer-grid">
  <div class="mdl-cell--6-col">
      <div class="mdl-grid main-grid">
        
        <div class="mdl-cell--12-col">
            <form>

              <div class="input-group" >
                <span class="input-group-addon" id="course-addon">Semester</span>
                <select ng-model="sem" class="form-control" aria-describedby="course-addon">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>      
              </div>

                <center><button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" ng-click="display(); getDetails(); display()">Submit</button></center>
            </form>
        </div>
      </div>
  </div>

  <div class="mdl-cell--6-col">
      <!-- DISPLAY TABLE -->

      <center class="display-table">
        <div class="inner-div">        
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
          <thead>
            <tr>
              <th><center>Subject</center></th>
              <th><center>1st Sessional</center></th>
              <th><center>2nd Sessional</center></th>
              <th><center>Assignment</center></th>
              <th><center>Total</center></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat = 'm in marks'>
              <td><center>{{m.sub_id}}</center></td>
              <td><center>{{m.internal1 | number:2}}</center></td>
              <td><center>{{m.internal2 | number:2}}</center></td>
              <td><center>{{m.assignment | number:2}}</center></td>
              <td><center>{{m.total | number:2}}</center></td>
            </tr>
          </tbody>
        </table>

      </center>

      <!-- END OF DISPLAY TABLE -->
  </div>
</div>

</div>

<?php
  }else{
    redirect(base_url());
  }
?>
