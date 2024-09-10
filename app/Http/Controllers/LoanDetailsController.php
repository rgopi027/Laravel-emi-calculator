<?php

namespace App\Http\Controllers;

use App\Services\LoanDetailsService;
use App\Repositories\LoanDetailsRepository;
use Illuminate\Http\Request;
// use App\Models\LoanDetail;
use DB;



class LoanDetailsController extends Controller
{	
	/**
     * LoanDetailsService instance
     * 
     * @var LoanDetailsService
     */
	protected $loanDetailsService;

	/**
     * LoanDetailsRepository instance
     * 
     * @var LoanDetailsRepository
     */
	protected $loanDetailsRepository;


	/**
     * Constructor to inject dependencies and apply middleware.
     *
     * @param  LoanDetailsService  $loanDetailsService
     * @param  LoanDetailsRepository  $loanDetailsRepository
     * @return void
     */
	public function __construct(LoanDetailsService $loanDetailsService, LoanDetailsRepository $loanDetailsRepository)
	{

        $this->middleware('auth');
	    $this->loanDetailsService = $loanDetailsService;
	    $this->loanDetailsRepository = $loanDetailsRepository;
	}


	/**
     * Display loan details.
     *
     * @return \Illuminate\View\View
     */
    public function index()
	{
	    $loanDetails = $this->loanDetailsRepository->getAllLoanDetails();
    	return view('loan_details.index', compact('loanDetails'));
	}

	/**
     * Process EMI data and create the emi_details table dynamically.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function processEMI()
	{
        $this->loanDetailsService->processLoanDetailsEMI();
        // return redirect()->route('loan-details.index');
        return redirect()->route('emi-details');        
	}

	/**
     * Show the EMI details.
     *
     * @return \Illuminate\View\View
     */
	public function showEMI()
	{
	    $emiDetails = DB::table('emi_details')->get();
	    return view('loan_details.emi', compact('emiDetails'));
	}


}