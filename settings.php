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
 * local_pluginsfetcher - Settings page
 *
 * @package    local_pluginsfetcher
 * @copyright  2026 Melanie Treitinger <melanie.treitinger@ruhr-uni-bochum.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_pluginsfetcher', get_string('pluginname', 'local_pluginsfetcher'));
    $ADMIN->add('localplugins', $settings);
    $settings->add(
        new admin_setting_configpasswordunmask(
            'local_pluginsfetcher/prometheus_token',
            new lang_string('settings:token', 'local_pluginsfetcher'),
            new lang_string('settings:token_desc', 'local_pluginsfetcher'),
            '',
        )
    );
}
