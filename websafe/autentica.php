<?php
	if(isset($_POST['usuario']) && isset($_POST['senha'])){
		$conn =new PDO("mysql:host=localhost;dbname=websafe","root","");
		$stmt=$conn->prepare("select * from autenticacao where ".
			"usuario=:u and senha=:s");
		$stmt->bindValue(":u",$_POST['usuario']);
		$stmt->bindValue(":s",sha1($_POST['senha']));
		$stmt->execute();
		if($stmt->rowCount()==1){
			session_start();
			$_SESSION['usuario']=$_POST['usuario'];
			header("Location:deuruim.php");
		}else{
			echo "<p>Usuario ou senha inválido!</p>";
			echo "<p><a href='index.php'>Tente Novamente</a></p>";
		}		
	}else{
		echo "<p>Usuario ou senha inválido!</p>";
		echo "<p><a href='login.php'>Tente Novamente</a></p>";
	}
?>