<?php

namespace App\Services;

use App\Repositories\LoanDetailsRepository;
use DateTime;

class LoanDetailsService
{
    protected $loanDetailsRepository;
    /**
     * Constructor to initialize the repository.
     *
     * @param LoanDetailsRepository $loanDetailsRepository
     */
    public function __construct(LoanDetailsRepository $loanDetailsRepository)
    {
        $this->loanDetailsRepository = $loanDetailsRepository;
    }

    /**
     * Process EMI data for all loan details and create dynamic emi_details table.
     *
     * @return void
     */
    public function processLoanDetailsEMI()
    {
        $loanDetails = $this->loanDetailsRepository->getAllLoanDetails();
        $dates = $this->getPaymentMonths($loanDetails);

        // Create dynamic columns based on months
        $columns = implode(', ', $dates->map(function ($date) {
            return "$date DECIMAL(10, 2) DEFAULT 0";
        })->toArray());

        // Recreate emi_details table
        $this->loanDetailsRepository->recreateEmiDetailsTable($columns);

        // Process each loan and insert EMI data
        foreach ($loanDetails as $loan) {
            $emi = round($loan->loan_amount / $loan->num_of_payment, 2);
            $row = ['clientid' => $loan->clientid];
            $paymentDate = new DateTime($loan->first_payment_date);

            for ($i = 0; $i < $loan->num_of_payment; $i++) {
                $column = $paymentDate->format('Y_M');
                $row[$column] = $emi;
                $paymentDate->modify('+1 month');
            }

            // Insert into emi_details table
            $this->loanDetailsRepository->insertEmiDetails($row);
        }
    }

    /**
     * Get all payment months between the min and max dates.
     *
     * @param Collection $loanDetails
     * @return Collection
     */
    private function getPaymentMonths($loanDetails)
    {
        $minMaxDates = $this->loanDetailsRepository->getMinAndMaxDates();
        $minDate = $minMaxDates['minDate'];
        $maxDate = $minMaxDates['maxDate'];

        $dates = collect();
        $startDate = new DateTime($minDate);
        $endDate = new DateTime($maxDate);

        while ($startDate <= $endDate) {
            $dates->push($startDate->format('Y_M'));
            $startDate->modify('+1 month');
        }

        return $dates;
    }
}
