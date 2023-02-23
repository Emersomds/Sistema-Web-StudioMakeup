<?php

    session_start();
    require_once("conexao.php");
    //Inserir um usuário administrativo caso não exista
    $senha = "123";
    $senha_crip = md5($senha);

    $query = $pdo->query("SELECT * from usuarios where nivel = 'Administrador'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg == 0){
        $pdo->query("INSERT INTO usuarios SET nome = 'Emerson Matos', email = '$email_sistema', cpf = '000.000.000-00', senha = '$senha', senha_crip = '$senha_crip', nivel = 'Administrador', data = curDate(), ativo = 'Sim', foto = 'sem-foto.jpg'");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome_sistema?></title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="css/style_login.css">
    <link rel="shortcut icon" href="img/icon.ico">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
  
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading" align="center">
                    <img src="img/logoJessy2.png" width="250px">
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" action="autenticar.php" method="post">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="email" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Senha" name="senha" type="password" value="" required>
			    		</div>
			    		
			    		<input class="btn btn-lg btn-success btn-block" id="btn-login" type="submit" value="Login">
			    	</fieldset>
                    <p class="recuperar"><a title="Clique para recuperar a senha" href="" data-toggle="modal" data-target="#exampleModal">Recuperar Senha</a></p>
			      	</form>
                      <p>
                            <?php 
                            //Recuperando o valor da variável global, os erro de login.
                            if(isset($_SESSION['loginErro'])){
                                echo $_SESSION['loginErro'];
                                unset($_SESSION['loginErro']);
                            }?>
                      </p>
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>


<!-- Modal Recuperar a senha-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:400px">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
        <button id="btn-fechar-rec" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <form method="post" id="form-recuperar">
      <div class="modal-body">
        
        	<input placeholder="Digite seu Email" class="form-control" type="email" name="email" id="email-recuperar" required>        	
       
       <br>
       <small><div id="mensagem-recuperar" align="center"></div></small>
      </div>
      <div class="modal-footer">      
        <button type="submit" class="btn btn-primary"id="btn-login">Recuperar</button>
      </div>
  </form>
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


 <script type="text/javascript">
	$("#form-recuperar").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "recuperar-senha.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-recuperar').text('');
				$('#mensagem-recuperar').removeClass()
				if (mensagem.trim() == "Recuperado com Sucesso") {
					//$('#btn-fechar-rec').click();					
					$('#email-recuperar').val('');
					$('#mensagem-recuperar').addClass('text-success')
					$('#mensagem-recuperar').text('Sua Senha foi enviada para o Email')			

				} else {

					$('#mensagem-recuperar').addClass('text-danger')
					$('#mensagem-recuperar').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>
