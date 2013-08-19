<?php 
abstract class absModel 
{
    protected $_primary_key = '';
    protected $_table = '';
    protected $_entity = 'Record';
    protected $_message = '';
    
    // Database instance
    protected $_db = null;

    /**
     * Loads the database.
     *
     *     $model = new modFoo($db);
     *
     * @param   mixed  Database instance object or string
     * @return  void
     */
    public function __construct()
    {
        $this->_db = clsDatabase::factory();
    }

    public function escape($data)
    {
        return $this->_db->escape($data);
    }
    
    protected $_inserted_data = array();
    
    public function getInsertData()
    {
        return $this->_inserted_data;
    }
    
    /**
    * Prepare and Run INSERT Query
    * @param array $insert_data | array('id' => 1 , 'dummy_column' => 'Sample Value')
    */
    protected function create(array $insert_data, $table = null,  $pk_column = null)
    {
        $pk_column = $this->getPrimaryKey($pk_column);
        
        $this->_inserted_data = $insert_data;
 
        unset($this->_inserted_data[$pk_column]);
        
        $sql = 'INSERT INTO '.$this->getTable($table).' SET ';
        foreach($this->_inserted_data as $key => $value)
        {
            $sql .= ''.$key.' = "'.$value.'",';
        }
        $sql = rtrim($sql, ',');

  
        $this->_db->query($sql);
        
        $id = $this->_db->getInsertID();
        
        $this->_inserted_data[$pk_column] = $id;
        
        if($id > 0)
        {
            $this->_message = $this->_entity . ' has been added successfully.';
        }
        else
        {
            $this->_message = $this->_entity . " couldn't be added.";
        }

        return $id;
    }
    
    /**
     *
     * @return bool 
     */
    public function isInserted()
    {
        return ($this->_inserted_data[$this->_primary_key] > 0);
    }
    
    /**
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->_message;
    }
    
    public function Save(array $data, $table = '', $pk_column= '')
    {
        $pk_column = $this->getPrimaryKey($pk_column);
        
        if($data[$pk_column] > 0)
        {
            return $this->update($data, $table, $pk_column);
        }
        else
        {
            return $this->create($data, $table, $pk_column);
        }
    }
    
    
    /**
    * Prepare and Run UPDATE Query
    * @param array $update_data 
    */
    private $_rows_affected = 0;
    
    public function getRowsAffected()
    {
        return $this->_rows_affected;
    }
    
    protected function update(array $update_data, $table = null,  $pk_column = null)
    {
        $pk_column = $this->getPrimaryKey($pk_column);
       
        if(!isset($update_data[$pk_column]))
        {
            throw new expModel("Update query cant be run without primary key (".$pk_column.") condition. Primary key needed");
        }
        
        $sql = 'UPDATE '.$this->getTable($table).' SET ';
        foreach($update_data as $key => $value)
        {
            if($key != $pk_column)
            {
                $sql .= ''.$key.' = "'.$value.'",';
            }
        }
        $sql = rtrim($sql, ',');
        
        
        if(is_array($update_data[$pk_column]) && count($update_data[$pk_column]) > 0)
        {
            $sql .= " WHERE ".$this->getPrimaryKey($pk_column)." IN (".implode(',',(array)$update_data[$pk_column]).")";
        }
        else
        {
            $sql .= " WHERE ".$this->getPrimaryKey($pk_column)." = '".$update_data[$pk_column]."'";
        }

        $res = $this->_db->query($sql);
 
        if($res > 0)
        {
            $this->_rows_affected = $this->_db->getAffectedRows();
            $this->_message = $this->_entity . ' has been updated successfully.';
            return $update_data[$pk_column];
        }
        else
        {
            $this->_message = $this->_entity . " couldn't be updated.";
            return false;
        }
    }
    
    /**
     *
     * @param int | array (mixed) $id
     * @param type $table
     * @param type $pk_column
     * @return type 
     */
    public function delete($id, $pk_column = null, $table = null)
    {    
        $where_str = '';
        
        if(is_array($id))
        {
            if(count($id) == 0)
                return false;
            
            $where_str = " " . $this->getPrimaryKey($pk_column) . " IN (".implode(',',$id).")";
        }
        else
        {
            if($id == 0)
                return false;
            
            $where_str = "" . $this->getPrimaryKey($pk_column) . " = '".(int)$id."'";
        }
        
        $sql = 'DELETE FROM ' . $this->getTable($table)  . ' WHERE ' . $where_str;
        
        return $this->_db->query($sql);
    }
    
    function deleteByFKId($fk_id,$fk_value)
    {
       return $this->_db->query("DELETE FROM  ".$this->_table." WHERE ".$fk_id." = '".clsSanitize::escape($fk_value)."' ");
    }
    
