<?php 
abstract class absFilter 
{
    /**
     * @var absRequest
     */
    protected $_request;
    
    public function setRequest($request)
    {
        $this->_request = $request;
    }
    
    /**
    * Get request object
    *
    * @return absRequest $request
    */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Called bofore ClsFrontController Starts Execution
     * @param absRequest $request 
     */
    public function BeforeExecution(absRequest $request)
    {}
    
    /**
     * Called after ClsFrontController Completes Execution
     * @param absRequest $request 
     */
    public function AfterExecution(absRequest $request)
    {}

     /**
     * Called before clsFrontController begins evaluating the
     * request against its routes.
     *
     * @param absRequest $request
     * @return void
     */
    public function onRoutingStart(absRequest $request)
    {}
    
     /**
     * Called after clsFrontController completes the route->map()
     *
     * @param absRequest $request
     * @return void
     */
    public function onRoutingEnds(absRequest $request)
    {}

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
    {}

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
    {}

} 