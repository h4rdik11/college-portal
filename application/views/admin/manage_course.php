<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
?>

<div ng-app="CourseApp" ng-controller="CourseCtlr" ng-init="display()">

<div class="mdl-grid outer-grid">
  
  <div class="mdl-cell--6-col">
      <div class="mdl-grid main-grid">
      <div class="mdl-cell--12-col">

        <form>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Course Name</span>
          <input type="text" class="form-control" placeholder="Course Name..." aria-describedby="course-addon" ng-model="name" required>  
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Course Code</span>
          <input type="text" name="sem" class="form-control" placeholder="Course Code..." aria-describedby="course-addon" ng-model="code" required>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Department</span>
          <input type="text" name="sem" class="form-control" placeholder="Course Stream..." aria-describedby="course-addon" ng-model="dept" required>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Faculty</span>
          <input type="text" name="sem" class="form-control" placeholder="Course Stream..." aria-describedby="course-addon" ng-model="faculty" required>      
        </div>

          <center><button type="submit" class="btn btn-default btn-danger" ng-click="display(); formSubmit(); display();">Submit</button></center>
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
            <th><center>Course</center></th>
            <th><center>Code</center></th>
            <th><center>Department</center></th>
            <th><center>Faculty</center></th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="c in courses">
            <td><center>{{c.sno}}</center></td>
            <td><center>{{c.course_name}}</center></td>
            <td><center>{{c.course_code}}</center></td>
            <td><center>{{c.department}}</center></td>
            <td><center>{{c.faculty}}</center></td>
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

