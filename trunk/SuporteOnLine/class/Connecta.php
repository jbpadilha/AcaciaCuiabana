<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Connect.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 23/06/2008
//####################################
/*
   Classe para conex�o com banco de dados MySQL usando a extens�o MySQLi.
   A classe cont�m o construtor de conex�o, registrando os poss�veus erros de conex�o no arquivo db_errors.log,
   e o destrutor, para fechar a conex�o. As demais fun��es de banco de dados s�o padr�es da classe myslqi:
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
            
            // mensagem que ser� salva no arquivo de logs do banco de dados
            $log = $data . " | " . $mensagem . " | " . $arquivo . " | " . $ip_visitante . "\r\n\r\n";
            error_log ($log, 3, LOGS_PATH . "db_errors.log");
            echo "Erro ao conectar ao banco de dados MySQL. O erro foi reportado e o administrador do sistema tomar� as devidas provid�ncias.";
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