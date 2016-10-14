<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
?>

<div ng-app="AssignTeacher" ng-controller="teacherAssign" ng-init="display()">

<div class="mdl-grid outer-grid">
<div class="mdl-cell--6-col">
    <div class="mdl-grid main-grid">
    <div class="mdl-cell--12-col"><!-- Add New Subject -->
      
      <h3>Add New Subject</h3>
      <form method="POST">

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Course</span>
          <select class="form-control" aria-describedby="course-addon" ng-model="new_course">
            <option>Select Course</option>
            <option value="mca">MCA</option>
          </select>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Semester</span>
          <select type="text" ng-model="new_sem" class="form-control" aria-describedby="course-addon" ng-change="getSubject()">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Subject</span>
          <input type="text" class="form-control" aria-describedby="course-addon"  ng-model="new_subject">    
        </div>

        <center><button type="submit" class="btn btn-default btn-danger" ng-click="display(); addSubject(); display()">Submit</button></center>

      </form>

    </div><!-- End of Add New subject -->
      
      <div class="mdl-cell--12-col"><!-- Assign Teacher -->

        <h3>Assign Teacher</h3>
        <form>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Course</span>
          <select name="course" class="form-control" aria-describedby="course-addon" ng-model="course">
            <option>Select Course</option>
            <option value="mca">MCA</option>
          </select>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Semester</span>
          <select type="text" ng-model="sem" class="form-control" aria-describedby="course-addon" ng-change="getSubject()">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Subject</span>
          <select class="form-control" aria-describedby="course-addon"  ng-model="subject">
            <option>Select Subject</option>
            <option ng-repeat="s in subjects" value="{{s.sno}}">{{s.s_name}}</option>
          </select>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Teacher</span>
          <select type="text" name="teacher" class="form-control" aria-describedby="course-addon"  ng-model="teacher"> 
            <option>Select Teacher</option>
            <?php 
              foreach($teachers as $value){
            ?>
                <option value=<?php echo $value->name; ?>><?php echo $value->name; ?></option>
            <?php } ?>
          </select>      
        </div>

          <center><button type="submit" class="btn btn-default btn-danger" ng-click="display(); formSubmit(); display()">Submit</button></center>
        </form>

      </div><!-- End of Assign Teacher -->
    </div>
</div>

<div class="mdl-cell--6-col">
   <!-- DISPLAYING ASSIGNED TEACHERS -->
  
    <center class="display-table">
        <div class="inner-div">
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
      <thead>
        <tr>
          <th>#</th>
          <th>Subject Name</th>
          <th>Teacher</th>
          <th>Course</th>
          <th>Semester</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="t in teachers">
          <th>{{t.sno}}</th>
          <th>{{t.s_name}}</th>
          <th>{{t.teacher_id}}</th>
          <th>{{t.course_code}}</th>
          <th>{{t.sem}}</th>
        </tr>
      </tbody>
    </table>
    </div>
    </center> 

</div>

</div>

</div>

<?php
  }else{
    redirect(base_url());
  }
?>

