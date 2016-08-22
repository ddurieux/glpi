<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2015 Teclib'.

 http://glpi-project.org

 based on GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2014 by the INDEPNET Development Team.

 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

/** @file
* @brief
* @since version 0.85
*/

// Direct access to file
if (strpos($_SERVER['PHP_SELF'],"searchitemtype.php")) {
   include ('../inc/includes.php');
   header("Content-Type: text/html; charset=UTF-8");
   Html::header_nocache();
}

Session::checkLoginUser();

$itemtype = filter_input(INPUT_POST, 'itemtype');
$params = filter_input(INPUT_POST, 'params', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

if (empty($params)) {
   $params = array(
       'condition' => 'AND',
       'rules' => array()
   );
}

if (!empty($itemtype)) {
   Search::showList($itemtype, array('criteria' => $params));
}

echo "<table width='100%'><tr><td class='left'>";
$timedebug = sprintf(_n('%s second', '%s seconds', $TIMER_DEBUG->getTime()),
                     $TIMER_DEBUG->getTime());

if (function_exists("memory_get_usage")) {
   $timedebug = sprintf(__('%1$s - %2$s'), $timedebug, Toolbox::getSize(memory_get_usage()));
}
echo $timedebug;
echo "</td></tr></table>";
Html::ajaxFooter();
?>