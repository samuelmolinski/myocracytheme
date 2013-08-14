<?php
/**
 * Designed to allow for mod_rewrite-like functionality using pure PHP structures
 * 
 */
class clsRouter_Core extends absRouter 
{
    /**
     * Processes a request and sets its controller and action. 
     * Also, sets all the indexers keys as router params
     *
     * @uses  clsKeysIndexer - Route indexer
     * @return void
     */
    public function map()
    { 
        $request = $this->getRequest();
        
        $core_url = $request->get('core_url');

        WPFuel::getCoreUrlRequest($core_url,$request);

        unset($_GET['core_url']);
        
        $route_params = $this->getRequest()->getParam('route_params');
        
        foreach($route_params as $key=>$param)
        {            
            $this->setParam($key,$param);
        }
        
        
        $this->getRequest()->setParam('route_params',null);
 
        $this->getRequest()->setController($this->getParam('controller'))
                        ->setAction($this->getParam('method'))
                        ->setSlug($this->getParam('slug'))
                        ->setCode($this->getParam('code'));  
    }
    
}
?>