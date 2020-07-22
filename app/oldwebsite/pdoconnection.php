<?php
class connection {

    var $conn, $servername, $username, $password, $dbname;

    function __construct($servername,$username,$password,$dbname) {

        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

    }

    function setConnection() {

        try {

            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #echo "Connected successfully";

        } catch(PDOException $e) {
            echo "Connection failed";
            die();
            return null;
        }
    }

    function getResult($sql) {
        $this->setConnection();

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        $conn = null;

        return $result;

    }

    function insertInto($tbl, $data) {

        $this->setConnection();

        $params = "";
        $vals = "";
        foreach ($data as $k => $a) {
            $a = $this->mres($a);
            $vals .= (is_numeric($a)) ? "$a," : "'$a',";
            $params .= "`$k`,";
        }
        $vals = substr($vals, 0, -1);
        $params = substr($params, 0, -1);

        $sql = "INSERT INTO $tbl ($params) VALUES ($vals);";
        $q = $this->conn->query($sql);

        $conn = null;
    }

    function query($sql) {

        $this->setConnection();

        $sql = $this->mres($sql);
        $q = $this->conn->query($sql);
        echo($sql);
        $conn = null;
    }

    function queryWithId($sql, $values) {

        $this->setConnection();

        $sql = $this->mres($sql);
        $this->conn->prepare($sql)->execute($values);
        $id = $this->conn->lastInsertId();
        $conn = null;
        return $id;
    }

    function mres($value) {
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $value);
    }

}
