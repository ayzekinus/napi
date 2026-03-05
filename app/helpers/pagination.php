<?php

if (!function_exists('pager_link'))
{
    function pager_link($total = null, $page = null, $link = '', $class = 'pagination pagination-sm') {
	
		$ul = '<ul class="'.$class.'">';
		$scroll = 5;
		$show = 10;
		if($total > 1) {
			$page = (intval($page) ? $page : 1);
			if($page!=1) { $ul .= '<li><a href="'.base_url($link).'/'.($page-1).'">&laquo;</a>'; }
				if ($total <= $scroll) {
					if ($total <= $show) {  $loop_start = 1; $loop_finish = $total; }
					else{ $loop_start = 1; $loop_finish = $total; }
				}
				else {
					if($page < intval($scroll / 2) + 1) { $loop_start = 1; $loop_finish = $scroll; }
					else {
						$loop_start = $page - intval($scroll / 2); $loop_finish = $page + intval($scroll / 2);
						if ($loop_finish > $total) $loop_finish = $total;
					}
				}
			for ($i=$loop_start;$i<=$loop_finish;$i++) {
				if($page==$i) { $ul .= '<li class="active"><a href="javascript:;">'.$i.'</a></li>'; }
				else { $ul .= '<li><a href="'.base_url($link).'/'.($i).'">'.$i.'</a></li>'; }
			}
			if($page!=$total) { $ul .= '<li><a href="'.base_url($link).'/'.($page+1).'">&raquo;</a>'; }
		}
		$ul .= '</ul>';
		$ul = str_replace('//','/',$ul);
		$ul = str_replace('http:/','http://',$ul);
		return $ul;
		
	}
}
