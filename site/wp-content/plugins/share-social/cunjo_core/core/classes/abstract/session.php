<?php 
/**
 * Abstract session class.
 *
 */
abstract class absSession {

	/**
	 * @var  string  default session adapter
	 */
	public static $default = 'native';

	/**
	 * @var  array  session instances
	 */
	public static $instances = array();

	/**
	 * Creates a singleton session of the given type. Some session types
	 * (native, database) also support restarting a session by passing a
	 * session id as the second parameter.
	 *
	 *     $session = clsSession::instance();
	 *
	 * [!!] [clsSession::write] will automatically be called when the request ends.
	 *
	 * @param   string   type of session (native, cookie, etc)
	 * @param   string   session identifier
	 * @return  Session
	 * @uses    Kohana::$config
	 */
	public static function instance($type = NULL, $id = NULL)
	{
		if ($type === NULL)
		{
                        // Use the default type
                        $type = clsSession::$default;
		}

		if ( ! isset(clsSession::$instances[$type]))
		{
                        $sessionConfig = WPFuel::LoadConfig('session',false,CORE_CONFIG_PATH);
                        
			// Load the configuration for this type
			$config = $sessionConfig[$type];

			// Set the session class name
			$class = 'clsSession_'.ucfirst($type);
    
			// Create a new session instance
			clsSession::$instances[$type] = $session = new $class($config, $id);
           
			// Write the session at shutdown
			register_shutdown_function(array($session, 'write'));
		}

		return clsSession::$instances[$type];
	}

	/**
	 * @var  string  cookie name
	 */
	protected $_name = 'coremvc-wp-session';

	/**
	 * @var  int  cookie lifetime
	 */
	protected $_lifetime = 0;

	/**
	 * @var  bool  encrypt session data?
	 */
	protected $_encrypted = FALSE;

	/**
	 * @var  array  session data
	 */
	protected $_data = array();

	/**
	 * @var  bool  session destroyed?
	 */
	protected $_destroyed = FALSE;

	/**
	 * Overloads the name, lifetime, and encrypted session settings.
	 *
	 * [!!] Sessions can only be created using the [clsSession::instance] method.
	 *
	 * @param   array   configuration
	 * @param   string  session id
	 * @return  void
	 * @uses    clsSession::read
	 */
	public function __construct(array $config = NULL, $id = NULL)
	{
		if (isset($config['name']))
		{
			// Cookie name to store the session id in
			$this->_name = (string) $config['name'];
		}

		if (isset($config['lifetime']))
		{
			// Cookie lifetime
			$this->_lifetime = (int) $config['lifetime'];
		}

		if (isset($config['encrypted']))
		{
			if ($config['encrypted'] === TRUE)
			{
				// Use the default Encrypt instance
				$config['encrypted'] = 'default';
			}

			// Enable or disable encryption of data
			$this->_encrypted = $config['encrypted'];
		}

		// Load the session
		$this->read($id);
	}

	/**
	 * Session object is rendered to a serialized string. If encryption is
	 * enabled, the session will be encrypted. If not, the output string will
	 * be encoded using [base64_encode].
	 *
	 *     echo $session;
	 *
	 * @return  string
	 * @uses    clsEncrypt::encode
	 */
	public function __toString()
	{
		// Serialize the data array
		$data = serialize($this->_data);

		if ($this->_encrypted)
		{
			// Encrypt the data using the default key
			$data = clsEncrypt::instance($this->_encrypted)->encode($data);
		}
		else
		{
			// Obfuscate the data with base64 encoding
			$data = base64_encode($data);
		}

		return $data;
	}

	/**
	 * Returns the current session array. The returned array can also be
	 * assigned by reference.
	 *
	 *     // Get a copy of the current session data
	 *     $data = $session->as_array();
	 *
	 *     // Assign by reference for modification
	 *     $data =& $session->as_array();
	 *
	 * @return  array
	 */
	public function & as_array()
	{
		return $this->_data;
	}

	/**
	 * Get the current session id, if the session supports it.
	 *
	 *     $id = $session->id();
	 *
	 * [!!] Not all session types have ids.
	 *
	 * @return  string
	 * @since   3.0.8
	 */
	public function id()
	{
		return NULL;
	}

	/**
	 * Get the current session cookie name.
	 *
	 *     $name = $session->name();
	 *
	 * @return  string
	 * @since   3.0.8
	 */
	public function name()
	{
		return $this->_name;
	}

	/**
	 * Get a variable from the session array.
	 *
	 *     $foo = $session->get('foo');
	 *
	 * @param   string   variable name
	 * @param   mixed    default value to return
	 * @return  mixed
	 */
	public function get($key, $default = NULL)
	{
		return array_key_exists($key, $this->_data) ? $this->_data[$key] : $default;
	}

	/**
	 * Get and delete a variable from the session array.
	 *
	 *     $bar = $session->get_once('bar');
	 *
	 * @param   string  variable name
	 * @param   mixed   default value to return
	 * @return  mixed
	 */
	public function get_once($key, $default = NULL)
	{
		$value = $this->get($key, $default);

		$this->_unset($key);

		return $value;
	}
        
        /**
	 * Unset a variable in the session array.
	 *
	 *     $session->_unset('foo_key');
	 *
	 * @param   string   key name
	 * @return  $this
	 */
	public function _unset($key)
	{
            unset($this->_data[$key]);
            return $this;
	}
        
