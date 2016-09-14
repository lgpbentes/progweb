<meta charset="UTF-8">
<?php
$usuario = "progweb";
$senha = "123456";

try {
	$conn = new PDO("mysql:host=localhost;dbname=gomoku", $usuario, $senha);
	
	$conn->exec("set names utf8");
	$stmt = $conn->prepare('SELECT * FROM  user where id_curso = 1');
	$stmt->execute();
	echo "alunos de sistemas de informação: </br>";
	while ($row = $stmt->fetch()) {
		print($row['username'] . "<br />");
	}
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
