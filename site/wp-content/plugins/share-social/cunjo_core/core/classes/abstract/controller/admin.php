<?php
abstract class absController_Admin extends absController 
{           
    /**
    * Master Page directory
    * @var string 
    */
    protected $_master_page = 'admin';
   
    private $_heading_data = null;
    protected function setHeadingData($heading,$call_to_action = array('title' => '' , 'link' => ''))
    {
        $this->_heading_data = array(
            'heading' => $heading
        );
        
        $this->ViewData('heading_data', $this->_heading_data)
        ->setCalltoAction($call_to_action);
        
        return $this;
    }
    
    protected function setCalltoAction($call_to_action = array('title' => '' , 'link' => ''))
    {
        if($call_to_action['title'] != '' && $call_to_action['link'] != '')
        {

            if(is_array($this->_heading_data) == false)
                $this->_heading_data = array();

            $this->_heading_data['call_to_action'] = $call_to_action;
            $this->ViewData('heading_data', $this->_heading_data);
        }
        return $this;
    }

    
    protected function formParams($form_params)
    {
        $this->ViewData('form_params',$form_params);
        
        return $this;
    }
    
    protected function formMessages($messages)
    {
        $this->ViewData('form_messages',$messages);
        clsRegistry::set('form_messages',$messages);
        
        return $this;
    }
   
}
?>
