<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ValidBranchSemester implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!isset($value['branch_id'], $value['semester_id'])) {
            $fail('Both branch and semester are required.');
            return;
        }

        $exists = DB::table('branch_semester')
            ->where('branch_id', $value['branch_id'])
            ->where('semester_id', $value['semester_id'])
            ->exists();

        if (!$exists) {
            $fail('The selected branch and semester combination is invalid.');
        }
    }
}
