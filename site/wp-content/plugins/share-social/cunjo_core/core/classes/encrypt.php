<?php 
class clsEncrypt 
{

	/**
	 * @var  string  default instance name
	 */
	public static $default = 'default';

	/**
	 * @var  array  Encrypt class instances
	 */
	public static $instances = array();

	/**
	 * @var  string  OS-dependent RAND type to use
	 */
	protected static $_rand;

	/**
	 * Returns a singleton instance of Encrypt. An encryption key must be
	 * provided in your "encrypt" configuration file.
	 *
	 *     $encrypt = clsEncrypt::instance();
	 *
	 * @param   string  configuration group name
	 * @return  Encrypt
	 */
	public static function instance($name = NULL)
	{
		if ($name === NULL)
		{
			// Use the default instance name
			$name = clsEncrypt::$default;
		}

		if ( ! isset(clsEncrypt::$instances[$name]))
		{
			// Load the configuration data
			$configData = WPFuel::LoadConfig('encrypt');
                        $config = $configData[$name];
                        
			if ( ! isset($config['key']))
			{
				// No default encryption key is provided!
				throw new expCore('No encryption key is defined in the encryption configuration in configuration group ' . $name);
			}

			if ( ! isset($config['mode']))
			{
				// Add the default mode
				$config['mode'] = MCRYPT_MODE_NOFB;
			}

			if ( ! isset($config['cipher']))
			{
				// Add the default cipher
				$config['cipher'] = MCRYPT_RIJNDAEL_128;
			}

			// Create a new instance
			clsEncrypt::$instances[$name] = new clsEncrypt($config['key'], $config['mode'], $config['cipher']);
		}

		return clsEncrypt::$instances[$name];
	}

	/**
	 * Creates a new mcrypt wrapper.
	 *
	 * @param   string   encryption key
	 * @param   string   mcrypt mode
	 * @param   string   mcrypt cipher
	 */
	public function __construct($key, $mode, $cipher)
	{
		// Find the max length of the key, based on cipher and mode
		$size = mcrypt_get_key_size($cipher, $mode);

		if (isset($key[$size]))
		{
			// Shorten the key to the maximum size
			$key = substr($key, 0, $size);
		}

		// Store the key, mode, and cipher
		$this->_key    = $key;
		$this->_mode   = $mode;
		$this->_cipher = $cipher;

		// Store the IV size
		$this->_iv_size = mcrypt_get_iv_size($this->_cipher, $this->_mode);
	}

	/**
	 * Encrypts a string and returns an encrypted string that can be decoded.
	 *
	 *     $data = $encrypt->encode($data);
	 *
	 * The encrypted binary data is encoded using [base64](http://php.net/base64_encode)
	 * to convert it to a string. This string can be stored in a database,
	 * displayed, and passed using most other means without corruption.
	 *
	 * @param   string  data to be encrypted
	 * @return  string
	 */
	public function encode($data)
	{
		// Set the rand type if it has not already been set
		if (clsEncrypt::$_rand === NULL)
		{
			if (WPFuel::isWindows())
			{
				// Windows only supports the system random number generator
				clsEncrypt::$_rand = MCRYPT_RAND;
			}
			else
			{
				if (defined('MCRYPT_DEV_URANDOM'))
				{
					// Use /dev/urandom
					clsEncrypt::$_rand = MCRYPT_DEV_URANDOM;
				}
				elseif (defined('MCRYPT_DEV_RANDOM'))
				{
					// Use /dev/random
					clsEncrypt::$_rand = MCRYPT_DEV_RANDOM;
				}
				else
				{
					// Use the system random number generator
					clsEncrypt::$_rand = MCRYPT_RAND;
				}
			}
		}

		if (clsEncrypt::$_rand === MCRYPT_RAND)
		{
			// The system random number generator must always be seeded each
			// time it is used, or it will not produce true random results
			mt_srand();
		}

		// Create a random initialization vector of the proper size for the current cipher
		$iv = mcrypt_create_iv($this->_iv_size, clsEncrypt::$_rand);

		// Encrypt the data using the configured options and generated iv
		$data = mcrypt_encrypt($this->_cipher, $this->_key, $data, $this->_mode, $iv);

		// Use base64 encoding to convert to a string
		return base64_encode($iv.$data);
	}

	/**
	 * Decrypts an encoded string back to its original value.
	 *
	 *     $data = $encrypt->decode($data);
	 *
	 * @param   string  encoded string to be decrypted
	 * @return  FALSE   if decryption fails
	 * @return  string
	 */
	public function decode($data)
	{
		// Convert the data back to binary
		$data = base64_decode($data, TRUE);

		if ( ! $data)
		{
			// Invalid base64 data
			return FALSE;
		}

		// Extract the initialization vector from the data
		$iv = substr($data, 0, $this->_iv_size);

		if ($this->_iv_size !== strlen($iv))
		{
			// The iv is not the expected size
			return FALSE;
		}

		// Remove the iv from the data
		$data = substr($data, $this->_iv_size);

		// Return the decrypted data, trimming the \0 padding bytes from the end of the data
		return rtrim(mcrypt_decrypt($this->_cipher, $this->_key, $data, $this->_mode, $iv), "\0");
	}

} // End Encrypt
