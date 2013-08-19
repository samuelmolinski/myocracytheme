<?php
/**
 * MySQLi (i for imporved :)) Database Handler
 */
class clsDatabase_MySqli extends clsDatabase_MySql_Abstract
{
    /*** Declare instance ***/
    private static $instance = null;
    
    protected $_auto_connect = false;
    
    /**
    * Get instance returns the currently instantiated object of this DB class.  
    * This forces only one connection to the MySQL server
    * @return DB object
    */
    public static function Instance($config = null)
    {
        $hash = md5('master');
        
        if(isset ($config))
        {
            if(is_array($config) == false)
            {
                $config['host'] = DB_HOST;
                $config['user'] = DB_USER;
                $config['password'] = DB_PASSWORD;
                $config['db'] = DB_NAME;
                
                $hash = md5(implode('-', $config));
            }
        }
        
        if(self::$instance[$hash] == null) 
        {
            self::$instance[$hash] = new clsDatabase_MySqli($config);
            self::$instance[$hash]->connect();
        }
        
        return self::$instance[$hash]; 
    }
    
    
    private function __clone(){
        //enforce singleton
    }
        
    public function connect()
    {
        $this->_oLink = mysqli_connect($this->_config['host'], $this->_config['user'], $this->_config['password'], $this->_config['db']);

        if ($this->_oLink == false) {
            throw new expSQL_Connect("Failed to connect to MySQL: (" . mysqli_connect_errno() . ") ");
        }
        
        $this->query("SET CHARACTER SET UTF8");
        $this->query("SET NAMES 'UTF8'");
          
    }
    
    public function escape($unescaped_string)
    {
        if(is_object($this->_oLink) == false)
                return $unescaped_string;
        
        if(is_string($unescaped_string))
        {
            return $this->_oLink->real_escape_string($unescaped_string);
        }
        else if(is_array($unescaped_string))
        {
            foreach($unescaped_string as $k => $v)
            {
                if(is_string($v))
                {
                    $unescaped_string[$k] = $this->_oLink->real_escape_string($v);
                }
                else if(is_array($v))
                {
                    foreach($v as $i => $value)
                    {
                        $v[$i] =  $this->_oLink->real_escape_string($value);
                    }
                    
                    $unescaped_string[$k] = $v;
                }
            }
            
            return $unescaped_string;
        }
        
        return $unescaped_string;
    }


    private $_oLastQ = null;
    
    function query($sql)
    {
        $this->_queries[] = $sql;
         
        if(is_object($this->_oLink))
        {
            $this->_oLastQ = $this->_oLink->query($sql);

            if(!$this->_oLastQ){                                
                $this->last_error = $this->_oLink->error;
                throw new expSQL($this->last_error . ' - ' . $sql) ;    
            }
            return $this->_oLastQ;
        }
        else
        {
            throw new expSQL('MysqlI Object not instantiated - ' . $sql) ;
        }
    }
    
    /**
    * 
    * @returns the QuickArray    
    */
    function QuickArray($sql) { 
        return $this->myArray($this->query($sql)); 
    }
    
    
    /**
    * 
    * @returns the QuickCount    
    */
    function QuickCount($sql) { 
       return $this->NumRows($this->query($sql)); 
    }//
    

    /**
    * 
    * @returns the ARRAY    
    */
    function myArray($result) { 
        return  $result->fetch_array(MYSQLI_BOTH);
    }//
    

    /**
    * 
    * @returns the ARRAY    
    */
    function myObject($result) { 
        return $result->fetch_object();
    }//  fetchArray() ends
    
    
    /**
    * Get the number of rows count
    * @return the number of rows    
    */
    function NumRows($result){
        return $result->num_rows; 
    }

    /**
    * GET LAST Insert ID
    */
    function getInsertID(){
        return $this->_oLink->insert_id;
    }
    

    function getAffectedRows(){
        return $this->_oLink->affected_rows;
    }

    public function close(){
        $this->_oLink->close();
    }
    
    function dataset($sql){
        $q = $this->query($sql);
        
        $dataset = array();
        while($r = $this->myArray($q)){
            $dataset[] = $r;
        }
        return $dataset;
    }
    
 
} /*** end of class ***/  
?>
