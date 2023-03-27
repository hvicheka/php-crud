<?php
/*
 * PHP Pagination Class with bootstrap 4
 * @version 1.0.0
 */
class Paginator{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $page_links;
	var $return;
	var $default_limit = 10;
	var $querystring;
	var $page_limits;
	var $page = 1;
	var $start_range;
	var $end_range;
	var $range;
	

	function __construct()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->page_limits = array(10,25,50,100,150,200);
		$this->items_per_page = @$_GET['limit'] ?? $this->default_limit;
	}

	function paginate()
	{

		// if($_GET['limit'] == 'All')
		if(isset($_GET['limit']) && $_GET['limit'] == 'All')
		{
			$this->num_pages = 1;
		}
		else
		{
			if(!is_numeric($this->items_per_page) || $this->items_per_page <= 0) $this->items_per_page = $this->default_limit;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		
		$this->current_page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1 ; // must be numeric > 0
		
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;
		
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']);
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "page" && $keyval[0] != "limit") $this->querystring .= "&" . $arg;
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "page" && $key != "limit") $this->querystring .= "&$key=$val";
			}
		}
		
		if($this->num_pages > 1)
		{
			$this->return = ($this->current_page > 1 and $this->items_total >= $this->default_limit) ? "<div class='row'><div class='col-sm-7'><ul class='pagination'><li class='page-item'><a class=\"page-link\" href=\"$_SERVER[PHP_SELF]?page=$prev_page&limit=$this->items_per_page$this->querystring\">Previous</a></li> ":"<div class='row'><div class='col-sm-7'><ul class='pagination'><li class='page-item'><a href=\"javascript:;\" class=\"page-link disabled\" tabindex=\"-1\">Previous</a></li> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
		
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
		
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 && $i == $this->range[0]) {
					$this->return .= "";
				}
				if($i==1 || $i==$this->num_pages || in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page and ($this->page != 'All')) ? "<li class='page-item active'><a title=\"Go to page $i of $this->num_pages\" class=\"page-link\" href=\"#\">$i</a></li> ":"<li class='page-item'><a class=\"page-link\" title=\"Go to page $i of $this->num_pages\" href=\"$_SERVER[PHP_SELF]?page=$i&limit=$this->items_per_page$this->querystring\">$i</a></li> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 && $i == $this->range[$this->mid_range-1]){
					$this->return .= "";
				}
			}
			$this->return .= (($this->current_page < $this->num_pages && $this->items_total >= 10) && ($this->page != 'All') && $this->current_page > 0) ? "<li class='page-item'><a class=\"page-link\" href=\"$_SERVER[PHP_SELF]?page=$next_page&limit=$this->items_per_page$this->querystring\">Next</a></li>\n":"<li class='page-item'><a href=\"javascript:;\" class=\"page-link disabled\" href=\"javascript:;\" tabindex=\"-1\">Next</a></li>\n";
			$this->return .= ($this->page == 'All') ? "<li class='page-item active'><a class=\"page-link\" hidden href=\"javascript:;\">All</a></li> \n":"<li class='page-item'><a class=\"page-link\" hidden href=\"$_SERVER[PHP_SELF]?page=1&limit=All$this->querystring\">All</a></li></ul></div> \n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<div class='row'><div class='col-sm-7'><ul class='pagination'><li class='page-item active'><a class=\"page-link\" href=\"#\">$i</a></li> ":"<li class='page-item'><a class=\"page-link\" href=\"$_SERVER[PHP_SELF]?page=$i&limit=$this->items_per_page$this->querystring\">$i</a></li> ";
			}
		}
		$this->low = ($this->current_page <= 0) ? 0:($this->current_page-1) * $this->items_per_page;
		if($this->current_page <= 0) $this->items_per_page = 0;
		$this->page_links = (isset($_GET['limit']) && $_GET['limit'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}
	
	function display_items_per_page()
	{
		$items = '';
		if(!isset($_GET['limit'])) $this->items_per_page = $this->default_limit;
		foreach($this->page_limits as $limit_opt) $items .= ($limit_opt == $this->items_per_page) ? "<option selected value=\"$limit_opt\">$limit_opt</option>\n":"<option value=\"$limit_opt\">$limit_opt</option> \n";
		return "<div class='col-sm-5 float-sm-right'><div class='form-row mt-2 text-right'><div class='col'><span class=\"text-muted\">Rows:</span> <select class=\"border rounded text-muted\" onchange=\"window.location='$_SERVER[PHP_SELF]?page=1&limit='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select></div>\n";
	}
	

	function display_pages()
	{
		return $this->return;
	}
}
