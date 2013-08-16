<?php
class clsDispatcher_Core extends absDispatcher 
{
    /*Onyl one object of controller per request - Memory efficiency*/
    private $_controller_objec_cache = array();
    
    /**
    * Dispatch request
    */
    protected function _dispatch()
    {                 
        $controllerClass = $this->formatController($this->_controller);
 
        $controllerHash = md5($this->_oControllerFile);

        if(isset($this->_controller_object_cache[$controllerHash]) == false)
        {
            /**
             * Instantiate controller with request, response, and invocation
             * arguments; throw exception if it's not an action controller
             */
            $this->oController = new $controllerClass($this,$this->getParams());

            if (!($this->oController instanceof absController)) {
                throw new expCore(
                    'Controller "' . $controllerClass . '" is not an instance of absController'
                );
            }
            
            $this->_controller_object_cache[$controllerHash] = $this->oController;
        }
    
        $this->getRequest()->setDispatched(true);
        

        $this->_controller_object_cache[$controllerHash]->dispatch($this->getActionMethod());
        
    }

}
?>
