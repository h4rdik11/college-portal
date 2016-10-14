<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
?>

<div ng-app="Teacher" ng-controller="TeacherController" ng-init="display()">

  <!-- FORM GRID -->
    <div class="mdl-grid outer-grid">
      <div class="mdl-cell--6-col">
        <div class="mdl-grid main-grid" >

          <div class="mdl-cell--12-col">

            <form method="POST">

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Teacher ID</span>
              <input type="text" name="course" class="form-control" placeholder="Teacher's ID..." aria-describedby="course-addon" ng-model="id">  
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Name</span>
              <input type="text" name="course" class="form-control" placeholder="Teacher's Name..." aria-describedby="course-addon" ng-model="name">  
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Designation</span>
              <input type="text" name="sem" class="form-control" placeholder="Teacher's Designation..." aria-describedby="course-addon" ng-model="desig">      
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Department</span>
              <input type="text" name="course" class="form-control" placeholder="Teacher's Department..." aria-describedby="course-addon" ng-model="dept">  
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">E-Mail</span>
              <input type="email" name="course" class="form-control" placeholder="Teacher's E-Mail..." aria-describedby="course-addon" ng-model="email">  
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Password</span>
              <input type="password" name="course" class="form-control" placeholder="Teacher's Password..." aria-describedby="course-addon" ng-model="password">  
            </div>

              <center><button type="submit" class="btn btn-default btn-danger" ng-click="display(); formSubmit(); display()">Submit</button></center>
            </form>

          </div>
        </div>
      </div>

      <div class="mdl-cell--6-col">
         <!-- DISPLAY TABLE -->
          <center class="display-table">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
              <thead>
                <tr>
                  <th><center>#</center></th>
                  <th><center>Name</center></th>
                  <th><center>Designation</center></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="t in teachers">
                  <th><center>{{t.sno}}</center></th>
                  <th><center>{{t.name}}</center></th>
                  <th><center>{{t.desig}}</center></th>
                </tr>
              </tbody>
            </table>
          </center>   
        <!-- DISPLAY TABLE --> 
      </div>
    </div>
  <!-- END OF FORM GRID -->
</div>


<?php
  }else{
    redirect(base_url());
  }
?>

