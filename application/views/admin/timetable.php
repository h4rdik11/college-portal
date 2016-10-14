<?php 
  if($this->session->has_userdata('user') && $this->session->has_userdata('logged_in')){
    $user = $this->session->user;
    if($this->session->error){
      echo "
        <script>
          $(document).ready(function(){
            alert('".$this->session->error."');
          });
        </script>
      ";
      $this->session->unset_userdata('error');
    }
?>

<div ng-app="TTApp" ng-controller="TTCtlr">
<center><h3>Course Time-Table</h3></center>
<div class="mdl-grid outer-grid grid1">
  <div class="mdl-cell--6-col">
    <div class="mdl-grid main-grid">

      <div class="mdl-cell--11-col">

        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>PostTT/post_course_tt">

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Course</span>
          <select type="text" name="course" class="form-control" aria-describedby="course-addon" ng-model='course' required>
          <option></option>
          <option ng-repeat="c in courses" value={{c.course_name}}>{{c.course_name}}</option>
          </select>      
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Sem</span>
          <select name="sem" class="form-control" aria-describedby="course-addon" ng-model='sem' required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>       
        </div>

        <div class="input-group date" data-provide="datepicker">
          <span class="input-group-addon" id="course-addon">Date</span>
          <input type="text" class="form-control" id="datepicker" name="date" required>
          <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
          </div>
        </div>

        <div class="input-group" >
          <span class="input-group-addon" id="course-addon">Time-Table</span>
          <input type="file" class="form-control" aria-describedby="course-addon" name="userfile" required>      
        </div>
        <h4><small>Valid Filetypes : gif, jpg, png, doc, docx, pdf</small></h4>

          <center><button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Upload</button></center>
        </form>

      </div>
    </div>
  </div>

  <div class="mdl-cell--6-col table-cell">
    <!-- DISPLAY TABLE -->
    <center class="display-table">
        <div class="inner-div">      
          <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
              <tr>
                <th><center>Course</center></th>
                <th><center>Subject</center></th>
                <th><center>File</center></th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat = 'syll in syllabus'>
                <td><center>{{syll.course}} {{syll.sem}}</center></td>
                <td><center>{{syll.subject}}</center></td>
                <td><center><a href=<?php echo base_url(); ?>PostAssignment/assign_download?url={{syll.file_path}}&file={{syll.file_name}}><span class="glyphicon glyphicon-download-alt"></span></a></center></td>
              </tr>
            </tbody>
          </table>
        </div>
    </center>
    <!-- END OF DISPLAY TABLE -->
  </div>
</div>


<center><h3>Teacher Time-Table</h3></center>
<div class="mdl-grid outer-grid">
    
    <div class="mdl-cell--6-col">
      <div class="mdl-grid main-grid">
        <div class="mdl-cell--11-col">
          
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>PostTT/post_teacher_tt">

              <div class="input-group" >
                <span class="input-group-addon" id="course-addon">Teacher</span>
                <select type="text" name="teacher" class="form-control" aria-describedby="course-addon" ng-model="n_teacher">
                <option></option>
                <option ng-repeat="c in teachers" value={{c.teacher_id}}>{{c.name}}</option>
                </select>      
              </div>

              <div class="input-group date" data-provide="datepicker">
                <span class="input-group-addon" id="course-addon">Date</span>
                <input type="text" class="form-control" id="datepicker" name="date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>

              <div class="input-group" >
                <span class="input-group-addon" id="course-addon">Time-Table</span>
                <input type="file" class="form-control" aria-describedby="course-addon" name="userfile" required>      
              </div>
              <h4><small>Valid Filetypes : gif, jpg, png, doc, docx, pdf</small></h4>

                <center><button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Upload</button></center>
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
                <th><center>Course</center></th>
                <th><center>Subject</center></th>
                <th><center>File</center></th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat = 'n in notes'>
                <td><center>{{n.course}} {{n.sem}}</center></td>
                <td><center>{{n.subject}}</center></td>
                <td><center><a href=<?php echo base_url(); ?>PostAssignment/assign_download?url={{n.file_path}}&file={{n.file_name}}><span class="glyphicon glyphicon-download-alt"></span></a></center></td>
              </tr>
            </tbody>
            </table>
          </div>
      </center>
      <!-- END OF DISPLAY TABLE -->
    </div>

</div>

<?php
  }else{
    redirect(base_url());
  }
?>




