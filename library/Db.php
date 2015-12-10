<?php
class Db{
    //member variables
    private static $_con = null,
            $_driver = "sqlsrv",
            $_host = "localhost",
            $_user = "arsan",
            $_pass = "a1254n",
            $_db = "APDPLN",
            $_error = false;

    //established connection to the database
    private function setConnection(){
        try{
            self::$_con = new PDO(self::$_driver.":Server=".self::$_host.";database=".self::$_db,self::$_user,self::$_pass);
            //self::$_con = new PDO("mysql:host=".self::$_host.";dbname=".self::$_db,self::$_user,self::$_pass);
            // set the PDO error mode to exception
            self::$_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            die("PDOException {$e}");
        }
    }

    /*
     * Return the connection variable if connection is established
     * else
     * make a new connection then return the connection variable
     * */
    public static function getConnection(){
        //established connection
        if(self::$_con == null){
            self::setConnection();
        }

        return self::$_con;
    }

    //unset connection
    public static function unsetConnection(){
        self::$_con = null;
    }

    //set error
    private function setError($value = true){
        self::$_error = $value;
    }

    //get error
    public static function getError(){
        return self::$_error;
    }

    //query method with bind functionality
    private static function query($sql,$bindPrams = array()){
        //get connection
        $con = self::getConnection();
        //set error to false
        self::setError(false); //no error

        //check sql is not empty
        if(empty($sql))
            die("Invalid Sql Query");

        $stmt = $con->prepare($sql);

        //bind params
        $i = 1;
        foreach($bindPrams as $params){
            $stmt->bindValue($i,$params);
            $i++;
        }


        //set the error
        if($stmt->execute() == true)
            self::setError(false);
        else
            self::setError(true);

        return $stmt; //return PDO statement
    }

    //insert method
    public static function insert($tableName,$value = array()){
        //make KEYS && Values to bind
        $valueKey = array_keys($value); //get keys of $value
        $keyString = "";
        $bindString = "";
        $i = 1;
        foreach($valueKey as $key){
            $keyString .= "`".$key."`";
            $bindString .= "?";
            //if we are not on the last element
            if($i < count($valueKey)){
                $keyString .= ", ";
                $bindString .= ",";
            }

            $i++;
        }

        //execulte the query
        self::query("INSERT INTO `{$tableName}` ({$keyString}) VALUES({$bindString})",array_values($value));

        return self::getError(); //return the error bolean value set the query method
    }

    //update method
    public static function update($tableName,$update = array(),$where = array()){

        $updateKeys = array_keys($update);
        $updateString = "";
        $i = 1;
        foreach($updateKeys as $updateKey){
            $updateString .= $updateKey." = ?";
            //check if we are not on the last element of the array
            if($i < count($updateKeys)){
                $updateString .= " , ";
            }

            $i++;
        }

        //generate where clause
        if(count($where) < 3){
            die("Invalid Where clause");
        }

        $whereString = "";
        foreach($where as $whr) {
            $whereString .= $whr;
        }
        self::query("UPDATE `{$tableName}` SET {$updateString} WHERE {$whereString}",array_values($update));

        return self::getError();
    }

    //delete method
    public static function delete($tableName,$whereArray = array()){
        //check table name
        if(empty($tableName))
            die("Empty Table name");

        if(count($whereArray) < 3)
            die("Invalid where clause");

        //generate where clause
        $whereString = "";
        foreach($whereArray as $where){
            $whereString .= $where;
        }

        self::query("DELETE FROM {$tableName} WHERE {$whereString}",array());

        return self::getError();
    }

    //fetch method
    public static function fetch($tableName,$whereArray = array(),$operator){
        if(empty($tableName))
            die("Enter table name");

        if( ($whereArray=="") && ($operator=="") ) {
            $stmt = self::query("SELECT * FROM {$tableName}");
        }
        else {
            //check operator is valid
            $validOperator = array("=", "!=", ">", "<", ">=", "<=");

            if (!in_array($operator, $validOperator))
                die("Invalid Operator");

            if (count($whereArray) != 1)
                die("Invalid Where Array");

            //generate where string
            $whereString = "";
            foreach (array_keys($whereArray) as $where) {
                $whereString .= $where;
            }

            $whereString .= $operator . "?";

            echo $whereString;
            exit;
            //execute the query

            $stmt = self::query("SELECT * FROM {$tableName} WHERE {$whereString}", array_values($whereArray));
        }

        if(self::getError() == false){ //no error
            return $stmt->fetch(PDO::FETCH_NUM);
        }else{
            return self::getError(); //return true (means their is a error)
        }
    }
}