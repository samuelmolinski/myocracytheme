<?php
interface intRouter
{
    public function setRequest(absRequest $request);

    public function getRequest();
    
     /**
     * Add or modify a parameter to use when instantiating an action controller
     *
     * @param string $name
     * @param mixed $value
     * @return ice_router_abstract
     */
    public function setParam($name, $value);

    public function setParams(array $params);

    /**
     * Retrieve a single parameter from the controller parameter stack
     *
     * @param string $name
     * @return mixed
     */
    public function getParam($name);

    /**
     * Retrieve action controller instantiation parameters
     *
     * @return array
     */
    public function getParams();

    /**
     * Clear the controller parameter stack
     *
     * By default, clears all parameters. If a parameter name is given, clears
     * only that parameter; if an array of parameter names is provided, clears
     * each.
     *
     * @param null|string|array single key or array of keys for params to clear
     * @return ice_router_abstract
     */
    public function clearParams($name = null);
    
 
}
