<meta charset="UTF-8">
<?php
$usuario = "progweb";
$senha = "123456";

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
	print '<p>Comentário salvo:</p><p>Nome: '.$nome.'</p><p>Sexo: '. $sexo . '</p><p>Comentario: ' . $comentarios.'</p>';

	
} catch (PDOException $e) {
	echo $e->getMessage();
}
