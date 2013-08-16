<?PHP
class clsDatabase
{
    private static $_driver = 'WpDB';
    
    public static function factory()
    {
         return clsDatabase_WpDB::Instance();
    }
}
?>