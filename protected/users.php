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
      echo '   <p class="lead">this is your users list</p>';
      echo '   <hr class="my-4">';

      $users = getUsers($_SESSION['email'], $_SESSION['token']);
      echo '<div class="table-responsive">';
      echo '<table class="table">';

      echo '  <thead>';
      echo '    <tr class="filters">';
      echo '      <th>ID</th>';
      echo '      <th>email</th>';
      echo '      <th>login</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo ' <tbody>';

        foreach($users as $user){
            echo '<tr>';
            echo '<td>'.$user['id'].'</td>';
            echo '<td>'.$user['email'].'</td>';
            echo '<td>'.$user['login'].'</td>';
            echo '</tr>';

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
