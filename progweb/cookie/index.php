<?php
	if (isset($_COOKIE['cookie_teste'])){
		echo 'Voce ja passou por aqui!';
	} else{
		echo 'Voce NUNCA passou por aqui.';
		setcookie('cookie_teste', 'Algum valor...',time()+3600);
	}
?>