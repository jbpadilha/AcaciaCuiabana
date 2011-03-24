<?php
/*
	JoomlaXTC Event Wall Module
	
	version 1.1
	
	Copyright (C) 2009  Monev Software LLC.	All Rights Reserved.
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/
$catimage = empty($item->catimage) ? '' : 'images/stories/'.$item->catimage;
$itemhtml = str_replace( '{catname}',$item->catname,$itemhtml );
$itemhtml = str_replace( '{catimage}',$catimage,$itemhtml );
$itemhtml = str_replace( '{catdescription}',$item->catdescription,$itemhtml );

$venueurl = JRoute::_('index.php?view=venueevents&id='.$item->vid.':'.$item->valias.'&option=com_eventlist'.$Itemid);
$venueimage = empty($item->venueimage) ? '' : 'images/eventlist/venues/'.$item->venueimage;
$itemhtml = str_replace( '{venue}',$item->venue,$itemhtml );
$itemhtml = str_replace( '{venuewebsite}',$item->venuewebsite,$itemhtml );
$itemhtml = str_replace( '{venueurl}',$venueurl,$itemhtml );
$itemhtml = str_replace( '{venuestreet}',$item->venuestreet,$itemhtml );
$itemhtml = str_replace( '{venueplz}',$item->venueplz,$itemhtml );
$itemhtml = str_replace( '{venuecity}',$item->venuecity,$itemhtml );
$itemhtml = str_replace( '{venuestate}',$item->venuestate,$itemhtml );
$itemhtml = str_replace( '{venuecountry}',$item->venuecountry,$itemhtml );
$itemhtml = str_replace( '{venuedescription}',$item->venuedescription,$itemhtml );
$itemhtml = str_replace( '{venueimage}',$venueimage,$itemhtml );

$eventdescription = strip_tags($item->eventdescription);
if (strlen($eventdescription) > $description_max_length) $eventdescription = substr($eventdescription,0,$description_max_length).'...';
$eventurl = JRoute::_('index.php?view=details&id='.$item->eid.':'.$item->ealias.'&option=com_eventlist'.$Itemid);
$eventimage = empty($item->eventimage) ? '' : 'images/eventlist/events/'.$item->eventimage;

$eventstartdate = date($date_format,strtotime($item->eventstartdate));
$eventenddate = date($date_format,strtotime($item->eventenddate));
$itemhtml = str_replace( '{event}',$item->event,$itemhtml );
$itemhtml = str_replace( '{eventurl}',$eventurl,$itemhtml );
$itemhtml = str_replace( '{eventstartdate}',$eventstartdate,$itemhtml );
$itemhtml = str_replace( '{eventenddate}',$eventenddate,$itemhtml );
$itemhtml = str_replace( '{eventstarttime}',$item->eventstarttime,$itemhtml );
$itemhtml = str_replace( '{eventendtime}',$item->eventendtime,$itemhtml );
$itemhtml = str_replace( '{eventdescription}',$eventdescription,$itemhtml );
$itemhtml = str_replace( '{eventimage}',$eventimage,$itemhtml );

$itemhtml = str_replace( '{index}',$item->index,$itemhtml );
?>