	/**
	 * Set a variable in the session array.
	 *
	 *     $session->set('foo', 'bar');
	 *
	 * @param   string   variable name
	 * @param   mixed    value
	 * @return  $this
	 */
	public function set($key, $value)
	{
		$this->_data[$key] = $value;

		return $this;
	}

	/**
	 * Set a variable by reference.
	 *
	 *     $session->bind('foo', $foo);
	 *
	 * @param   string  variable name
	 * @param   mixed   referenced value
	 * @return  $this
	 */
	public function bind($key, & $value)
	{
		$this->_data[$key] =& $value;

		return $this;
	}

	/**
	 * Removes a variable in the session array.
	 *
	 *     $session->delete('foo');
	 *
	 * @param   string  variable name
	 * @param   ...
	 * @return  $this
	 */
	public function delete($key)
	{
		$args = func_get_args();

		foreach ($args as $key)
		{
			unset($this->_data[$key]);
		}

		return $this;
	}

	/**
	 * Loads existing session data.
	 *
	 *     $session->read();
	 *
	 * @param   string   session id
	 * @return  void
	 */
	public function read($id = NULL)
	{
		$data = NULL;

		try
		{
			if (is_string($data = $this->_read($id)))
			{
				if ($this->_encrypted)
				{
					// Decrypt the data using the default key
					$data = clsEncrypt::instance($this->_encrypted)->decode($data);
				}
				else
				{
					// Decode the base64 encoded data
					$data = base64_decode($data);
				}

				// Unserialize the data
				$data = unserialize($data);
			}
			else
			{
				// Ignore these, session is valid, likely no data though.
			}
		}
		catch (Exception $e)
		{
			// Error reading the session, usually
			// a corrupt session.
			throw new expSession('Error reading session data.');
		}

		if (is_array($data))
		{
			// Load the data locally
			$this->_data = $data;
		}
	}

	/**
	 * Generates a new session id and returns it.
	 *
	 *     $id = $session->regenerate();
	 *
	 * @return  string
	 */
	public function regenerate()
	{
		return $this->_regenerate();
	}

	/**
	 * Sets the last_active timestamp and saves the session.
	 *
	 *     $session->write();
	 *
	 * [!!] Any errors that occur during session writing will be logged,
	 * but not displayed, because sessions are written after output has
	 * been sent.
	 *
	 * @return  boolean
	 * @uses    Kohana::$log
	 */
	public function write()
	{
		if (headers_sent() OR $this->_destroyed)
		{
			// Session cannot be written when the headers are sent or when
			// the session has been destroyed
			return FALSE;
		}

                
		// Set the last active timestamp
		$this->_data['last_active'] = time();

		try
		{
			return $this->_write();
		}
		catch (Exception $e)
		{
                        throw new expSession('Error writing session data.');
		}
	}

	/**
	 * Completely destroy the current session.
	 *
	 *     $success = $session->destroy();
	 *
	 * @return  boolean
	 */
	public function destroy()
	{
		if ($this->_destroyed === FALSE)
		{
			if ($this->_destroyed = $this->_destroy())
			{
				// The session has been destroyed, clear all data
				$this->_data = array();
			}
		}

		return $this->_destroyed;
	}

	/**
	 * Restart the session.
	 *
	 *     $success = $session->restart();
	 *
	 * @return  boolean
	 */
	public function restart()
	{
		if ($this->_destroyed === FALSE)
		{
			// Wipe out the current session.
			$this->destroy();
		}

		// Allow the new session to be saved
		$this->_destroyed = FALSE;

		return $this->_restart();
	}
        
        /**
	 * Creates a singleton session of the given type. Some session types
	 * (native, database) also support restarting a session by passing a
	 * session id as the second parameter.
	 *
	 *     $session = clsSession::instance();
	 *
	 * [!!] [clsSession::write] will automatically be called when the request ends.
	 *
	 * @param   string   type of session (native, cookie, etc)
	 * @param   string   session identifier
	 * @return  Session
	 * @uses    Kohana::$config
	 */
	public static function getSessionByID($id,$type = NULL)
	{
		if ($type === NULL)
		{
                    // Use the default type
                    $type = clsSession::$default;
		}

                $sessionConfig = WPFuel::LoadConfig('session');

                // Load the configuration for this type
                $config = $sessionConfig[$type];
                
                
                session_name($config['name']);
                session_id($id);
                
                $_COOKIE[$config['name']] = $id;

                // Set the session class name
                $class = 'clsSession_'.ucfirst($type);

                // Create a new session instance
                $session = new $class($config, $id);

                // Write the session at shutdown
                register_shutdown_function(array($session, 'write'));
	
		return $session;
	}

	/**
	 * Loads the raw session data string and returns it.
	 *
	 * @param   string   session id
	 * @return  string
	 */
	abstract protected function _read($id = NULL);

	/**
	 * Generate a new session id and return it.
	 *
	 * @return  string
	 */
	abstract protected function _regenerate();

	/**
	 * Writes the current session.
	 *
	 * @return  boolean
	 */
	abstract protected function _write();

	/**
	 * Destroys the current session.
	 *
	 * @return  boolean
	 */
	abstract protected function _destroy();

	/**
	 * Restarts the current session.
	 *
	 * @return  boolean
	 */
	abstract protected function _restart();

} // End Session
