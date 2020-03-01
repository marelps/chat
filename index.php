<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
	<style>
			div#coluna_central {
				position:absolute;
				bottom: 30%;
				left: 600px;
				width: 400px;
				height: 350px;
				border: 3px solid #58acac;
				background-color:#fff;
			}
			h2{
				color: #80c7c7;
				font-family: Century Gothic;
			}
			button {
				background-color: #e7afa0; /* Azul */
				border: none;
				color: white;
				padding: 5px 15px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				font-family: Century Gothic;
			}
			body{
				background-color:#cfe7e7;
			}
	</style>
</head>
<body>
<div id="coluna_central">
<center><h2>CHAT</h2></center>
<?php
session_start();
$servidor='localhost';
$usuario='root';
$senha='maria';
$banco='db_chat';

$mysqli=new mysqli($servidor,$usuario,$senha,$banco);
if(mysqli_connect_errno())trigger_error(mysqli_connect_error());

if(isset($_POST['emo'])){
if ($_POST['login']=="top" && $_POST['senha']=="1234") {
$_SESSION['login']=$_POST['login'];
header("location:mensagens.php");
}
}
?>
<center>
	<form method="post">
    <input type="text" name="login" placeholder="Digite seu nome de usuário"/><br/> <br/>
    <input type="password" name="senha" placeholder="Digite sua senha"/><br/> <br/>
    <?php
            $query=$mysqli->query("select * from tb_avatar");
                while ($obj=mysqli_fetch_object($query))
                {
        ?>
                <input type="radio" name="emo" value="
        <?php
                    printf($obj->cd_avatar);
        ?>
                "/>
        <?php
                    printf($obj->ds_endereco);
                }
        ?>
    <br/> <br />
	<button type="reset" value="Limpar" id="Grood"> Limpar </button>
				<button type="submit" value="Entrar" id="Bot"> Entrar </button>  
	</center>
</form>
    

</body>
</html>