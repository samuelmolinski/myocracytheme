<?PHP
class clsSql_Filter 
{   
   public static function compare($column,$op)
   {
        return " DATE(".$column.") ".$op." DATE(NOW()) ";  
   }
   
   public static function today($column)
   {
        return " DATE(".$column.") = DATE(NOW()) ";  
   }   
   
   public static function yesterday($column)
   {
        return " DATE(".$column.") = DATE_SUB( DATE(NOW()) , INTERVAL 1 DAY)  ";  
   }   
   
   public static function week($column)
   {
        return " WEEK(".$column.") = WEEK(NOW()) ";  
   }   
   
   public static function month($column)
   {
        return " MONTH(".$column.") = MONTH(NOW()) ";  
   }
   
   public static function year($column)
   {
        return " YEAR(".$column.") = YEAR(NOW()) ";  
   }

}//class ends