<?php
function showProfitBal($amt = 0){
	if($amt == 0){
		return $amt;
	} else if($amt > 0) {
		return "<span class=\"badge badge-success\" style=\"font-size: 14px;\">{$amt}</span>";
	} else {
		return "<span class=\"badge badge-danger\" style=\"font-size: 14px;\">{$amt}</span>";
	}
	
}
?>