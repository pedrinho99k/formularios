<?php
#Arquivos diretórios raízes
$PastaInterna = "Formularios";
define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$PastaInterna}");
if (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') {
    define('DIRREQ', "{$_SERVER['DOCUMENT_ROOT']}{$PastaInterna}");
} else {
    define('DIRREQ', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}");
}
#Dados Específicos
define('NOMESITE',"HR - Formulários");

#Diretórios Específicos
define('INDEX', $PastaInterna);
define('DIRIMG', DIRPAGE . "/img/");
define('DIRCSS', DIRPAGE . "/css/");
define('DIRJS', DIRPAGE . "/js/");
define('DIRBOOTSTRAP', DIRPAGE . "/bootstrap-5.1.3-dist/");

#Acesso ao Banco de Dados
define('HOST', "localhost");
define('DB', "formularios");
define('USER', "root");
define('PASS', "");

#Acesso ao LDAP
define('HOSTLDAP',"10.0.0.6");
define('PORTA',"389");
define('DOMAIN',"hrim.local");
define('PREF', "hrim\\");

