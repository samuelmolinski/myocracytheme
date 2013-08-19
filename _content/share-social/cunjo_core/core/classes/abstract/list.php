<?PHP
abstract class absList
{
    private $_ignore_keys = array('section','control','action','slug','code','submit');

    protected $_filter_string = '';

    /*
     $array = array(
            "where" => array(),
            "order_by" => array("field","","direction"=>""),
            "limit" => 1
         );
    */
    protected $_filter_data = array();
    
    public function __construct($_filter_data = array())
    {
        $this->setData($_filter_data);
    }
    
    public function setIgnoredKey($keys)
    {
        if(is_array($keys) == false)
            $keys = explode(',',$keys);  
        else
            $keys = (array)($keys);
        
        foreach($keys as $key=>$k)
            $this->_ignore_keys[] = $k;
    }
    
    public function setData($data)
    {
        $this->_filter_data = $data;  
        
        $ignore_saniti_on = array('where_condition');
  
        foreach($this->_filter_data as $k => $v)
        {
            if(in_array($k, $ignore_saniti_on))
                    continue;
            
            if(strstr($k, '_id'))
            {
                if(is_array($v) && count($v) > 0)
                {
                    $this->_filter_data[$k] = array_filter($v, 'intval');
                }
                else
                {
                    $this->_filter_data[$k] = intval($v);
                }
            }
            else if(is_numeric($v) == false)
            {
                $this->_filter_data[$k] = clsSanitize::escape($v);
            }
        }
        
        return $this;
    }
    
    public function addData($key,$value)
    {
        $this->_filter_data[$key] = $value; 
        
        return $this;
    }

    public function getList($_array=array())
    {
        return $this->getSQL() . $this->getFilteredSQL($_array);
    }
    
    abstract protected function getSQL();

    function getFilter($filter_data=null,$ignore_keys=array())
    {
        $_filter_data = $this->_filter_data;
        if($filter_data != null && is_array($filter_data) && count($filter_data))
        {
            $_filter_data = $filter_data;
        }
        

        if(is_array($ignore_keys))
        {
            foreach($ignore_keys as $index=>$key)
            {
                  unset($_filter_data[$key]);
            }
        }

        if(is_array($_filter_data))  
        {
            $this->_filter_string = $this->getFilterQS($_filter_data);
        }
        

        return $this->_filter_string;
    }
    
    private function getFilterQS($filter_data)
    {
        $filter_string = '';
        if(is_array($filter_data))  
        {
            foreach($filter_data as $key=>$value)
            {
                if(is_array($value))
                {
                    
                   foreach($value as $k=>$_nested_value)
                   {
                        $filter_string .= "".$key."[]=" . $_nested_value."&"; 
                   }
                }
                else if(!in_array($key,$this->_ignore_keys))
                {
                    $filter_string .= "".$key . "=" . $value."&"; 
                }
                
            }
            
            $filter_string = rtrim($filter_string,'&');
        }
        
        return $filter_string; 
    }
    
     protected function getFilteredSQL($array = array())
     {
          
         $data = array_merge($this->_filter_data,$array);
         
         $sql = "";
         if(is_array($data))
         {
             if(count($data) == 0)
                return $sql;
             
             if(isset($data['where']))
             {
                 $where = (array)$data['where'];
                 foreach($where as $key=>$value)
                 {
                     $sql .= " AND ".$key." = ".$value."";
                 }
             }
             
             $order_by = (array)$data['order_by'];
             if($order_by['field'])
             {
                  $sql .= " order by ".$order_by['field']." ";
                  if(clsFilterSQL::ValidDirection($order_by['direction']))
                  {
                      $sql .= " ".$order_by['direction']."";
                  }
             }
             $limit = $data['limit'];
             
             if($limit != null)
             {
                 $sql .= " LIMIT ".$limit."";
             }
         }
         
         return $sql;
         
     }
     
     function dataset($sql='',$limit = 0)
     {
         if($sql == '')
         {
             $sql = $this->getSQL();
         }

         if($limit > 0)
         {
             if(strstr($sql,'LIMIT')){
                 $sqlSplit = explode('LIMIT',$sql);
                 $sql = $sqlSplit[0];
             }
             $sql .= " LIMIT ".$limit."";
         }
         
         
  
 
         return clsDatabase::factory()->dataset($sql);
     }
     
     
     function getCount($sql='')
     {   
         if($sql == '')
         {
             $sql = $this->getSQL();
         }
         
         return clsDatabase::factory()->QuickCount($sql);
     }
     
     public function getRowsCount()
     {
         $array =  clsDatabase::factory()->QuickArray(
           "SELECT FOUND_ROWS() as totRows"
        );
         
         return $array['totRows'];
     }
}
?>