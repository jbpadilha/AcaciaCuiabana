<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: Connect.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 23/06/2008
//####################################
/*
   Classe para conexуo com banco de dados MySQL usando a extensуo MySQLi.
   A classe contщm o construtor de conexуo, registrando os possэveus erros de conexуo no arquivo db_errors.log,
   e o destrutor, para fechar a conexуo. As demais funчѕes de banco de dados sуo padrѕes da classe myslqi:
*/
class Connecta extends mysqli
{
    public function __construct()
    {
        try
        {
            //$con = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWD, DB_DATA);
            parent::__construct (DB_HOST, DB_USER, DB_PASSWD, DB_DATA);
            //return $con;
            if (mysqli_connect_errno() != 0)
                throw new Exception (mysqli_connect_errno() . " - " . mysqli_connect_error());
        }
        catch (Exception $db_error)
        {
            $mensagem = $db_error->getMessage();
            $arquivo = $db_error->getFile();
            $data = date ("Y-m-d H:i:s");
            $ip_visitante = $_SERVER['REMOTE_ADDR'];
            
            if (!file_exists (LOGS_PATH))
                mkdir (LOGS_PATH);
            
            // mensagem que serс salva no arquivo de logs do banco de dados
            $log = $data . " | " . $mensagem . " | " . $arquivo . " | " . $ip_visitante . "\r\n\r\n";
            error_log ($log, 3, LOGS_PATH . "db_errors.log");
            echo "Erro ao conectar ao banco de dados MySQL. O erro foi reportado e o administrador do sistema tomarс as devidas providъncias.";
            exit;
        }
    }
    
    public function __destruct()
    {
        if (mysqli_connect_errno() == 0)
            $this->close();
    }
    
}
?>