<?php

abstract class clsDatabase_MySql_Abstract
{
    protected $_queries = array();
    
    protected $_oLink;
    
    public $results;
    public $last_error;
    
    protected $_config;
    
    protected $_auto_connect = true;

    
    /**
    * The constructor for the DB class, notice that this is private because you cannot instantiate it
    * Instantiation is done with the getInstance() function, use that to get an instance of this class
    */
    protected function __construct($config)
    {         
        $this->_config = $config;
        
        if($this->_auto_connect)
        {
            $this->connect();                       
        }
    }
    
    public function __destruct() {
        if($this->_oLink)
            $this->close();
    }

    public abstract function connect();
    public abstract function query($sql);
    public abstract function QuickArray($sql);
    public abstract function escape($unescaped_string);
    public abstract function QuickCount($sql);
    public abstract function myArray($queryHandler);
    public abstract function NumRows($result);
    public abstract function getInsertID();
    public abstract function getAffectedRows();
    public abstract function close();
    public abstract function dataset($sql);
    
    /**
	* Get the maximum number of the field/column
	* @return the number
	*/
    function getMaxValue($field,$table,$where_cond_sql = '')
    {
        $sql = "SELECT max($field) as maxValue FROM ".$table."";
        if($where_cond_sql != '')
        {
            $sql .= " WHERE " . $where_cond_sql;
        }
        
        $row = $this->QuickArray($sql);

        return (int)$row['maxValue'];
    }
    
   function stripslashes_deep($value){
        $value = is_array($value) ?
                    array_map(array($this, __FUNCTION__), $value) :
                    stripslashes($value);

        return $value;
    }
    
    function getFoundRows() 
    { 
         $array =  $this->QuickArray(
           "SELECT FOUND_ROWS() as totRows"
        );
         return $array['totRows'];
       
    }//
    
    function getOne($sql) { 
        $r = $this->QuickArray($sql);
        return $r[0];
    }
    

} /*** end of class ***/  
?>
