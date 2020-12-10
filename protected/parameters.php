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
      echo '   <p class="lead">this is the parameters</p>';
      echo '   <hr class="my-4">';

      $parameters = getParameters($_SESSION['email'], $_SESSION['token']);
      echo '<div class="table-responsive">';
      echo '<table class="table">';

      echo '  <thead>';
      echo '    <tr class="filters">';
      echo '      <th>ID</th>';
      echo '      <th>Code</th>';
      echo '      <th>Unit</th>';
      echo '    </tr>';
      echo '  </thead>';
      echo ' <tbody>';

        foreach($parameters as $parameter){
            echo '<tr>';
            echo '<td>'.$parameter['id'].'</td>';
            echo '<td>'.$parameter['code'].'</td>';
            echo '<td>'.$parameter['unitycode'].'</td>';
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
