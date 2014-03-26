<meta charset='UTF-8'>
<?php
require_once 'vars.php';
require_once 'Mandrill.php';
try{
	$mandrill = new Mandrill($API_KEY_MANDRILL);

    $message = array(
    	'text' => "Contato Semcomp 17\nEnviado por: *|NOME|*\nE-mail: *|EMAIL|*\nMensagem:\n*|MENS|*",
    	'html' => "<html>
					<head>
						<meta charset='UTF-8'>
					</head>
					<body style='background-color: #eee; margin: 0px; padding: 0px;'>
					<div style='padding: 15px;'>
					<a href='http://semcomp.icmc.usp.br'><img src='http://semcomp.icmc.usp.br/images/logo-semcomp.png' height='100px'></a>
					</div>
					<div style='font-family:  \"Open Sans\", \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif; background-color: #fff; padding: 20px;'>
					<h2>Contato Semcomp 17</h2>
					<p><strong>Enviado por:</strong> *|NOME|*</p>
					<p><strong>E-mail:</strong> *|EMAIL|*</p>
					<p><strong>Mensagem:</strong></p>
					<p>*|MENS|*</p>
					</div>
					<div style='padding: 15px;'>
						<div style='float:right;'>
						<a href='https://facebook.com/semcomp17'><img src='http://semcomp.icmc.usp.br/images/facebook-72.png' height='50px'></a>
						<a href='https://plus.google.com/103900653682189265366'><img src='http://semcomp.icmc.usp.br/images/google-plus-72.png' height='50px'></a>
						<a href='https://twitter.com/semcomp'><img src='http://semcomp.icmc.usp.br/images/twitter-72.png' height='50px'></a>
						</div>
					</div>
					</body>
					</html>",
		'subject' => 'Contato Semcomp',
		"from_name" => $_POST["nome"],
		"from_email" => $_POST["email"],
		"to" => array(
					array("email" => "brorlandi@gmail.com"),
					array("email" => "fcoelho.9@gmail.com"),
					array("email" => "andre.missaglia@gmail.com")
				),
		"auto_text" => true,
		"track_opens" => true,
		"track_clicks" => true,
        'global_merge_vars' => array(
	            array('name' => 'NOME',
	                'content' => $_POST["nome"]),
	            array('name' => 'EMAIL',
	                'content' => $_POST["email"]),
	            array('name' => 'MENS',
	                'content' => $_POST["mensagem"]),
	        )
		);
	$async = false;
	$result = $mandrill->messages->send($message, $async);
    if($result[0]['status'] !== 'sent' && $result[1]['status'] !== 'sent' && $result[2]['status'] !== 'sent'){
    	echo "<p>Não foi possível enviar sua mensagem, ocorreu um erro!</p><p>Envie um e-mail <a href=\"malito:semcomp@icmc.usp.br\">semcomp@icmc.usp.br</a> relatando o problema!</p>";
    	return;
    }

    $message = array(
    	'text' => "Contato Semcomp 17\nOlá *|NOME|*, seu e-mail foi recebido e iremos respondê-lo assim que possível.\n\nEnquanto isso, fique por dentro das novidades da Semcomp 17 nas redes sociais:\n\nhttp://facebook.com/semcomp17\nhttp://twitter.com/semcomp\nhttp://google.com/+semcomp",
    	'html' => "<html>
<head>
	<meta charset='UTF-8'>
</head>
<body style='font-family:  \"Open Sans\", \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif; background-color: #eee; margin: 0px; padding: 0px;'>
<div style='padding: 15px;'>
<a href='http://semcomp.icmc.usp.br'><img src='http://semcomp.icmc.usp.br/images/logo-semcomp.png' height='100px'></a>
</div>

<div style='color: white; background-color: #003E5E; padding: 20px;'>

<h2>Contato Semcomp 17</h2>
<p>Olá *|NOME|*, seu e-mail foi recebido iremos respondê-lo assim que possível.</p>
</div>
<div style='padding: 15px;'>
	<div style='float:right;'>
	<a href='https://facebook.com/semcomp17'><img src='http://semcomp.icmc.usp.br/images/facebook-72.png' height='50px'></a>
	<a href='https://plus.google.com/103900653682189265366'><img src='http://semcomp.icmc.usp.br/images/google-plus-72.png' height='50px'></a>
	<a href='https://twitter.com/semcomp'><img src='http://semcomp.icmc.usp.br/images/twitter-72.png' height='50px'></a>
	</div>
	<div style='text-align: center; display: block; margin-left: auto; margin-right: auto; min-height: 50px; vertical-align: middle;'>
		Enquanto isso fique por dentro das novidades da Semcomp 17 nas redes sociais.
	</div>
</div>
</body>
</html>",
		'subject' => 'Contato Semcomp',
		"from_name" => "Semcomp",
		"from_email" => "semcomp@icmc.usp.br",
		"to" => array(
					array("email" => $_POST["email"])
				),
		"auto_text" => true,
		"track_opens" => true,
		"track_clicks" => true,
		'merge_vars' => array(
				            array(
				                'rcpt' => $_POST["email"],
				                'vars' => array(
				                    array(
				                        'name' => 'NOME',
				                        'content' => $_POST["nome"]
				                    )
				                )
				            )
				        )	
		);
	$async = false;
	$result = $mandrill->messages->send($message, $async);
    if($result[0]['status'] === 'sent'){
    	echo "<p>Sua mensagem foi enviada com sucesso!</p>";
    	return;
    }

} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo '<h3>A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage() . '</h3>';
    throw $e;
}
?>
