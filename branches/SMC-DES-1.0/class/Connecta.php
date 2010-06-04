<?php
require_once ('Config.php');
/**
 * Classe para conexão com banco de dados MySQL usando a extensão MySQLi.
 * A classe contém o construtor de conexão, registrando os possíveus erros de conexão no arquivo db_errors.log,
 * e o destrutor, para fechar a conexão. As demais funções de banco de dados são padrões da classe myslqi:
 * @author João Batista Padilha e Silva
 * @link Connect.php
 * @copyright João Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / contato@joaopadilha.eti.br
 * @version 1.0
 */
class Connecta extends mysqli
{
    /**
     * Método Construtor da conexão.
     * @author João Batista Padilha e Silva
     * @param DB_HOST, DB_USER, DB_PASSWD, DB_DATA
     */
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
            
            //if (!file_exists (LOGS_PATH))
             //   mkdir (LOGS_PATH);
            
            // mensagem que será salva no arquivo de logs do banco de dados
            $log = $data . " | " . $mensagem . " | " . $arquivo . " | " . $ip_visitante . "\r\n\r\n";
            error_log ($log, 3, LOGS_PATH . "db_errors.log");
            echo "Erro ao conectar ao banco de dados MySQL. O erro foi reportado e o administrador do sistema tomará as devidas providências.";
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