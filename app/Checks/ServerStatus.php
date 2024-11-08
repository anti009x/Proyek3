<?php

namespace App\Checks;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;

class ServerStatus extends Check {
    public function run(): Result
    {
        $usedDiskSpacePercentage = $this->getDiskUsagePercentage();

        $result = Result::make();

        if ($usedDiskSpacePercentage === null) {
            return $result->failed("Unable to determine disk usage.");
        }

        if ($usedDiskSpacePercentage > 90) {
            return $result->failed("The disk is almost full ({$usedDiskSpacePercentage}% used)");
        }

        if ($usedDiskSpacePercentage > 70) {
            return $result->warning("The disk is getting full ({$usedDiskSpacePercentage}% used)");
        }

        return $result->ok();
    }

    protected function getDiskUsagePercentage()
    {
        try {
            $diskTotal = @disk_total_space("/");
            $diskFree = @disk_free_space("/");

            if ($diskTotal === false || $diskFree === false || $diskTotal == 0) {
                // Log the error or handle it as needed
                return null;
            }

            $used = $diskTotal - $diskFree;
            return ($used / $diskTotal) * 100;
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return null;
        }
    }
}