<?

$inserir=isset($_POST['inserir'])?$_POST['inserir']:"";

if($inserir=="true"){

	DEFINE('DB_HOST',$_POST['host']);
	DEFINE('DB_USER',$_POST['user']);
	DEFINE('DB_PASS',$_POST['pass']);
	DEFINE('DB_TABLE',$_POST['table']);


    class Conexao extends PDO {
     
        private static $instancia;
     
        public function Conexao($dsn, $username = "", $password = "") {
            // O construtro abaixo é o do PDO
            parent::__construct($dsn, $username, $password);
        }
     
        public static function getInstance() {
            if(!isset( self::$instancia )){
                try {
                    self::$instancia = new Conexao("mysql:host=".DB_HOST.";dbname=".DB_TABLE, DB_USER , DB_PASS, array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true )); echo 'Consegui conectar';

                } catch ( Exception $e ) {
                    echo 'Erro ao conectar';
                    exit ();
                }
            }
            return self::$instancia;
        }
    }

    $DB = Conexao::getInstance();
    $a = $DB->query("SET NAMES utf8;SET character_set_connection=utf8;SET character_set_client=utf8;SET character_set_results=utf8;SET time_zone='-3:00';");
    $a->closeCursor();

    date_default_timezone_set('America/Sao_paulo');
    setlocale(LC_ALL, "pt_BR");

}

?>


<form method="post" action="">
    HOST:<input type="text" name="host"><BR>
    USER:<input type="text" name="user"><BR>
    PASS:<input type="text" name="pass"><BR>
    TABLE:<input type="text" name="table"><BR>
    <input type="hidden" name="inserir" value="true">
    <input type="submit">
</form>