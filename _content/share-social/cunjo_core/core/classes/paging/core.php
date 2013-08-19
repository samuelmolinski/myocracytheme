<?PHP
/**
 * Pagination Class
 *
 */
class clsPaging_Core
{
	
    public $paging_output = NULL;
 
    public $result = NULL;

    public $adjacents = 2;

    public $css_class = "pagination";

    public $page_records = 0;
    
    protected $_page_sets = array(10,25,50,100,200,250,500,1000);
    public function getPageSets()
    {
        return $this->_page_sets;
    }


    public $per_page = 50;
    public $total_records = 0;
    public $hide_numbers = false;
    private $_paged_dataset = array();
    
    
    public $target_page = '';
    public $query_params = array();
    public $preserve_url_query_string = true;
    public $type = 'GET'; // GET / AJAX
    
    private $_styles = array('default','next-previous');
    private $_style = 'next-previous';


    public function setStyle($style)
    {
        if($style != '')
        {
            if(in_array($style, $this->_styles))
            {
                $this->_style = $style;
            }
        }
        return $this;
    }
    

    public function setPerPage($records_per_page)
    {
        $this->per_page = (int)$records_per_page;
        return $this;
    }
    
    
    public function setGetType()
    {
        $this->type = 'GET';
        return $this;
    }
    
    public function getTotalRecords()
    {
        return $this->total_records;
    }
	
	
    
    
    public function setAjaxType()
    {
        $this->type = 'AJAX';
        return $this;
    }
	
	

    public function setTargetPage($target_page)
    {
        $this->target_page = (string)$target_page;
        
        return $this;
    }

    public function preserveQueryString($bool)
    {
        $this->preserve_url_query_string = (bool)$bool;
        
        return $this;
    }
	

    public function setQueryParams($query_params)
    {
        $this->query_params = (array)$query_params;
        
        return $this;
    }
	
    public function setHideNumbers($hide_numbers)
    {
        $this->hide_numbers  = (int)$hide_numbers ;
        return $this;
    }
	
    function pagination()
    {
        if($this->paging_output != NULL){
            return $this->paging_output;
        }
    }
    
    public function getTargetPage()
    {
        if($this->target_page == '')
        {
            $this->target_page = clsUri::currentURL();
        }
        
        return $this->target_page;
    }
    
    private $_pagination_url =  '';
    
    private function getPaginationUrl()
    {
        if($this->_pagination_url == '')
        {
            $target_page = $this->getTargetPage();
 
            $query_params = $this->query_params;
            
            $query_params[$this->_qs_page_num_key] = '[PAGE]';


            $urlParts = parse_url($target_page);
            $current_url = clsUri::partsToUrl($urlParts);

            $urlQparams = array();
            
            if($this->preserve_url_query_string == true)
            {
                parse_str($urlParts['query'],$urlQparams);
                if(is_array($urlQparams))
                {
                    unset($urlQparams[$this->_qs_page_num_key]);
                }
            }
    
            $query_params = array_merge($query_params,$urlQparams);
            $query_string = http_build_query($query_params);
            if($query_string == '')
            {
                $this->_pagination_url = $current_url;
            }
            else
            {
                 $this->_pagination_url = $current_url . '?' . http_build_query($query_params);;
            }
        }


        return $this->_pagination_url;
    }
    
    private function getLinknAttributes($page,$attributes = array())
    {

        $url = str_replace('%5BPAGE%5D', $page, $this->getPaginationUrl());

        $attributes['href'] = $url;
        
        if($attributes['rel'] == '')
            $attributes['rel'] = 'nofollow';
        
        if($page == 2 && $attributes['rel'] == 'prev')
        {
            $attributes['rel'] = 'prev start';
        }
        
        if($this->type == 'AJAX')
        {
            $attributes['class'] = 'paginate-ajax';
        }
        
        return clsHTML::attributes($attributes);
    }
    
