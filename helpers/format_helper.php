<?php
	/*
	 * Format the date
	 */
	function formatDate($date){
		return date("F j, Y, g:i a", strtotime($date));
	}
	
	/*
	 * Shortens the given text up to $chars characters long
	 * @param string $text the text to be shortened
	 * @param int $chars the number of maximum characters to be kept from the text (defaults to 450)
	 */
	function shortenText($text, $chars=450){
		$tmp=$text." ";
		$tmp=substr($tmp,0,$chars);
		return substr($tmp,0,strrpos($tmp,' '))."...";
	}
?>