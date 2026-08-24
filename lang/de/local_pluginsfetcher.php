<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package   local_pluginsfetcher
 * @copyright 2019 Adrian Perez <p.adrian@gmx.ch> {@link https://adrianperez.me}
 * @copyright 2025 Niels Gandraß <niels@gandrass.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// @codingStandardsIgnoreFile

defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore

// General.
$string['pluginname'] = 'Plugins fetcher';

// Privacy.
$string['privacy:metadata'] = 'Der Plugins fetcher speichert keine personenbezogenen Daten. Er stellt lediglich Informationen bereit, die in anderen Teilen des Systems gespeichert sind.';

// Settings.
$string['settings:show_software_stats'] = 'Software Statistik ausgeben';
$string['settings:show_software_stats_desc'] = 'Gibt die Moodle Version, PHP Version, Datenbank- sowie Betriebssysteminformationen aus.';
$string['settings:show_plugin_versions'] = 'Informationen über Pluginversionen ausgeben';
$string['settings:show_plugin_versions_desc'] = 'Gibt die folgenden Informationen zu einem Plugin aus: version, release, requires, supported, status.';
$string['settings:excluded_plugins'] = 'Plugins oder Plugin Typen nicht ausgeben';
$string['settings:excluded_plugins_desc'] = 'Liste an Plugins oder Plugin Typen, die nicht ausgebenen werden sollen, z.B.
`local_pluginsfetcher` or `local_*`.<br />Ein Eintrag pro Zeile.';