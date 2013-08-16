<?PHP
class clsLog_Writer_File extends clsLog_Writer_Abstract
{
    
    // Directory to place log files in
    protected $_directory;

    /**
     * Creates a new file logger. Checks that the directory exists and
     * is writable.
     *
     *     $writer = new iceLogFile($config);
     *
     * @param   string  log directory
     * @return  void
     */
    public function _postConstruct()
    {
        // Determine the directory path
        $this->_directory = realpath($this->_config['directory']).DIRECTORY_SEPARATOR;
    }

    /**
     * Writes each of the messages into the log file. The log file will be
     * appended to the `YYYY/MM/DD.log.php` file, where YYYY is the current
     * year, MM is the current month, and DD is the current day.
     *
     *     $writer->write($messages);
     *
     * @param   array   messages
     * @return  void
     */
    public function write(array $messages)
    {
        if ( ! is_dir($this->_config['directory']) OR ! is_writable($this->_config['directory']))
        {
            return; //Log Directory must be writable
        }
        
        // Set the yearly directory name
        $directory = $this->_directory.date('Y').DIRECTORY_SEPARATOR;

        if ( ! is_dir($directory))
        {
            // Create the yearly directory
            mkdir($directory, 0777);

            // Set permissions (must be manually set to fix umask issues)
            chmod($directory, 0777);
        }

        // Add the month to the directory
        $directory .= date('m').DIRECTORY_SEPARATOR;

        if ( ! is_dir($directory))
        {
            // Create the yearly directory
            mkdir($directory, 0777);

            // Set permissions (must be manually set to fix umask issues)
            chmod($directory, 0777);
        }

        // Set the name of the log file
        $filename = $directory.date('d').EXT;


        if ( ! file_exists($filename))
        {
            // Create the log file
            file_put_contents($filename, WPFuel::FILE_SECURITY.' ?>'.PHP_EOL);

            // Allow anyone to write to log files
            chmod($filename, 0666);
        }

        // Set the log line format
        $format = 'time --- type: body';

        foreach ($messages as $message)
        {
            // Write each message into the log file
            file_put_contents($filename, PHP_EOL.strtr($format,$this->_format($message)), FILE_APPEND);
        }
    }
}
?>