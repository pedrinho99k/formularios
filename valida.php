<?php
session_start();
function Conectar()
{
    require_once("config/config.php");
    $dsn = 'mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8';
    $user = USER;
    $pass = PASS;
    try {
        $pdo = new PDO($dsn, $user, $pass);
        //echo 'Conectado com sucesso!';
        return $pdo;
    } catch (PDOException $ex) {
        echo 'Erro: ' . $ex->getMessage();
    }
}
if ((isset($_POST['login'])) && (isset($_POST['senha']))) {

	require_once('config/config.php');
	$ldapconfig['host'] = HOSTLDAP; //AD-001
	$ldapconfig['port'] = PORTA; //Porta Padrão
	$ldapconfig['dn'] = "";
	$domain = DOMAIN;
	$login = $_POST['login'];
	$password = $_POST['senha'];

	//Faz conexão com AD usando LDAP
	$sn = ldap_connect($ldapconfig['host'], $ldapconfig['port']);
	ldap_set_option($sn, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($sn, LDAP_OPT_REFERRALS, 0);

	if (@$bind = ldap_bind($sn, PREF . $login, $password)) {

		$_SESSION['usuarioId'] = $resultado['cod_usuario'];
		$_SESSION['usuarioNome'] = $resultado['nome_usuario'];



		$filter = "(sAMAccountName=" . $login . ")";
		$attributes = array('displayname', 'mail');
		$search = ldap_search($sn, 'DC=hrim, DC=local', $filter, $attributes);

		$data = ldap_get_entries($sn, $search);

		for ($i = 0; $i < $data["count"]; $i++) {
			//Pega o nome do usuario no AD
			if (isset($data[$i]["displayname"][0])) {
				$usu_nome = $data[$i]["displayname"][0];
				$_SESSION['usuarioNome'] = $data[$i]["displayname"][0];
			} else {
				$usu_nome = null;
				$_SESSION['usuarioNome'] = null;
			}
			//Pega o Email no AD do usuário
			if (isset($data[$i]["mail"][0])) {
				$usu_email = $data[$i]["mail"][0];
				$_SESSION['usuarioEmail'] = $data[$i]["mail"][0];
			} else {
				$usu_email = null;
				$_SESSION['usuarioEmail'] = null;
			}
		}
		//Salva as informações vindas do AD no BD do Boletim Médico
		
		$conecta = Conectar();
		$sql_select = "SELECT*FROM fm_usuarios WHERE usu_login = '$login'";
		$stm = $conecta->prepare($sql_select);
		$stm->execute();
		$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($retorno) == 0) {

			$sql_insert = "INSERT INTO fm_usuarios (usu_login,usu_nome,usu_email,usu_codigo_perfil)VALUES('$login','$usu_nome','$usu_email',2)";
			$stmt = $conecta->prepare($sql_insert);

			if ($stmt->execute()) {

				$sql_select = "SELECT*FROM fm_usuarios JOIN fm_perfil ON fm_perfil.per_codigo = fm_usuarios.usu_codigo_perfil WHERE usu_login = '$login'";
				$stm = $conecta->prepare($sql_select);
				$stm->execute();
				$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
				if (count($retorno) > 0) {
					for ($i = 0; $i < count($retorno); $i++) {
						$_SESSION['usuarioId'] = $retorno[$i]['usu_codigo'];
						$_SESSION['usuarioAtivo'] = $retorno[$i]['usu_ativo'];
						$_SESSION['codPerfil'] = $retorno[$i]['usu_codigo_perfil'];
						$_SESSION['descPerfil'] = $retorno[$i]['per_descricao'];
						header("Location: index.php");
					}
				} else {
					echo "Erro ao buscar informações";
				}
			} else {
				echo "Erro ao Salvar!" . $sql_insert;
			}
		} else {
			for ($i = 0; $i < count($retorno); $i++) {
				$sql_select = "SELECT*FROM fm_usuarios JOIN fm_perfil ON fm_perfil.per_codigo = fm_usuarios.usu_codigo_perfil WHERE usu_login = '$login' AND usu_ativo = 'SIM'";
				echo $sql_select;
				$stm = $conecta->prepare($sql_select);
				$stm->execute();
				$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
				if (count($retorno) > 0) {
					$_SESSION['usuarioId'] = $retorno[$i]['usu_codigo'];
					$_SESSION['usuarioAtivo'] = $retorno[$i]['usu_ativo'];
					$_SESSION['codPerfil'] = $retorno[$i]['usu_codigo_perfil'];
					$_SESSION['descPerfil'] = $retorno[$i]['per_descricao'];
					header("Location: index.php");
				} else {
					$_SESSION['loginErro'] = "Usuário inativo! ";
					header("Location: login.php");
				}
			}
		}
	} else {
		//Váriavel global recebendo a mensagem de erro
		$_SESSION['loginErro'] = "Usuário ou senha inválidos!";
		header("Location: login.php");
	}

	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
} else {
	$_SESSION['loginErro'] = "Digite o usuário e senha!";
	header("Location: login.php");
}
