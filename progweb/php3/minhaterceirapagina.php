<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Escrevendo um comentário</title>
</head>
<body>
<h1>Escreva seu comentário aqui</h1>


<table  cellspacing="10px">
<form id = "formulario" method="GET" action="processa.php"> 
	<tr>
		<td>Seu nome </td>
		<td> <input id="nome" name="nome" type "text"></input> </td>
	</tr>
	<tr>
		<td>Seu sexo</td>
		<td><select name="sexo" id="sexo">
			<option value="M">Masculino</option>
			<option value="F" selected >Feminino</option>
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