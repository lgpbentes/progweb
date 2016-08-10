<meta charset="UTF-8">
<?php
$usuario = "root";
$senha = "36810869";

$nome = $_GET['nome'];
$sexo= $_GET['sexo'];
$comentarios = $_GET['comentarios'];


try {
	$conn = new PDO("mysql:host=localhost;dbname=gomoku", $usuario, $senha);
	
	$conn->exec("set names utf8");

	$stmt = $conn->prepare('INSERT INTO comentario (nome, sexo, comentarios) VALUES (:nome, :sexo, :comentarios)');
	$stmt->bindValue(':nome', $nome);
	$stmt->bindValue(':sexo', $sexo);
	$stmt->bindValue(':comentarios', $comentarios);

	$stmt->execute();
	print 'Comentário salvo';

	
} catch (PDOException $e) {
	echo $e->getMessage();
}
