<?php
$page = "index";
  require_once 'inc/header.php';
  is_authenticated();
  $rank = check_rank($_SESSION['auth']->id_rank);
  $id = $_SESSION['auth']->id;
  if (isset($_POST['dirForm'])){
  	$target_dir = "admin/directory/" . $_POST['dirForm'] ."/";
			}
  else {
  	$target_dir = "";
  }
?>

  <div class="container">
    <br/>
    <div class="header clearfix">
      <nav>

        <ul class="nav nav-pills pull-right">
          <?php

          if($rank === "admin"){
            echo "<li><a href=\"".WEBROOT."admin\">Panel admin</a></li>";
          }
          ?>
          <li><a href="logout.php">Se déconnecter</a></li>
        </ul>

      </nav>
      <h3><a href="/index.php" style='display:block;text-decoration: none; color: black;'>Files Manager</a></h3>

    </div>

    <div class="jumbotron">

      <form class="form-group" id="uploadForm" action="index.php"method="post" enctype=multipart/form-data>
          <input type="file" name="upfile" class="file">
          <div class="input-group col-xs-12">
            <input type="text" class="form-control" name="theFile" disabled placeholder="Uploader un fichier">
            <span class="input-group-btn">
              <button class="browse btn btn-primary" type="button"><i class="glyphicon glyphicon-file"></i> Choisir un fichier</button>
            </span>
          </div>
          <br/>
         <!-- Liste de sélection du dossier d'upload -->
          <div class="form-group">
 			 <select class="form-control" id="sel1" name="dirForm">
 			 <option> Choisir un dossier </option>
 			 <?php 
 			 	  $director = $pdo->query("SELECT id FROM directory WHERE id_user = $id");
 			 	  while($dirs = $director->fetch()){
 			 	  	echo "<option value= ".$dirs->id." > ".$dirs->id." </option>";
 			 	  }
 			 ?>
			  </select>
			</div>
		<?php if (isset($_POST['dirForm'])){	
			$upfile = basename($_FILES['upfile']['name']);
			$temp = $_FILES["upfile"]["tmp_name"];
			upload($target_dir, $upfile, $temp);
			}
			?>
          <br/>
          <div>
          </div>
          <input type="submit" id="btnSubmit" value="Uploader" class="btn btn-success" />
          <br/><br/>
          <div id="progress-bar-div" class="progress progress-striped active">
            <div id="progress-bar" class="progress-bar progress-bar-success" style="width: 0%">0%</div>
          </div>

      </form>
      <div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>
      
      <table class ="table table-hover table-striped">
         <p>Vos fichiers:</p>
       <!-- Liste des fichiers -->
       <tr>
        <?php 
          $directory = $pdo->query("SELECT id FROM directory WHERE id_user = $id");
          while($dir = $directory->fetch()){
  		  $files = read_directory('admin/directory/' .$dir->id);
          foreach ($files as $fichiers) {
          if($fichiers != "." && $fichiers != ".."){
 			$fi = urlencode($fichiers);
 			$fi = rawurlencode(utf8_encode($fichiers));
          	$filelink = "admin/directory/" .$dir->id ."/". $fi;
           echo '<tr> <td> <a href='.$filelink.' style=" display:block;text-decoration: none;color: black;"> '.$fichiers.' </a> </td> <td> '.$dir->id;' </td> </tr> ';
          }
        }
      }
        ?>

       </table>
    </div><!-- /jumbotron -->

  </div><!-- /container -->


<?php
  require_once 'inc/footer.php';
?>
<script type="text/javascript">
$(document).ready(function() {
  $('div#progress-bar-div').hide();
  $('#uploadForm').submit(function(e) {
      if($('#theFile').val()) {
          e.preventDefault();
          $('#loader-icon').show();
          $(this).ajaxSubmit({
              target:   '#targetLayer',
              beforeSubmit: function() {
                  $("#progress-bar").width('0%');
              },
              uploadProgress: function (event, position, total, percentComplete){
                  $("#progress-bar").css('width', percentComplete + '%');
                  $("#progress-bar").html(percentComplete + '%')
              },
              success:function (){
                  $('#loader-icon').hide();
              },
              resetForm: true
          });
          return false;
      }
  });
});

$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  $('div#progress-bar-div').show();
});

</script>
