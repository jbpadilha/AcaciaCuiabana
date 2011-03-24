<?php      

/**
 * God there should be a better way of doing this it's fracking ugly looking.
 * If your going to attempt modifying this throw out the swear word jar because you'll go broke quickly.
 * I'll make a screencast soon showing the ins and outs of the main menu mod. But the most important thing 
 * to understand is this passes data back to the helper via callback; so, counter to how most of the other over-rides work.
 * I.E data for menu items is not passed to this it is passed from this file. Hopefully that makes a bit of sense. 
 * Dec 29th 2009.         
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


if ( ! defined('modMainMenuXMLCallbackDefined') )
{
function modMainMenuXMLCallback(&$node, $args)
{
	$user	= &JFactory::getUser();
	$menu	= &JSite::getMenu();    
	$active	= $menu->getActive();    
	$params  = $menu->getParams($active->id); 
	$path	= isset($active) ? array_reverse($active->tree) : null;     
	
   	/*
	 *  Basically this checks for ul's beyond the last li
	 */
	if (($args['end']) && ($node->attributes('level') >= $args['end']))
	{
		$children = $node->children();
		foreach ($node->children() as $child)
		{
			if ($child->name() == 'ul') {
				$node->removeChild($child);
			}
		}
	}  

	if ($node->name() == 'ul') 
	{  
		/*
		 *  Checks the access level of a item and removes it if the
		 *  user does not have access.
		 */
		foreach ($node->children() as $child)
		{
			if ($child->attributes('access') > $user->get('aid', 0)) {
				$node->removeChild($child);
			}     
		}       
		
		// Set Menu ID.
		$menuID =  $params->get( 'tag_id' );
		$node->addAttribute('id', $menuID);
		
		/*
		 * Lets create some classes for use in the li's. Delicious Huh?. 
		 * Step right up and see effects never seen before.
		 */    
		$nodeCount = count($node->children());   
		$l = $nodeCount;
		foreach ($node->children() as $i => $child) 
		{
			if ($i == 0) $child->addAttribute('first', 1);
			if ($i == $l - 1) $child->addAttribute('last', 1);
			$child->addAttribute('order', $i + 1);
			if(($i + 1)%2 != 0) $child->addAttribute('col', 'lft');
			if(($i + 1)%2 == 0) $child->addAttribute('col', 'rgt');
			if ($i == 1) $child->addAttribute('postfirst', 1);
			if ($i == $l - 2) $child->addAttribute('prelast', 1);
		}   
		 
	}   

	
	if ($node->name() == 'li') 
	{ 
		$node->addAttribute('class', 'dir');     
		if ($node->attributes('first')) $node->addAttribute('class', $node->attributes('class').' first'); 
		if ($node->attributes('last')) $node->addAttribute('class', $node->attributes('class').' last'); 

		$subpos = '';
		if ($node->attributes('prelast')) $subpos = 'prelast';
		if ($node->attributes('postfirst')) $subpos = 'postfirst';

		if ($node->attributes('order'))  $node->addAttribute('class', $node->attributes('class'). ' order' . $node->attributes('order') . ' ' . $subpos . ' ' . $node->attributes('col'));  
	}

	if (isset($path) && (in_array($node->attributes('id'), $path) || in_array($node->attributes('rel'), $path)))
	{
		if ($node->attributes('class')) {
			$node->addAttribute('class', $node->attributes('class').' active');
		} else {
			$node->addAttribute('class', 'active');
		}
	}
	else
	{
		if (isset($args['children']) && !$args['children'])
		{
			$children = $node->children();
			foreach ($node->children() as $child)
			{
				if ($child->name() == 'ul') {
					$node->removeChild($child);
				}
			}
		}
	}

	if (($node->name() == 'li') && ($id = $node->attributes('id'))) {
		if ($node->attributes('class')) {
			$node->addAttribute('class', $node->attributes('class').' item'.$id);
		} else {
			$node->addAttribute('class', 'item'.$id);
		}
	}

	if (isset($path) && $node->attributes('id') == $path[0]) {
		$node->addAttribute('id', 'current');
	} else {
		$node->removeAttribute('id');
	} 
	
  
	/*
	 * 
	 * We actually added useless attributes to the nodes so now we have to cut them out. 
     * Or we will get extra attibutes in the markup like order="1".
	 * They're like useless cellphone plan addons. Again I say there has to be a better way. 
	 * *cries* a bit on the insides, yes I said insides not inside, I'm just that cool -- I have two brains.
	 * 
	 */  
	
	$node->removeAttribute('rel');
	$node->removeAttribute('level');
	$node->removeAttribute('access'); 
	$node->removeAttribute('first');
	$node->removeAttribute('last');
	$node->removeAttribute('order');
	$node->removeAttribute('col');
	$node->removeAttribute('postfirst');
	$node->removeAttribute('prelast');

}
	define('modMainMenuXMLCallbackDefined', true);
}

modMainMenuHelper::render($params, 'modMainMenuXMLCallback');
