<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
?>
<div ng-app="AttendApp" ng-controller="AttendCtlr">

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

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Month</span>
              <select ng-model="month" class="form-control" aria-describedby="course-addon">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>      
            </div>

              <center><button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" ng-click="getAttendance();">Submit</button></center>
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
              <th><center>Classes Attended</center></th>
              <th><center>Total Classes</center></th>
              <th><center>Percent</center></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat = 'a in attendance'>
              <td><center>{{a.sub_id}}</center></td>
              <td><center>{{a.attended}}</center></td>
              <td><center>{{a.total}}</center></td>
              <td><center>{{a.percent | number:2}}</center></td>
            </tr>
          </tbody>
        </table>
        </div>
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
