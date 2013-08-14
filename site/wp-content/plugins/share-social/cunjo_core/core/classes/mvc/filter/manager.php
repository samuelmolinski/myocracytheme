<?PHP
/**
 * WordPress Fuel - Execution Filter Manager
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
class clsMVC_Filter_Manager extends absFilter
{
    
    private static $_instance = null;
    
    public static function getInstance()
    {
        if(self::$_instance == null)
        {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
     
     protected $_filters = array();
     
     public function resetFilters()
     {
         $this->_filters = array();
         
         return $this;
     }
     
     /**
     * Register a Filter.
     *
     * @param  absFilter $filter
     * @param  int $stackIndex
     * @return clsFilterManager
     */
    public function registerFilter(absFilter $filter, $stackIndex = null)
    {
        if (false !== array_search($filter, $this->_filters, true)) {
            throw new expCore('Filter already registered');
        }

        $stackIndex = (int) $stackIndex;

        if ($stackIndex) {
            if (isset($this->_filters[$stackIndex])) {
                throw new expCore('Filter with stackIndex "' . $stackIndex . '" already registered');
            }
            $this->_filters[$stackIndex] = $filter;
        } else {
            $stackIndex = count($this->_filters);
            while (isset($this->_filters[$stackIndex])) {
                ++$stackIndex;
            }
            $this->_filters[$stackIndex] = $filter;
        }

        $request = $this->getRequest();
        if ($request) {
            $this->_filters[$stackIndex]->setRequest($request);
        }
    
        ksort($this->_filters);

        return $this;
    }
    
    /**
     * Unregister a plugin.
     *
     * @param string|absFilter $filter Filter object or class name
     * @return clsFilterManager
     */
    public function unregisterFilter($filter)
    {
        if ($filter instanceof absFilter) {
            // Given a plugin object, find it in the array
            $key = array_search($filter, $this->_filters, true);
            if (false === $key) {
                throw new expCore('Filter never registered.');
            }
            unset($this->_filters[$key]);
        } elseif (is_string($filter)) {
            // Given a filter class, find all plugins of that class and unset them
            foreach ($this->_filters as $key => $_plugin) {
                $type = get_class($_plugin);
                if ($filter == $type) {
                    unset($this->_filters[$key]);
                }
            }
        }
        return $this;
    }
    
    /**
     * Is a Filter of a particular class registered?
     *
     * @param  string $class
     * @return bool
     */
    public function hasFilter($class)
    {
        foreach ($this->_filters as $filter) {
            $type = get_class($filter);
            if ($class == $type) {
                return true;
            }
        }

        return false;
    }
   
    /**
     * Retrieve a Filter or filters by class
     *
     * @param  string $class Class name of filter(s) desired
     * @return false|absFilter|array Returns false if none found, filter if only one found, and array of filters if multiple filters of same class found
     */
    public function getFilter($class)
    {
        $found = array();
        foreach ($this->_filters as $filter) {
            $type = get_class($filter);
            if ($class == $type) {
                $found[] = $filter;
            }
        }

        switch (count($found)) {
            case 0:
                return false;
            case 1:
                return $found[0];
            default:
                return $found;
        }
    }
    
     /**
     * Retrieve all filters
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->_filters;
    }
    
    /**
     * Set request object, and register with each plugin
     *
     * @param absRequest $request
     * @return clsFilterManager
     */
    public function setRequest(absRequest $request)
    {
        $this->_request = $request;

        foreach ($this->_filters as $filter) {
            $filter->setRequest($request);
        }

        return $this;
    }
  
    
    /**
     * Called before clsFrontController begins evaluating the
     * request against its routes.
     *
     * @param absRequest $request
     * @return void
     */
    public function onRoutingStart(absRequest $request)
    {
        foreach ($this->_filters as $filter) {
            try {
                $filter->onRoutingStart($request);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    
     /**
     * Called before clsFrontController exits its iterations over
     * the route set.
     *
     * @param  absRequest $request
     * @return void
     */
    public function onRoutingEnds(absRequest $request)
    {
        foreach ($this->_filters as $filter) {
            try {
                $filter->onRoutingEnds($request);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    
    /**
     * Called before an action is dispatched by absDispatcher.
     *
     * This callback allows for proxy or filter behavior.  By altering the
     * request and resetting its dispatched flag (via
     * {@link absRequest::setDispatched() setDispatched(false)}),
     * the current action may be skipped.
     *
     * @param  absRequest $request
     * @return void
     */
    public function preDispatch(absRequest $request)
    {
         foreach ($this->_filters as $filter) {
            try {
                $filter->preDispatch($request);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    
    /**
     * Called after an action is dispatched by absDispatcher.
     *
     * This callback allows for proxy or filter behavior. By altering the
     * request and resetting its dispatched flag (via
     * {@link absRequest::setDispatched() setDispatched(false)}),
     * a new action may be specified for dispatching.
     *
     * @param  absRequest $request
     * @return void
     */
    public function postDispatch(absRequest $request)
    {
        foreach ($this->_filters as $filter) {
            try {
                $filter->postDispatch($request);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    
      /**
     * Called bofore ClsFrontController Starts Execution
     * @param absRequest $request 
     */
    public function BeforeExecution(absRequest $request)
    {
        foreach ($this->_filters as $filter) {
            try {
                $filter->BeforeExecution($request);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    
    /**
     * Called after ClsFrontController Completes Execution
     * @param absRequest $request 
     */
    public function AfterExecution(absRequest $request)
    {
        foreach ($this->_filters as $filter) {
            try {
                $filter->AfterExecution($request);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
}