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
 * local_pluginsfetcher - Prometheus endpoint
 *
 * Usage:
 *  - GET /local/pluginsfetcher/prometheus.php?token=[token]
 *  - GET /local/pluginsfetcher/prometheus.php?token=[token]&type=[type1,type2,...]
 *  - GET /local/pluginsfetcher/prometheus.php?token=[token]&contribonly=1
 *
 * @package    local_pluginsfetcher
 * @copyright  2026 Melanie Treitinger <melanie.treitinger@ruhr-uni-bochum.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);
require_once(__DIR__ . '/../../config.php');

// Deliver content as plain text.
header('Content-Type: text/plain; charset=utf-8');
// Prevent sensible data from being cached.
header('Cache-Control: no-store');
// Prevent MIME type sniffing.
header('X-Content-Type-Options: nosniff');

// Allow only GET method.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
    header('Allow: GET');
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

// Read expected token from plugin config.
try {
    $expectedtoken = (string) get_config('local_pluginsfetcher', 'prometheus_token');
} catch (\dml_exception $e) {
    debugging("Failed to read the Prometheus token from plugin config: {$e->getMessage()}");
    http_response_code(500);
    echo 'Error in Prometheus exporter';
    exit;
}

if ('' !== $expectedtoken) {
    // Read token from query parameter.
    $token = optional_param('token', '', PARAM_RAW);

    // Read token from Authorization header.
    $authorization = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    if (preg_match('/^Bearer\s+(.+)$/i', $authorization, $matches)) {
        $token = $matches[1];
    }

    // Check if provided token matches the expected one.
    if ($expectedtoken !== '' && !hash_equals($expectedtoken, (string) $token)) {
        http_response_code(403);
        echo 'Invalid auth token';
        exit;
    }
}

// Read and validate the optional plugin filters.
$typeparameter = optional_param('type', '', PARAM_RAW_TRIMMED);
$contribonly = optional_param('contribonly', false, PARAM_BOOL);
$types = $typeparameter === ''
    ? []
    : array_values(array_unique(array_map('strtolower', array_map('trim', explode(',', $typeparameter)))));
$validplugintypes = array_keys(\core_component::get_plugin_types());

foreach ($types as $type) {
    if (!in_array($type, $validplugintypes, true)) {
        http_response_code(400);
        echo 'Invalid plugin type';
        exit;
    }
}

// Get the filtered plugin stats and software stats.
try {
    $pluginstats = [
        'stats' => [
            'total' => 0,
            'standard' => 0,
            'contrib' => 0,
        ],
        'plugins' => [],
    ];

    foreach ($types ?: [null] as $type) {
        $filteredstats = \local_pluginsfetcher\collector::get_plugin_stats($type, $contribonly);
        foreach ($filteredstats['stats'] as $category => $value) {
            $pluginstats['stats'][$category] += $value;
        }
        $pluginstats['plugins'] += $filteredstats['plugins'];
    }

    $softwarestats = \local_pluginsfetcher\collector::get_software_stats();
    echo \local_pluginsfetcher\exporter::export($pluginstats, $softwarestats);
} catch (\moodle_exception $e) {
    debugging("Failed to collect Prometheus metrics: {$e->getMessage()}");
    http_response_code(500);
    echo 'Error in Prometheus exporter';
}
