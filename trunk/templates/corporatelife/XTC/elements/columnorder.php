<?php
/*******************************************************************************
********************************************************************************
***                                                                          ***
***   XTC Template Framework 1.0                                             ***
***                                                                          ***
***   Copyright (c) 2010 Monev Software LLC                                  ***
***                                                                          ***
***   All Rights Reserved                                                    ***
***                                                                          ***
********************************************************************************
*******************************************************************************/

defined( '_JEXEC' ) or die;

class JElementColumnorder extends JElement {
	function fetchElement($jxtcname, $jxtcvalue, &$jxtcnode, $jxtccontrol_name)	{

		if (!function_exists('recursive_permutations')) {
			function recursive_permutations($items,$perms = array(), &$list=array() )	{
				if (empty($items)) {
					$list[] = join(',', $perms);      
				}
				else {
					for ($i = count($items)-1;$i>=0;--$i) {
						$newitems = $items;
						$newperms = $perms;
						list($foo) = array_splice($newitems, $i, 1);
						array_unshift($newperms, $foo);
						recursive_permutations($newitems, $newperms, $list);
					};
					return $list;
				};
			}
		}

		$columns = explode(',',$jxtcnode->attributes('columns'));
		array_walk($columns,'trim');
		$perms = recursive_permutations($columns);
		usort($perms,'strnatcmp');

		$options=array();
	
		foreach ($perms as $rec) {
			$display = implode(' ',explode(',',$rec));
			$options[] = JHTML::_('select.option', $rec, $display);
		}
		$perms=array();

		return JHTML::_('select.genericlist',  $options, $jxtccontrol_name.'['.$jxtcname.']', 'class="inputbox"', 'value', 'text', $jxtcvalue, $jxtccontrol_name.$jxtcname);
	}
}
