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

      function Show_contract($c) {
	    	echo '<table class="table table-striped table-dark table-sm">';
        echo '<thead>';
        echo '    <tr>';
        echo '      <th scope="col">field</th>';
        echo '      <th scope="col">value</th>';
        echo '    </tr>';
        echo '  </thead>';
        echo '  <tbody>';
        echo '    <tr>';
        echo '      <td>contract id</td>';
        echo '      <td>'.$c->id.'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>State</td>';
        echo '      <td>'.StateOfString($c->active).'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>Mode</td>';
        echo '      <td>'.ModeOfString($c->demo).'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>Frequency</td>';
        echo '      <td>'.$c->frequency.' month</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>Number</td>';
        echo '      <td>'.$c->contractNumber.'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>Start</td>';
        echo '      <td>'.$c->date_start.'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>End</td>';
        echo '      <td>'.$c->date_end.'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '      <td>Your customer id</td>';
        echo '      <td>'.$c->idCustomer.'</td>';
        echo '    </tr>';
        echo '    <tr>';
        echo '</tbody>';
        echo '</table>';
      }


        if ( (isset($_POST['email'])) || (isset($_SESSION['email'])) ) {
          try {
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }
            else
            {
                $email = $_SESSION['email'];
            }

            $token          = gettoken($email);
            $contractnumber = getcontractnumber($email);
            $me             = getcustomer($email);

            $_SESSION["token"] = $token;
            $_SESSION['email'] = $email;
            $_SESSION['name']  = $me->name;

            if ($token == "contract is not active") {
              echo "erreur connexion";
              header ('Location : http://localhost/demoAPI/#Error');
            }
            else {
              echo '   <h1 class="display-4">Hello, '.$me->name.'</h1>';
              echo '   <p class="lead">Your are connected with token.</p>';
              echo '   <hr class="my-4">';
              echo '     <p>'.$token.'</p>';
              echo '   <p class="lead">Your contract</p>';
              $contract = getcontract($email, $token);
              Show_contract($contract);
            }

          } catch (\Exception $e) {
            header ('Location : http://localhost/demoAPI/#Error');
          }
	    }



    ?>

  </div>
  <?php include("./footer.php"); ?>
</body>
</html>
