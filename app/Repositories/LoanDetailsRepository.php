<?php

namespace App\Repositories;

use App\Models\LoanDetail;
use Illuminate\Support\Facades\DB;

class LoanDetailsRepository
{
    /**
     * Fetch all loan details from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllLoanDetails()
    {
        return LoanDetail::all();
    }

    /**
     * Fetch loan details by client ID.
     *
     * @param int $clientId
     * @return LoanDetail|null
     */
    public function getLoanDetailsByClientId($clientId)
    {
        return LoanDetail::where('clientid', $clientId)->first();
    }

    /**
     * Get the minimum and maximum dates from loan_details table.
     *
     * @return array
     */
    public function getMinAndMaxDates()
    {
        $loanDetails = DB::table('loan_details')->get();
        return [
            'minDate' => $loanDetails->min('first_payment_date'),
            'maxDate' => $loanDetails->max('last_payment_date')
        ];
    }

    /**
     * Drop and recreate the emi_details table with dynamic columns.
     *
     * @param string $columns
     * @return void
     */
    public function recreateEmiDetailsTable($columns)
    {
        DB::statement('DROP TABLE IF EXISTS emi_details');
        $query = "CREATE TABLE emi_details (clientid INT, $columns)";
        DB::statement($query);
    }

    /**
     * Insert a row into the emi_details table.
     *
     * @param array $row
     * @return void
     */
    public function insertEmiDetails($row)
    {
        DB::table('emi_details')->insert($row);
    }
}
