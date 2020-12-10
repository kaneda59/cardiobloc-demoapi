<?php
      session_start();
      include ("./header.php");
      include '../webapi-cardiobloc.php';


      function StateOfString($state) {
		  if ($state == 1) { $res = 'enabled'; }
          else {$res = 'desabled'; }
        return $res;
      }

	  function ModeOfString($Mode) {
		  if ($Mode == 0) { $res = 'licence'; }
          else { $res = 'demonstration'; }
        return $res;
	  }

    if (isset($_SESSION['email'])) {
      echo '   <h1 class="display-4">Hello, '.$_SESSION['name'].'</h1>';
      echo '   <p class="lead">this is your patients list</p>';
      echo '   <hr class="my-4">';

      $patients = getPatients($_SESSION['email'], $_SESSION['token']);
      echo '<div class="table-responsive">';
      echo '<table class="table">';

      echo '  <thead>';
      echo '    <tr class="filters">';
      echo '      <th>ID</th>';
      echo '      <th>First Name</th>';
      echo '      <th>Last Name</th>';
      echo '      <th>Birth Date</th>';
      echo '      <th>NIP</th>';
      echo '      <th>Mail</th>';
      echo '      <th>mobile</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo ' <tbody>';

        foreach($patients as $patient){
            echo '<tr>';
            echo '<td>'.$patient['id'].'</td>';
            echo '<td>'.$patient['firstname'].'</td>';
            echo '<td>'.$patient['lastname'].'</td>';
            echo '<td>'.$patient['birthdate'].'</td>';
            echo '<td>'.$patient['nip'].'</td>';
            echo '<td>'.$patient['email'].'</td>';
            echo '<td>'.$patient['mobile'].'</td>';
            echo '</tr>';
            //echo $patient[''];

        };
      echo '</tbody>';
      echo '</table>';
      echo '<hr class="my-4">';
      echo '</div>';
    }
   ?>

    </div>
    <?php include("./footer.php"); ?>
  </body>
  </html>
