<?php

namespace App\Checks;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;

class CpuLoad extends Check {
    public function run(): Result
    {
        // Execute the WMIC command to get CPU load
        $output = shell_exec('wmic cpu get loadpercentage');
        
        if ($output === null) {
            return Result::make()->failed("Failed to retrieve CPU load.");
        }

        $lines = explode("\n", trim($output));

        // The first line is the header, so we remove it
        array_shift($lines);

        // Calculate the average CPU load
        $cpuLoads = array_filter($lines, fn($line) => is_numeric(trim($line)));
        $cpuLoad = count($cpuLoads) > 0 ? array_sum($cpuLoads) / count($cpuLoads) : 0;

        // Define your threshold (e.g., 80%)
        $threshold = 80;

        $result = Result::make();

        if ($cpuLoad > $threshold) {
            return $result->failed("CPU Load is too high: {$cpuLoad}%");
        }
        if ($cpuLoad > 70) {
            return $result->warning("CPU Load is getting high: {$cpuLoad}%");
        }
        if ($cpuLoad < 30) {
            return $result->ok("CPU Load is very low: {$cpuLoad}%");
        }
        if ($cpuLoad < 50) {
            return $result->ok("CPU Load is low: {$cpuLoad}%");
        }
        return $result->ok("CPU Load is moderate: {$cpuLoad}%");
    }
}