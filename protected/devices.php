<?php
      session_start();
      include("./header.php");
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
      echo '   <p class="lead">this is the devices of your patients list</p>';
      echo '   <hr class="my-4">';

      $devices = getDevices($_SESSION['email'], $_SESSION['token']);
      echo '<div class="table-responsive">';
      echo '<table class="table">';

      //[69948] [{"devicename":"C99+","macaddr":"CA043212C919","idpatient":1,"id":0}]

      echo '  <thead>';
      echo '    <tr class="filters">';
      echo '      <th>ID</th>';
      echo '      <th>Identification</th>';
      echo '      <th>MAC ADDR</th>';
      echo '      <th>Patient Id</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo ' <tbody>';


        foreach($devices as $device){
            echo '<tr>';
            echo '<td>'.$device['id'].'</td>';
            echo '<td>'.$device['devicename'].'</td>';
            echo '<td>'.$device['macaddr'].'</td>';
            echo '<td>'.$device['idpatient'].'</td>';
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
