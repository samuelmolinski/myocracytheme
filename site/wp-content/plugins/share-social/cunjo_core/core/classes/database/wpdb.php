<?php
/**
 * WordPress Fuel - WordPress DB Wrapper for Quick CRUD and other stuff
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
class clsDatabase_WpDB
{
    /*** Declare instance ***/
    private static $instance = null;

    /**
    * Get instance returns the currently instantiated object of this DB class.  
    * This forces only one connection to the MySQL server
    * @return DB object
    */
    public static function Instance()
    {
        if(self::$instance == null) 
        {
            self::$instance = new clsDatabase_WpDB($config);
            self::$instance->connect();
        }
        
        return self::$instance; 
    }
    
    
    private function __clone(){
        //enforce singleton
    }
        
    public function connect()
    {
        global $wpdb;

        $this->_oLink = $wpdb;  
    }
    
    public function escape($unescaped_string)
    {
        return $this->_oLink->_escape($unescaped_string);
    }


    private $_oLastQ = null;
    
    function query($sql)
    {
        $this->_queries[] = $sql;
         
        if(is_object($this->_oLink))
        {
            $this->_oLastQ = $this->_oLink->query($sql);

            if(!$this->_oLastQ && $this->_oLink->last_error != ''){     
                $this->last_error = $this->_oLink->last_error;
                throw new expSQL($this->last_error . ' - ' . $sql) ;    
            }
            return $this->_oLastQ;
        }
        else
        {
            throw new expSQL('WPDB Object not instantiated - ' . $sql) ;
        }
    }
    
    /**
    * 
    * @returns the QuickArray    
    */
    function QuickArray($sql) { 
        return $this->_oLink->get_row($sql,ARRAY_A); 
    }
    

    function getFoundRows() 
    { 
         $array =  $this->QuickArray(
           "SELECT FOUND_ROWS() as totRows"
        );
         return $array['totRows'];
       
    }//
    
    
    /**
    * Get the number of rows count
    * @return the number of rows    
    */
    function NumRows(){
        return $this->_oLink->num_rows; 
    }

    /**
    * GET LAST Insert ID
    */
    function getInsertID(){
        return $this->_oLink->insert_id;
    }
    

    function getAffectedRows(){
        return $this->_oLink->rows_affected;
    }

    public function close(){
       
    }
    
    function dataset($sql){
        return $this->_oLink->get_results($sql,ARRAY_A);
    }
    
 
} /*** end of class ***/  
?>
