<?PHP   
class clsSQL_Sort
{
    static function getDragDropQuery($orderString,$tableName,$primaryKey='id',$columnName="sort_order",$separator=':'){
        $orderArray = explode($separator, $orderString);
   

        $sql="update $tableName set $columnName= case ";
        foreach ($orderArray as $key => $value){
            if(strlen($value)>0){
				if(is_numeric($value)){
           		 	$sql.="when $primaryKey = $value then $key ";
				}
			}
        }
        $sql.="end where $primaryKey in ( ";
        
        $firstTime=true;
        foreach ($orderArray as $key => $value){
            if(!$firstTime && strlen($value)>0 && is_numeric($value))
                $sql.=", ";
            if(is_numeric($value)){
            $sql.="$value";
            $firstTime=false;
			}
        }
        
        $sql.=" )";
        
        return $sql;
    }
    
}
?>