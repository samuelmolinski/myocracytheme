<?php
abstract class absFrontController extends absController 
{    
    private $_logged_in = false;
    
     /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
        $this->_logged_in = modAuth::isLoggedIn();
        $this->ViewData('is_logged_in', $this->_logged_in);

        unset($_GET['per_page']);

        $this->setSidebarLayout('default');

        $this->setOGImage();
        $this->setOGDescription();

        parent::init();
    }
    
    protected function setOGImage($image = '')
    {
        if($image == '')
        {
            $image = ASSETS_URL. 'images/marketpense-logo.png';
        }
        
        $this->ViewData('og_image',$image);
    }
    
    protected function setOGDescription($description = '')
    {
        if($description == '')
        {
            $description = $this->Meta()->getDescription();
        }
        
        $this->ViewData('og_description',$description);
    }
    
    /**
     * Automatically executed if auth_needed = true. Can be used to do authorization checks, and execute other custom code.
     *
     * @return  void
     */
    public function Authenticate()
    {
        
    }
   
    /**
     * Automatically executed before the controller action. Can be used to set
     * class properties, do authorization checks, and execute other custom code.
     *
     * @return  void
     */
    public function before()
    {
        parent::before();
    }

    /**
     * Automatically executed after the controller action. Can be used to apply
     * transformation to the response, add extra output, and execute
     * other custom code.
     *
     * @return  void
     */
    public function after()
    {
       parent::after();
    }

    protected function Show404()
    {
        clsTemplate_Meta::set_optional_meta('robots', 'NOINDEX, NOFOLLOW');
        
        $this->Meta()->setTitle('Page Not Found');
        $this->View('404/404');
        exit;
    }
    
    protected function setPageHeading($heading)
    {
         $this->ViewData('page_heading',$heading);
    }
    
    protected function setSidebarLayout($sidebar_layout)
    {
         $this->ViewData('sidebar',$sidebar_layout);
    }
}
?>
