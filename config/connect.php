<?php
/*
try {
    $hostname = "localhost";
    $port = 1433;
    $dbname = "APDPLN" ;
    $username = "arsan" ;
    $pw = "a1254n";
    $conn = new PDO ("sqlsrv:Server=$hostname;database=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }

/*   echo "Selamat connectmi";
  echo ""; */

//include('../library/dbConnection.php');

class dbConnection extends PDO {

    /**
     * @param $dbSettings
     */
    function __construct($dbSettings){
        try {
            parent::__construct($dbSettings['dbtype'].':Server='.$dbSettings['hostname'].';database='.$dbSettings['dbname'],$dbSettings['username'],$dbSettings['password']);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die('ERROR: '. $e->getMessage());
        }
    }

    /**
     * Function to return table columns count
     * @param $table
     * @return int
     */
    function numCols($table)
    {
        $query = "SELECT * from ". $table;
        $cResult = parent::prepare($query);
        $cResult->execute();
        return $cResult->columnCount();
    }

    /**
     * * Function to return table rows count
     * @param $table
     * @return int
     */
    function numRows($table)
    {
        $query = "SELECT * from ". $table;
        $rResult = parent::query($query)->fetchAll();
        return count($rResult);
    }

    function getFieldList($table){
        return $query = parent::prepare("SELECT COLUMN_NAME 'All_Columns' FROM INFORMATION_SCHEMA.COLUMNS
                        WHERE TABLE_NAME='".$table."'");
    }

    /**
     * @param $table
     * @param $array
     * @return bool
     */
    function insertArray($table, $array) {
        $fields=array_keys($array);
        $values=array_values($array);
        $fieldlist=implode(',', $fields);
        //$valuelist=implode(',', $values);
        $qs=str_repeat("?,",count( $fields ) - 1);

        $sql="INSERT INTO ".$table." (".$fieldlist.") VALUES (${qs}?)";

        $q = parent::prepare($sql);
        return $q->execute($values);
    }

    /**
     * @param $table
     * @param $field_id
     * @param $value_id
     * @param $array
     * @return bool
     */
    function updateArray($table, $field_id, $value_id, $array) {
        $fields=array_keys($array);
        $values=array_values($array);
        $fieldlist = implode(',', $fields);
        $qs=str_repeat("?,",count($fields)-1);
        $firstfield = true;

        $sql = "UPDATE ".$table." SET";
        for ($i = 0; $i < count($fields); $i++) {
            if(!$firstfield) {
                $sql .= ", ";
            }
            $sql .= " " . $fields[$i] . "=?";//'".$values[$i]."'";
            $firstfield = false;
        }
        $sql .= " WHERE ". $field_id. "=?";

        $sth = parent::prepare($sql);
        $values[] = $value_id;
        return $sth->execute($values);
    }

    /**
     * @param $var
     * @param $query
     * @param $value
     * @param $label
     * @param string $default
     * @param string $class
     * @param string $mode
     */
    function cboFillFromTable($var,$query,$value,$label,$default="--Choose--",$class="",$mode="addnew")
    {
        $sqlQuery = parent::prepare($query);
        $sqlQuery->execute();
        echo "<select name='$var' id='$var' class='$class' required>";
        if($mode=="addnew"){
            echo "<option value='' selected>$default</option>";
            while($arr = $sqlQuery->fetch())
            {
                echo "<option value='$arr[$value]'>$arr[$label]</option>";
            }
        }
        elseif($mode=="edit"){
            while($arr = $sqlQuery->fetch()){
                if ($arr[$value] == $default)
                    echo "<option value='$arr[$value]' selected>$arr[$label]</option>";
                else
                    echo "<option value='$arr[$value]'>$arr[$label]</option>";
            }
        }
        echo "</select> ";
    }

    /**
     * @param $orderField
     * @param $table
     * @param $page
     * @param $offset
     * @return PDOStatement
     */
    function queryPaging($orderField, $table, $page, $offset){
        return parent::prepare("SELECT  * FROM(
                                  SELECT ROW_NUMBER() OVER(ORDER BY $orderField) AS NUMBER, * FROM $table) AS TBL
                                    WHERE NUMBER BETWEEN (($page- 1) * $offset + 1) AND ($page * $offset)
                                    ORDER BY $orderField");
    }

}


try{
    $dbSettings['dbtype']   = 'sqlsrv';
    $dbSettings['hostname'] = 'localhost';
    $dbSettings['dbname']   = 'APDPLN';
    $dbSettings['username'] = 'arsan';
    $dbSettings['password'] = 'a1254n';

    $conn = new dbConnection( $dbSettings );
}catch (PDOException $e){
    echo "Failed to get DB handle : " . $e->getMessage() . "\n";
    exit;
}


?>