    private function getDefaultStyle()
    {
        $page = $this->page;
        $prev = $page - 1;    //previous page is page - 1
        $next = $page + 1;    //next page is page + 1
        $lastpage = ceil($this->total_records/$this->per_page);        //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;     //last page minus 1
        
        $pagination = "";

        $pagination_url = $this->getPaginationUrl();
     
        if($lastpage > 1)
        {	
                $pagination .= "<div class=\"".$this->css_class."\">";
                //previous button
                if ($page > 1) 
                        $pagination.= "<a".$this->getLinknAttributes($prev,array('rel' => 'prev', 'class' => 'prev_page_url')).">previous</a>";
                else
                        $pagination.= "<span class=\"disabled\">previous</span>";	


                        $middle_string = '';
                        //pages	
                        if ($lastpage < 7 + ($this->adjacents * 2))	//not enough pages to bother breaking it up
                        {	
                                for ($counter = 1; $counter <= $lastpage; $counter++)
                                {
                                        if ($counter == $page)
                                                $middle_string.= "<span class=\"current\">$counter</span>";
                                        else
                                                $middle_string.= "<a".$this->getLinknAttributes($counter).">$counter</a>";					
                                }
                        }
                        elseif($lastpage > 5 + ($this->adjacents * 2))	//enough pages to hide some
                        {
                                //close to beginning; only hide later pages
                                if($page < 1 + ($this->adjacents * 2))		
                                {
                                        for ($counter = 1; $counter < 4 + ($this->adjacents * 2); $counter++)
                                        {
                                                if ($counter == $page)
                                                        $middle_string.= "<span class=\"current\">$counter</span>";
                                                else
                                                        $middle_string.= "<a".$this->getLinknAttributes($counter).">$counter</a>";					
                                        }
                                        $middle_string.= "<span class=\"page_dots\">...</span>";
                                        $middle_string.= "<a".$this->getLinknAttributes($lpm1).">$lpm1</a>";
                                        $middle_string.= "<a".$this->getLinknAttributes($lastpage).">$lastpage</a>";		
                                }
                                //in middle; hide some front and some back
                                elseif($lastpage - ($this->adjacents * 2) > $page && $page > ($this->adjacents * 2))
                                {
                                        $middle_string.= "<a".$this->getLinknAttributes(1).">1</a>";
                                        $middle_string.= "<a".$this->getLinknAttributes(2).">2</a>";
                                         $middle_string.= "<span class=\"page_dots\">...</span>";
                                        for ($counter = $page - $this->adjacents; $counter <= $page + $this->adjacents; $counter++)
                                        {
                                                if ($counter == $page)
                                                        $middle_string.= "<span class=\"current\">$counter</span>";
                                                else
                                                        $middle_string.= "<a".$this->getLinknAttributes($counter).">$counter</a>";					
                                        }
                                        $middle_string.= "<span class=\"page_dots\">...</span>";
                                        $middle_string.= "<a".$this->getLinknAttributes($lpm1).">$lpm1</a>";
                                        $middle_string.= "<a".$this->getLinknAttributes($lastpage).">$lastpage</a>";		
                                }
                                //close to end; only hide early pages
                                else
                                {
                                        $middle_string.= "<a".$this->getLinknAttributes(1).">1</a>";
                                        $middle_string.= "<a".$this->getLinknAttributes(2).">2</a>";
                                         $middle_string.= "<span class=\"page_dots\">...</span>";
                                        for ($counter = $lastpage - (2 + ($this->adjacents * 2)); $counter <= $lastpage; $counter++)
                                        {
                                                if ($counter == $page)
                                                        $middle_string.= "<span class=\"current\">$counter</span>";
                                                else
                                                        $middle_string.= "<a".$this->getLinknAttributes($counter).">$counter</a>";					
                                        }
                                }
                        }

                    if($this->hide_numbers == 0 ) { 
                         $pagination .= $middle_string;
                    }

                //next button
                if ($page < $counter - 1) 
                        $pagination.= "<a".$this->getLinknAttributes($next,array('rel' => 'next', 'class' => 'next_page_url')).">next</a>";
                else
                        $pagination.= "<span class=\"disabled\">next</span>";


                $pagination .= "</div>\n";		
        }
        
        return $pagination;

    }
    
    private function getNextPreviousStyle()
    {
        $page = $this->page;
        $prev = $page - 1;    //previous page is page - 1
        $next = $page + 1;    //next page is page + 1
        $lastpage = ceil($this->total_records/$this->per_page);        //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;     //last page minus 1
        
        $pagination = "";

        if($lastpage > 1)
        {

            $pagination = '<div class="pagination-sleek">';
             if ($page > 1) 
             {
                $pagination .= '<span class="newer">
                                <a'.$this->getLinknAttributes($prev,array('rel' => 'prev', 'class' => 'img_icons prev_page_url')).'>Previous</a>
                        </span>';
             }
             if ($page < $lastpage) 
             {
                 $pagination .= '<span class="older">
                                    <a'.$this->getLinknAttributes($next,array('rel' => 'next', 'class' => 'img_icons next_page_url')).'>Next</a>
                            </span>';
             }
            $pagination .= '</div>';
        }
        
        
        return $pagination;

    }
    
    private $_qs_page_num_key = 'pgno';
    public function paginate($sql)
    {
        global $wpdb;
        $db = clsDatabase::factory();

        $this->page = (int)clsRequest::instance()->getParam($this->_qs_page_num_key,1);
        
        if($_GET['per_page'] > 0)
        {
            $this->per_page = $_GET['per_page'];
        }
        
        if($this->page) 
            $start = ($this->page - 1) * $this->per_page; //first item to display on this page
        else
            $start = 0;	//if no page var is given, set start to 0

    
        $sql .=  " LIMIT $start, ".$this->per_page."";
        
 
        $this->_paged_dataset = $db->dataset($sql);
    
        $this->total_records = $db->getFoundRows();
 
        $this->page_records =  count($this->_paged_dataset);

 
        $pagination = '';
        
        if($this->_style == 'default')
        {
            $pagination = $this->getDefaultStyle();
        }
        else if($this->_style == 'next-previous')
        {
            $pagination = $this->getNextPreviousStyle();
        }
        
 
        $this->paging_output = $pagination;

        return $this->_paged_dataset;
    }
    
     public function getPerPageUrl($per_page)
    {
        $target_page = $this->getTargetPage();
        $query_params = $this->query_params;
        
        $query_params['per_page'] = $per_page;


        $urlParts = parse_url($target_page);
        $current_url = clsUri::partsToUrl($urlParts);

        $urlQparams = array();

        if($this->preserve_url_query_string == true)
        {
            parse_str($urlParts['query'],$urlQparams);
            if(is_array($urlQparams))
            {
                unset($urlQparams['per_page']);
            }
            
        }

        $query_params = array_merge($query_params,$urlQparams);
        unset($query_params[$this->_qs_page_num_key]);
        $query_string = http_build_query($query_params);
        if($query_string == '')
        {
            return $current_url;
        }
        else
        {
             return $current_url . '?' . http_build_query($query_params);;
        }
  
    }

	
}


?>