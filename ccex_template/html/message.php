<?php
/**
 * @package     pt.keep.joomla
 * @subpackage  templates.ccex
 *
 * @copyright   Copyright (C) 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function renderMessage($msgList)
{
	$buffer  = "";

	if (is_array($msgList)){

		foreach ($msgList as $type => $msgs){
			if(strtolower($type) == "notice"){ 
				$type = "info";
			}elseif(strtolower($type) == "message"){ 
				$type = "success"; 
			}elseif(strtolower($type) == "error"){ 
				$type = "danger"; 
			}

			if (count($msgs)){
				$buffer .= "\n<div class=\"alert alert-" . strtolower($type) . " alert-dismissable\">";
				$buffer .= "\n\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				
				foreach ($msgs as $msg){
					$buffer .= "\n\t<p>" . $msg . "</p>";
				}

				$buffer .= "\n</div>";
			}
		}

		return $buffer;
	}
}
