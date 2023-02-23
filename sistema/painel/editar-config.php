<?php 
require_once('../conexao.php');


$nome = $_POST['nome_sistema'];
$email = $_POST['email_sistema'];
$whatsapp = $_POST['whatsapp_sistema'];
$fixo = $_POST['telefone_fixo_sistema'];
$endereco = $_POST['endereco_sistema'];
$tipo_rel = $_POST['tipo_rel'];
$instagram = $_POST['instagram_sistema'];
$tipo_comissao = $_POST['tipo_comissao'];

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$caminho = '../img/logo.png';
$imagem_temp = @$_FILES['foto-logo']['tmp_name']; 
if(@$_FILES['foto-logo']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para a Logo é somente *PNG';
		exit();
	}

}



$caminho = '../img/favicon.ico';
$imagem_temp = @$_FILES['foto-icone']['tmp_name']; 
if(@$_FILES['foto-icone']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-icone']['name'], PATHINFO_EXTENSION);   
	if($ext == 'ico'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para a ícone é somente *ICO';
		exit();
	}

}



$caminho = '../img/logo_rel.jpg';
$imagem_temp = @$_FILES['foto-logo-rel']['tmp_name']; 
if(@$_FILES['foto-logo-rel']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo-rel']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para o Relatório é somente *Jpg';
		exit();
	}

}




$query = $pdo->prepare("UPDATE config SET nome = :nome, email = :email, telefone_whatsapp = :whatsapp, telefone_fixo = :telefone_fixo, endereco = :endereco, logo = 'logo.png', icone = 'favicon.ico', logo_rel = 'logo_rel.jpg', tipo_rel = '$tipo_rel', instagram = :instagram, tipo_comissao = '$tipo_comissao' ");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":whatsapp", "$whatsapp");
$query->bindValue(":telefone_fixo", "$fixo");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":instagram", "$instagram");

$query->execute();

echo 'Editado com Sucesso';
 ?>