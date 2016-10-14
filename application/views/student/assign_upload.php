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

<div ng-app="AssignmentApp" ng-controller="AssignmentCtlr">

<center><h3>Available Assignments</h3></center>
<div class="mdl-grid outer-grid grid1" style="padding-bottom: 2%;">
  <div class="mdl-cell--4-col"></div>
  <div class="mdl-cell--4-col display-table" style="margin-top:0px;">    
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
      <thead>
        <tr>
          <th><center>#</center></th>
          <th><center>Subject</center></th>
          <th><center>Assignment ID</center></th>
          <th><center>File</center></th>
          <th><center>Due Date</center></th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat = 'a in available'>
          <td><center>{{a.sno}}</center></td>
          <td><center>{{a.subject}}</center></td>
          <td><center>{{a.a_id}}</center></td>
          <td><center><a href=<?php echo base_url(); ?>PostAssignment/assign_download?url={{a.path}}&file={{a.file_name}}><span class="glyphicon glyphicon-download-alt"></span></a></center></td>
          <td><center>{{a.due_date | date : 'dd-MM-yyyy'}}</center></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="mdl-cell--4-col"></div>

</div>


<center><h3>Submit Assignment</h3></center>
<div class="mdl-grid outer-grid">
  <div class="mdl-cell--6-col">
    <div class="mdl-grid main-grid">  
      <div class="mdl-cell--12-col">

          <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>AssignSubmit/student_upload">

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Assignment ID</span>
              <select name="a_id" class="form-control" aria-describedby="course-addon">
                <option ng-repeat='a in available' value={{a.a_id}}>{{a.a_id}}</option>
              </select>      
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Assignment</span>
              <input type="file" class="form-control" aria-describedby="course-addon" name="userfile" required>    
            </div>
            <h4><small>Valid Filetypes : gif, jpg, png, doc, docx, pdf, ppt, pptx, txt</small></h4>

            <center><button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Upload</button></center>
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
              <th><center>Assignment ID</center></th>
              <th><center>Submited On</center></th>
              <th><center>File</center></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat = 'a in submitAssigns'>
              <td><center>{{a.sno}}</center></td>
              <td><center>{{a.a_id}}</center></td>
              <td><center>{{a.dos | date:'dd-MM-yyyy'}}</center></td>
              <td><center><a href=<?php echo base_url(); ?>PostAssignment/assign_download?url={{a.path}}&file={{a.file_name}}><span class="glyphicon glyphicon-download-alt"></span></a></center></td>
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
