<?php

  include 'classes.php';

  $HOST = 'http://localhost:888/CardioblocSRV/DatasServices/';
  $ERR  = 'http://localhost/demoAPI/#Error';

  function gettoken($email) {
	try {
      $url = $GLOBALS['HOST'].'gettoken?JSonValue=[{"email":"'.$email.'"}]';
      $json  = json_decode(file_get_contents($url), true);
      $dec   = (Array)$json['result'];
      $information = json_decode($dec[0], true);
      return $information['information'];
	} catch (Exception $e) {
		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getPatients($email, $token) {
    try {
        $url = $GLOBALS['HOST'].'getpatients?JSonValue=[{"email":"'.$email.'","token":"'.$token.'"}]';
        $json     = json_decode(file_get_contents($url), True);
        $dec      = (Array)$json['result'];
        $patients = (Array)json_decode($dec[0], True);
        return $patients;
  	} catch (Exception $e) {
  		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getdevices($email, $token) {
    try {
        $url = $GLOBALS['HOST'].'getdevices?JSonValue=[{"email":"'.$email.'","token":"'.$token.'"}]';
        $json     = json_decode(file_get_contents($url), True);
        $dec      = (Array)$json['result'];
        $devices = (Array)json_decode($dec[0], True);
        return $devices;
  	} catch (Exception $e) {
  		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getParamValues($email, $token) {
    try {
        $url = $GLOBALS['HOST'].'getParamValues?JSonValue=[{"email":"'.$email.'","token":"'.$token.'","patient_id":"1"}]';
        $json     = json_decode(file_get_contents($url), True);
        $dec      = (Array)$json['result'];
        $values = (Array)json_decode($dec[0], True);
        
        return $values;
  	} catch (Exception $e) {
  		header('Location: '.$GLOBALS['ERR']);
    }
  }


  function getUsers($email, $token) {
    try {
        $url = $GLOBALS['HOST'].'getUsers?JSonValue=[{"email":"'.$email.'","token":"'.$token.'"}]';
        $json     = json_decode(file_get_contents($url), True);
        $dec      = (Array)$json['result'];
        $users    = (Array)json_decode($dec[0], True);
        return $users;
  	} catch (Exception $e) {
  		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getParameters($email, $token) {
    try {
        $url = $GLOBALS['HOST'].'getParameters?JSonValue=[{"email":"'.$email.'","token":"'.$token.'"}]';
        $json     = json_decode(file_get_contents($url), True);
        $dec      = (Array)$json['result'];
        $parameters    = (Array)json_decode($dec[0], True);
        return $parameters;
  	} catch (Exception $e) {
  		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getcontractnumber($email) {
	try {
      $url = $GLOBALS['HOST'].'getcontractnumber?JSonValue=[{"email":"'.$email.'"}]';
      $json  = json_decode(file_get_contents($url), true);
      $dec   = (Array)$json['result'];
      $information = json_decode($dec[0], true);
      return $information['information'];
	} catch (Exception $e) {
		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getcontract($email, $token) {
    try {
	    $url = $GLOBALS['HOST'].'getcontract?JSonValue=[{"email":"'.$email.'","token":"'.$token.'"}]';
      $json     = json_decode(file_get_contents($url), True);
      $dec      = (Array)$json['result'];
      $js       = substr($dec[0], 29, -2);
      $contract = (Array)json_decode($js, True);

      $c = new contract();
      $c->id             = $contract['id'];
      $c->demo           = $contract['demo'];
      $c->frequency      = $contract['frequency'];
      $c->contractNumber = $contract['contractNumber'];
      $c->date_start     = $contract['date_start'];
      $c->date_end       = $contract['date_end'];
      $c->idCustomer     = $contract['idCustomer'];
      $c->active         = $contract['active'];
      return $c;
	  } catch (Exception $e) {
		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function getcustomer($email) {
    try {
	  $url = $GLOBALS['HOST'].'getcustomer?JSonValue=[{"email":"'.$email.'"}]';
      $json     = json_decode(file_get_contents($url), True);
      $dec      = (Array)$json['result']; //
      $js       = substr($dec[0], 29, -2); // extract json under json
      $customer = (Array)json_decode($js, True);

      $c = new customer();
      $c->name = $customer['name'];
      $c->email= $customer['email'];
      return $c;
	  } catch (Exception $e) {
		header('Location: '.$GLOBALS['ERR']);
    }
  }

  function setUser($email, $login, $password) {
    try {
      $url = $GLOBALS['HOST'].'setuser?JSonValue=[{"email":"'.$email.'","login":"'.$login.'";"password":"'.$password.'"}]';
      $json    = json_decode(file_get_contents($url), True);
      $dec     = (Array)$json['result'];
      $information = json_decode($dec[0], true);
      return $information['information'];
	  } catch (Exception $e) {
		header('Location: '.$GLOBALS['ERR']);
    }
  }

 ?>
