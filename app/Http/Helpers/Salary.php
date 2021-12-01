<?php

namespace Ajifatur\Helpers;

use App\Models\SalaryCategory;

/**
 * @method static int getAmountByRange(string|int $value, int $group_id, int $category)
 */
class Salary
{
    /**
     * Get the amount of salary by range.
     *
     * @param  string $date
     * @return string|null
     */
    public static function getAmountByRange($value, $group_id, $category)
    {
        // Get the category
        $salary_category = SalaryCategory::where('group_id','=',$group_id)->find($category);

        // Set the amount of salary
        $amount = 0;
        $set = false;
        if($salary_category) {
            if(count($salary_category->indicators) > 0) {
                foreach($salary_category->indicators as $indicator) {
                    if($indicator->upper_range != null) {
                        if($value >= $indicator->lower_range && $value <= $indicator->upper_range) {
                            $amount = $indicator->amount;
                            $set = true;
                        }
                    }
                    else {
                        if($set == false && $value >= $indicator->lower_range) {
                            $amount = $indicator->amount;
                            $set = true;
                        }
                    }
                }
            }
        }

        return $amount;
    }
}