<?php
/*
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
*/

function displayUsage() {
   die("\nusage: ".$_SERVER['argv'][0]." [ --host=<dbhost> ] --type=<dbtype> --db=<dbname> --user=<dbuser> [ --pass=<dbpassword> ] [ --lang=xx_XX] [ --tests ] [ --force ]\n\n");
}

$args = [ 'host' => 'localhost', 'pass' => ''];

if ($_SERVER['argc']>1) {
   for ($i=1 ; $i<count($_SERVER['argv']) ; $i++) {
      $it           = explode("=",$argv[$i],2);
      $it[0]        = preg_replace('/^--/','',$it[0]);
      $args[$it[0]] = (isset($it[1]) ? $it[1] : true);
   }
}

define('GLPI_ROOT', dirname(__DIR__));
chdir(GLPI_ROOT);

if (isset($args['tests'])) {
   define("GLPI_CONFIG_DIR", GLPI_ROOT . "/tests");
}

include_once (GLPI_ROOT . "/inc/autoload.function.php");
include_once (GLPI_ROOT . "/inc/db.function.php");
Config::detectRootDoc();

if (isset($args['help']) || !(isset($args['db']) && isset($args['user']))) {
   displayUsage();
}

if (isset($args['lang']) && !isset($CFG_GLPI['languages'][$args['lang']])) {
   $kl = implode(', ', array_keys($CFG_GLPI['languages']));
   die("Unkown locale (use one of: $kl)\n");
}

if (file_exists(GLPI_CONFIG_DIR . '/config_db.php') && !isset($args['force'])) {
   die("Already installed (see --force option)\n");
}

$_SESSION = ['glpilanguage' => (isset($args['lang']) ? $args['lang'] : 'en_GB')];
Toolbox::setDebugMode(Session::DEBUG_MODE, 0, 0, 1);

echo "Connect to the DB...\n";

if ($args['type'] == 'postgres') {
   $args['type'] = 'pgsql';
}

$hostport = explode(":", $args['host']);
if (count($hostport) < 2) {
  $dsn = $args['type'].':host='.$hostport[0];
} else {
  $dsn = $args['type'].':host='.$hostport[0].';port='.$hostport[1];
}
$options = array();
if ($type == 'mysql') {
   $options = array(
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
   );
} else if ($type == 'pgsql') {
   $dsn .= ';dbname=postgres';
}

try {
   $pdo = new PDO($dsn, $args['user'], $args['pass'], $options);
} catch (PDOException $e) {
   die("DB connection failed\n");
}

$sth = $pdo->prepare('CREATE DATABASE '.$newdatabasename);
if (!$sth->execute()) {
   die("Can't create the DB\n");
}

$pdo = new PDO($dsn.';dbname='.$args['db'], $args['user'], $args['pass'], $options);

// Prepare conf for phinx
$_SERVER['PHINX_DBHOST'] = $hostport[0];
$_SERVER['PHINX_DBUSER'] = $args['user'];
$_SERVER['PHINX_DBPASS'] = $args['pass'];
$_SERVER['PHINX_DBNAME'] = $args['db'];

echo "Save configuration file...\n";
if (!DBConnection::createMainConfig($args['host'], $args['user'], $args['pass'], $args['db'], $args['type'])) {
   die("Can't write configuration file\n");
}

$app = require '../vendor/robmorgan/phinx/app/phinx.php';
$wrap = new Phinx\Wrapper\TextWrapper($app,
        array('configuration' => 'phinx.yml', 'parser' => 'YAML'));

// Execute the command and determine if it was successful.
$output = call_user_func(array($wrap, 'getMigrate'), 'production_'.$type, null);
$error  = $wrap->getExitCode() > 0;

echo "<pre>";
echo $output;
echo "</pre>";
echo $error;

if ($error == 500) {
   die("Error on install\n");
}

echo "Done\n";
