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
$string['privacy:metadata'] = 'The Plugins fetcher does not store any personal data. It only exposes information that is stored in other parts of the system.';

// Settings.
$string['settings:show_software_stats'] = 'Include software statistics';
$string['settings:show_software_stats_desc'] = 'Whether Moodle version, PHP version, database and operating system information is included.';
$string['settings:show_plugin_versions'] = 'Include plugin version information';
$string['settings:show_plugin_versions_desc'] = 'Whether the following information about a plugin is included in the plugin data: version, release, requires, supported, status.';
$string['settings:excluded_plugins'] = 'Excluded plugins or plugin types';
$string['settings:excluded_plugins_desc'] = 'List of plugins or plugin types to exclude from the result, 
for example `local_pluginsfetcher` or `local_*`.<br />One entry per line.';
