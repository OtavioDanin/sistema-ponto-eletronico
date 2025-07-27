<?php
$status = opcache_get_status();
$config = opcache_get_configuration();
echo "Hit Rate: " . round($status['opcache_statistics']['opcache_hit_rate'], 2) . "%\n";
echo "Memory Usage: " . round($status['memory_usage']['used_memory'] / $status['memory_usage']['free_memory'] * 100, 2) . "%\n";
echo "Cached Files: " . $status['opcache_statistics']['num_cached_scripts'] . "\n";
echo "Max Files: " . $config['directives']['opcache.max_accelerated_files'] . "\n";
if ($status['opcache_statistics']['opcache_hit_rate'] < 99) {
    echo "WARNING: Hit rate too low!\n";
}
if ($status['restart_pending'] || $status['restart_in_progress']) {
    echo "ERROR: OPcache restart detected!\n";
}
