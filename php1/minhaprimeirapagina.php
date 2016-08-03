<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Minha primeira página</title>
</head>
<body>
<h1>Este é um grande cabeçalho</h1>
<h3>E este aqui é um pequeno cabeçalho</h3>
<p>Aqui eu coloquei um parágrafo com algum texto aleatório, e a seguir vou inserir um formulário dentro de uma tabela. Além disso, aqui vai um link: <a href="http://icomp.ufam.edu.br/david">http://icomp.ufam.edu.br/david</a></p>

<table  cellspacing="10px">
<form id = "formulario" method="GET" action="processa.php"> 
	<tr>
		<td>Seu nome </td>
		<td> <input id="nome" name="nome" type "text"></input> </td>
	</tr>
	<tr>
		<td>Seu sexo</td>
		<td><select name="sexo" id="sexo">
			<option value="1">Masculino</option>
			<option value="2" selected >Feminino</option>
		</select></td>
	</tr>

	<tr>
		<td>Comentarios</td>
		<td><textarea name = "comentarios" rows = "5" cols="50"></textarea></td>

	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name ="submit" value="Enviar"></input></td>
	</tr>
	
</form>
</table>
</body>
</html>