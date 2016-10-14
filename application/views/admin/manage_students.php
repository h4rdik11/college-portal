<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
?>

<div ng-app="StudentApp" ng-controller="StudentCtlr" ng-init="display()">

  <div class="mdl-grid outer-grid">
    <div class="mdl-cell--6-col">
      <div class="mdl-grid main-grid">
        <div class="mdl-cell--12-col">

          <form method="POST">

          <div class="input-group" >
            <span class="input-group-addon" id="course-addon">Roll No.</span>
            <input type="text" name="course" class="form-control" placeholder="Student's Roll No...." aria-describedby="course-addon" ng-model="roll">  
          </div>

          <div class="input-group" >
            <span class="input-group-addon" id="course-addon">Student ID</span>
            <input type="text" name="course" class="form-control" placeholder="Student's ID...." aria-describedby="course-addon" ng-model="sid">  
          </div>

          <div class="input-group" >
            <span class="input-group-addon" id="course-addon">Name</span>
            <input type="text" name="sem" class="form-control" placeholder="Student's Name...." aria-describedby="course-addon" ng-model="name">      
          </div>

          <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Course</span>
          <select name="course" class="form-control" aria-describedby="course-addon" ng-model="course">
            <option>Select Course</option>
            <option value="MCA">MCA</option>
          </select>      
          </div>

          <div class="input-group" >
            <span class="input-group-addon" id="course-addon">Semester.</span>
            <input type="text" name="course" class="form-control" placeholder="Student's Semester...." aria-describedby="course-addon" ng-model="sem">  
          </div>

          <div class="input-group" >
            <span class="input-group-addon" id="course-addon">Password</span>
            <input type="password" name="course" class="form-control" placeholder="Student's Password...." aria-describedby="course-addon" ng-model="password">  
          </div>

            <center><button type="submit" class="btn btn-default btn-danger" ng-click="display(); formSubmit(); display()">Submit</button></center>
          </form>

        </div>
      </div>
    </div>

    <div class="mdl-cell--6-col">
         <!-- DISPLAYING ASSIGNED TEACHERS -->
  
      <center class="display-table">
      <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
          <tr>
            <th><center>#</center></th>
            <th><center>Student Name</center></th>
            <th><center>Roll No.</center></th>
            <th><center>Course</center></th>
            <th><center>Semester</center></th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="s in students">
          <th><center>{{s.sno}}</center></th>
            <th><center>{{s.stu_name}}</center></th>
            <th><center>{{s.roll_no}}</center></th>
            <th><center>{{s.course_code}}</center></th>
            <th><center>{{s.sem}}</center></th>
          </tr>
        </tbody>
      </table>
      </center>

    </div>
  </div>

</div>
<?php
  }else{
    redirect(base_url());
  }
?>

