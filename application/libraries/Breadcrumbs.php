<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumbs {
	
	/**
	 * Breadcrumbs stack
	 *
     */
	private $breadcrumbs = array();
	private $breadcrumbs_title = array();
	 	
	 /**
	  * Constructor
	  *
	  * @access	public
	  *
	  */
	public function __construct(){	
		$this->ci =& get_instance();
		// Load config file
		$this->ci->load->config('breadcrumbs');
		// Get breadcrumbs display options
		$this->tag_open = $this->ci->config->item('tag_open');
		$this->tag_close = $this->ci->config->item('tag_close');
		$this->divider = $this->ci->config->item('divider');
		$this->crumb_open = $this->ci->config->item('crumb_open');
		$this->crumb_close = $this->ci->config->item('crumb_close');
		$this->crumb_last_open = $this->ci->config->item('crumb_last_open');
		$this->crumb_divider = $this->ci->config->item('crumb_divider');
		
		#title Settings
		$this->title_crumb_open = $this->ci->config->item('title_crumb_open');
		$this->title_crumb_close = $this->ci->config->item('title_crumb_close');
		$this->title_crumb_tag_open = $this->ci->config->item('title_crumb_tag_open');
		$this->title_crumb_tag_close = $this->ci->config->item('title_crumb_tag_close');
		
		log_message('debug', "Breadcrumbs Class Initialized");
	}
	
	// --------------------------------------------------------------------
	/**
	 * Append crumb to stack
	 *
	 * @access	public
	 * @param	string $page
	 * @param	string $href
	 * @return	void
	 */	
	function setTitle($title,$tagline){
		$this->breadcrumbs_title['title'] = $title;
		$this->breadcrumbs_title['tagline'] = $tagline;
	}
	function push($page, $href){
		// no page or href provided
		if (!$page OR !$href) return;
		
		// Prepend site url
		$href = site_url($href);
		
		// push breadcrumb
		$this->breadcrumbs[$href] = array('page' => $page, 'href' => $href);
	}
	
	// --------------------------------------------------------------------
	/**
	 * Prepend crumb to stack
	 *
	 * @access	public
	 * @param	string $page
	 * @param	string $href
	 * @return	void
	 */		
	function unshift($page, $href){
		// no crumb provided
		if (!$page OR !$href) return;
		
		// Prepend site url
		$href = site_url($href);
		
		// add at firts
		array_unshift($this->breadcrumbs, array('page' => $page, 'href' => $href));
	}
	
	function showTitle(){
		if($this->breadcrumbs_title){
			//construct output
			$output = $this->title_crumb_open;
			$output .= $this->breadcrumbs_title['title'];
			$output .= $this->title_crumb_tag_open;
			$output .= $this->breadcrumbs_title['tagline'];
			$output .= $this->title_crumb_tag_close;
			$output .= $this->title_crumb_close;
			return $output;
		}
		// no title
		return $this->title_crumb_open."&nbsp;".$this->title_crumb_close;
	}
	
	// --------------------------------------------------------------------
	/**
	 * Generate breadcrumb
	 *
	 * @access	public
	 * @return	string
	 */		
	function show(){
		if ($this->breadcrumbs) {
		
			// set output variable
			$output = $this->tag_open;
			
			// construct output
			foreach ($this->breadcrumbs as $key => $crumb) {
				$keys = array_keys($this->breadcrumbs);
				if (end($keys) == $key) {
					$output .= $this->crumb_last_open . '' . $crumb['page'] . '' . $this->crumb_close;
				} else {
					$output .= $this->crumb_open.'<a href="' . $crumb['href'] . '">' . $crumb['page'] . '</a> '.$this->crumb_divider.$this->crumb_close;
				}
			}
			
			// return output
			return $output . $this->tag_close . PHP_EOL;
		}
		
		// no crumbs
		return '';
	}
}