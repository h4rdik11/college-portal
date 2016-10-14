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

<div ng-app="AdminNoticeApp" ng-controller="AdminNoticeCtlr">
  <div class="mdl-grid outer-grid">
    
    <div class="mdl-cell--6-col">
        <div class="mdl-grid main-grid">
          <div class="mdl-cell--12-col">

            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>AdminNotice/notice_upload">

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Subject</span>
              <input type="text" name="subject" class="form-control" aria-describedby="course-addon" required>      
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Message</span>
              <textarea name="msg" class="form-control" aria-describedby="course-addon" rows="8 "></textarea>       
            </div>

            <div class="input-group" >
              <span class="input-group-addon" id="course-addon">Upload A File (If Required)</span>
              <input type="file" class="form-control" aria-describedby="course-addon" name="userfile">      
            </div>
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
                <th><center>#</center></th>
                <th><center>Upload Date</center></th>
                <th><center>File</center></th>
                <th><center>Message</center></th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat = 'n in notices'>
                <td><center>{{n.n_id}}</center></td>
                <td><center>{{n.date | date:'dd-MM-yyyy'}}</center></td>
                <td><center><a href="<?php echo base_url(); ?>Announce/announce_download?url={{n.file}}&file={{n.file_name}}"><span class="glyphicon glyphicon-download-alt"></span></a></center></td>
                <td><center><a href="" ng-click="readMsg(n.subject, n.message)"><span class="glyphicon glyphicon-comment"></span></a></center></td>
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
