<?php 
class clsSession_Native extends absSession 
{
        /**
         * @return  string
         */
        public function id()
        {
            return session_id();
        }

        /**
         * @param   string  $id  session id
         * @return  null
         */
        protected function _read($id = NULL)
        {
                // Sync up the session cookie with Cookie parameters
                session_set_cookie_params($this->_lifetime, clsCookie::$path, clsCookie::$domain, clsCookie::$secure, clsCookie::$httponly);

                // Do not allow PHP to send Cache-Control headers
                session_cache_limiter(FALSE);

                // Set the session cookie name
                session_name($this->_name);

                if ($id)
                {
                    // Set the session id
                    session_id($id);
                }
                
         
                // Start the session
                session_start();
                
                
               // if (isset($_COOKIE[$this->_name]))
                 //   setcookie($this->_name, $_COOKIE[$this->_name], time() + $this->_lifetime, clsCookie::$path);


                // Use the $_SESSION global for storing data
                $this->_data = & $_SESSION;

                return NULL;
        }

        /**
         * @return  string
         */
        protected function _regenerate()
        {
                // Regenerate the session id
                session_regenerate_id();

                return session_id();
        }

        /**
         * @return  bool
         */
        protected function _write()
        {
                // Write and close the session
                session_write_close();

                return TRUE;
        }

        /**
         * @return  bool
         */
        protected function _restart()
        {
                // Fire up a new session
                $status = session_start();

                // Use the $_SESSION global for storing data
                $this->_data =& $_SESSION;

                return $status;
        }

        /**
         * @return  bool
         */
        protected function _destroy()
        {
                // Destroy the current session
                session_destroy();

                // Did destruction work?
                $status = ! session_id();

                if ($status)
                {
                        // Make sure the session cannot be restarted
                        clsCookie::delete($this->_name);
                }

                return $status;
        }
}
