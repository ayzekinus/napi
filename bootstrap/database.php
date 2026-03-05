<?php

/*
 * @name	mubu - a simple php framework
 *
 * @author	izni burak demirtas <izniburak@gmail.com>
 * 			murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class Database {

    private static $instance;
    private $conn = null;
    private $db_host = null;
    private $db_user = null;
    private $db_pass = null;
    private $db_name = null;
    private $db_type = null;
    private $charset = null;
    private $prefix = null;
    private $db_dsn = null;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (empty(self::$instance))
            self::$instance = new Database();
        return self::$instance;
    }

    public function connect() {
        global $config;

        $this->db_name = $config['database']['db_name'];
        $this->db_host = $config['database']['db_host'];
        $this->db_user = $config['database']['db_user'];
        $this->db_pass = $config['database']['db_pass'];
        $this->db_type = $config['database']['db_type'];
        $this->charset = $config['database']['charset'];
        $this->prefix = $config['database']['prefix'];

        if ($this->db_type == '' || $this->db_type == 'mysql' || $this->db_type == 'pgsql')
            $this->db_dsn = $this->db_type . ':host=' . $this->db_host . ';dbname=' . $this->db_name;

        elseif ($this->db_type == 'sqlite') {
            $dbfolder = '';
            if ($this->db_name != ':memory:') {
                $dbfolder = ROOT . '/storage/database/';
                if (!file_exists($dbfolder . $this->db_name))
                    touch($dbfolder . $this->db_name);
            }
            $this->db_dsn = $this->db_type . ':' . $dbfolder . $this->db_name;
        }

        try {
            $this->conn = new PDO($this->db_dsn, $this->db_user, $this->db_pass);
            $this->conn->exec("SET NAMES '" . $this->charset . "'");
            $this->conn->exec("SET CHARACTER SET '" . $this->charset . "'");            
            return $this->conn;
        } catch (PDOException $e) {
            die($this->error('Can not connect to database with PDO.<br /><br />' . $e->getMessage()));
        }
    }

    public function getPrefix() {
        return $this->prefix;
    }

    private function error($error) {
        $msg = '<h1>Database Error</h1>';
        $msg .= '<h4>Error: <em style="font-weight:normal;">' . $error . '</em></h4>';
        die($msg);
    }

    function __destruct() {
        if ($this->conn)
            $this->conn = null;
    }

}