    public function getTable($table = null)
    {
        if($table == '')
        {
            $table = $this->_table;
        }
          
        if($table == '')
        {
            throw new expModel("Table name needed to execute delete query");
        }
        
        return $table;
    }
    
    public function getPrimaryKey($pk_column = null)
    {
        if($pk_column == '')
        {
            $pk_column = $this->_primary_key;
        }
          
        if($pk_column == '')
        {
            throw new expModel("Primary Key needed to execute query");
        }
        
        return $pk_column;
    }
    
    public function isValid($value, $pk_column = null, $table = null)
    {       
        $sql = "SELECT count(*) as totalCnt FROM ".$this->getTable($table)." WHERE ".$this->getPrimaryKey($pk_column)." = '" . $value ."' ";
        $array = $this->_db->QuickArray($sql);
        return ( $array['totalCnt'] > 0 );
    }
    
    protected $_data_cache = null;
 
    /**
     *
     * @param Array | mixed $value
     * @param type $pk_column
     * @param type $table
     * @return Array 
     */
    public function Data($value, $pk_column = null, $table = null,$column = '*')
    {    
        $table = $this->getTable($table);
        $pk = $this->getPrimaryKey($pk_column);
        
        if($column == '' || $column == null)
        {
            $column = '*';
        }
        
        $key = md5($pk.'-'.$table.'-'.$value.'-'.$column);
        
        if(isset($this->_data_cache[$key]))
        {
            return $this->_data_cache[$key];
        }
        
        $_value = $value;
        if(is_array($value))
        {
            $_value = $value[$pk];
        }
        
        
        $sql = "SELECT ".$column." FROM " . $table . " WHERE " . $this->getPrimaryKey($pk_column) . " = '".$_value."' LIMIT 1";
  
        $this->_data_cache[$key] = $this->_db->QuickArray($sql);
 
        return $this->_data_cache[$key];
    }
    
    /**
     *
     * @param Array | mixed $value
     * @param type $pk_column
     * @param type $table
     * @return Array 
     */
    public function getOne($column,$value, $pk_column = null, $table = null,$column = '*')
    {
        $r = $this->Data($value, $pk_column, $table,$column);
  
        return isset($r[$column]) ? $r[$column] : null;
    }
    
     
    /**
     *
     * @param String | SQL Query
     * @return Array 
     */
    
    public function Dataset($sql = '')
    {
        $dataset = array('data' => array());
        $count = 0;
        
        if($sql == '')
        {
           $sql = "SELECT * FROM " . $this->getTable() . "";
        }


        $rows = $this->_db->dataset($sql);
        foreach($rows as $k => $row)
        {
            $dataset['data'][] = $row;
            $count++;
        }
        
        $dataset['count'] = $count;
        
        return $dataset;
    }
    
    public function getValues(array $id_collection,$where_condition = '')
    {
        return $this->getSingleValues('*', $id_collection,$where_condition);
    }
    
    public function getSingleValues($output_column, array $id_collection,$where_condition = '')
    {
        $values = array();
        
        if(count($id_collection) > 0)
        {
            $sql = "SELECT ".$output_column.", ".$this->_primary_key." FROM ".$this->_table." ";
            $sql .= " WHERE ".$this->_primary_key." IN (".implode(',',$id_collection).")";
            
            if($where_condition != '')
            {
                $sql .= " AND " . $where_condition;
            }
            
     
            $dataset = $this->_db->dataset($sql);
        
            foreach($dataset as $k => $r)
            {
                if($output_column == '*')
                {
                    $values[$r[$this->_primary_key]] = $r;
                }
                else
                {
                    $values[$r[$this->_primary_key]] = $r[$output_column];
                }
            }
        }
        
        return $values;
    }
    
    public function getKeys($output_key, $pk, $id_collection,$table = '',$where_condition = '')
    {
        $values = array();
        
        if($table == '')
            $table = $this->_table;

        $sql = "SELECT ".$output_key." FROM ".$table." ";

        if(is_array($id_collection) && count($id_collection) > 0)
        {
            $sql .= ' WHERE '.$pk.' IN ("' . implode('", "', $id_collection) . '")';
        }
        else
        {
           $sql .= " WHERE ".$pk." = '".(int)$id_collection."'";
        }

        if($where_condition != '')
        {
            $sql .= " AND " . $where_condition;
        }
        
        $dataset = $this->_db->dataset($sql);
        
        $values = array();
        
        foreach($dataset as $k => $r)
        {
            if($output_key == '*')
            {
                $values[] = $r;
            }
            else
            {
                $values[] = $r[$output_key];
            }
        }

        return $values;
    }
    
    
    private $_error = '';
    public function setError($error)
    {
        $this->_error = $error;
        
        return $this;
    }
    
    public function getError()
    {
        return $this->_error;
    }
    
    
} // End Model
