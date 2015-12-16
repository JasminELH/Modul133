<?php
	if(isset($_GET['controller'])){
		include_once 'controller/'.$_GET['controller'].'Controller.php';
		$cname = $_GET['controller'].'Controller';
		$controller = new $cname();
		if(isset($_GET['action'])) {		
			$controller->$_GET['action']();
		}
		//$controller->liste();
	}else{
		echo "Sie müssen sich einloggen!";
		include_once 'loginform.php'; 
	
	session_start();
	if(isset($_POST['user'])){
		session_unset();
		if(!isset($_SESSION['users']) ){
			$_SESSION['users'] = file("users.txt");
		}
		foreach($_SESSION['users'] as $user) {
			$u = split(":", $user);
			if($_POST['user'] == trim($u[0])){
				if($_POST['password'] == trim($u[1])) {
					$_SESSION['user'] = $u[0];				
					$message = 'Login erfolgreich';
				}else{
					$message = 'Passwort falsch';				
				}				
				break;			
			}else {
				$message = 'Benutzer existiert nicht';			
			}	
		}	
	}
	if(isset($_GET['logout'])) {
		session_unset();
		echo "Sie wurden abgemeldet!<br>";
		header('Refresh: 3; URL=loginform.php');			
	}
	
	if(isset($_SESSION['user'])) {	
		echo "Hallo " . $_SESSION['user'] . '<br>';
		echo "<a href='?logout'>Logout</a><br>";
	}
	if(isset($message)){
		echo $message;		
		header('Refresh: 3; URL=loginform.php');		
	}

}

	
	//$controller = new RolleController();
	//$controller->liste();


	/*include_once 'Rolle.php';
	include_once 'Account.php';
	
	$rollea = new Rolle(1,'Admin');
	$rollek = new Rolle(2,'Kunde');
	//echo $rolle->getName();
	$accounts = array();
	$accounts[] = new Account(1,"Buchs", "Enrico", "ebuchs", "sagichnicht",$rollea);
	$accounts[] = new Account(2,"Steffen", "Carlos", "mexicho", "mafia",$rollek);
	
	foreach($accounts as $account){
		var_dump($account);		
		
		echo $account->getName() . ' ' . $account->getRolle()->getName() . '<br>';	
	}*/


?>


	


	
	


