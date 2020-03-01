<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
			div#coluna_esquerda {
				position:absolute;
				bottom: 30%;
				left: 280px;
				width: 435px;
				height: 370px;
				border: 3px solid #58acac;
				background-color:#fff;
			}
			div#coluna_direita {
				position:absolute;
				bottom: 30%;
				left: 550px;
				width: 435px;
				height: 370px;
				border: 3px solid #58acac;
				background-color:#fff;
			}
		</style>
        <style>
        	body{
				background-color:#cfe7e7;
			}
			b, h2, h3{
				color: #80c7c7;
				font-family:Century Gothic;
			}
			button {
				background-color: #e7afa0; /* Green */
				border: none;
				color: white;
				padding: 5px 15px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				font-family: Century Gothic;
			}
			#chat{
				background-color:#000;
				height:300px; 
				width:400px;
				position: relative;
			}
		</style>
</head>
<body>
	<center>
        	 <div id="coluna_esquerda"><br>
             <h3>Bem-Vindo <?php
	session_start();

	echo $_SESSION['login'];
	?>!</h3>
        <form method="post">
        <b>Ação:</b> <select name="acao">
            <option>Selecione uma ação</option>
         <?php

            $servidor='localhost';
            $usuario='root';
            $senha='maria';
            $banco='db_chat';
            $mysqli=new mysqli($servidor,$usuario,$senha,$banco);
            if(mysqli_connect_errno())trigger_error(mysqli_connect_error());

            $query=$mysqli->query("select * from tb_acao");
                while ($obj=mysqli_fetch_object($query))
                {
        ?>
                <option value=
        <?php
                    printf($obj->cd_acao);
        ?>
                >
        <?php
                    printf($obj->nm_acao);
                    printf("</option>");
                }
        ?>
        </select>
        <br/>
        <br/>
        <b>Para:</b> <select name="para">
        <option>Selecione um usuário</option>
        <?php
            $query=$mysqli->query("select * from tb_usuario");
                while ($obj=mysqli_fetch_object($query))
                {
        ?>
                <option value=
        <?php
                    printf($obj->cd_usuario);
        ?>
                >
        <?php
                    printf($obj->nm_usuario);
                    printf("</option>");
                }
        ?>  
        </select>
        <br/>
        <br/>
        <textarea rows="6" cols="45" name="texto"></textarea>  <br/>   
        <?php
            $query=$mysqli->query("select * from tb_emoji");
            while ($obj=mysqli_fetch_object($query))
            {
        ?>
        <input type="radio" name="emoticon" value=
        <?php
        	printf($obj->cd_emoji);
        ?>
                />
        <?php
        	printf($obj->ds_endereco);
        	}
        ?>
            <br/>
            <br/>
            <br/>
            <button type="reset" value="Limpar" id="Tira"> Limpar </button>
			<button type="submit" value="Enviar" id="Vai"> Enviar </button>
    </form>
<?php

	if(isset($_POST['texto'])){
	
	$servidor='localhost';
	$usuario='root';
	$senha='maria';
	$banco='db_chat';

	$mysqli=new mysqli($servidor,$usuario,$senha,$banco);
	if(mysqli_connect_errno())trigger_error(mysqli_connect_error());

	$acao=$_POST['acao'];
	$para=$_POST['para'];
	$mensagem=$_POST['texto'];
	$emoticon=$_POST['emoticon'];
	date_default_timezone_set("Brazil/East");
	$data= date("d/m/y",time());
	$sql = "INSERT INTO tb_chat
	values(null, '1','".$acao."', '".$para."', '".$mensagem."', '".$emoticon."', '".$data."')";
	if ($mysqli->query($sql)) {
    //echo "New record created successfully";
	}
	
	 else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
	}
	}
	?>
<div id="coluna_direita">
<div id="Chat">
<?php
	$query=$mysqli->query("	select tb_chat.cd_usuario_d, tb_usuario.nm_usuario as usuario1,
	tb_chat.cd_usuario_p, tb_usuario2.nm_usuario as usuario2, 
	tb_chat.cd_emoji, tb_emoji.ds_endereco, 
	tb_chat.cd_acao, tb_acao.nm_acao, tb_chat.ds_mensagem
	from tb_chat, tb_usuario, tb_usuario as tb_usuario2, tb_emoji, tb_acao
	where tb_chat.cd_usuario_d = tb_usuario.cd_usuario 
	and tb_chat.cd_usuario_p= tb_usuario2.cd_usuario
	and tb_chat.cd_emoji = tb_emoji.cd_emoji and tb_chat.cd_acao = tb_acao.cd_acao order by cd_chat desc");
	while ($obj=mysqli_fetch_object($query))
	{
		printf($obj->usuario1);
		printf(":&nbsp;&nbsp;|");
		printf($obj->nm_acao);
		printf("|&nbsp;&nbsp;");
		printf($obj->usuario2);
		printf("&nbsp;&nbsp;--&nbsp;&nbsp;");
		printf($obj->ds_mensagem);
		printf("&nbsp;");
		printf($obj->ds_endereco);
		printf("<br>");
	}	
?>
</div>
</div>
</div>
</body>
</html>