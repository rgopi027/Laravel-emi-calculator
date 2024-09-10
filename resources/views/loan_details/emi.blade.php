@extends('layouts.app')

@section('content')
<div class="container">
    <h2>EMI Details</h2>

    @if($emiDetails->isEmpty())
        <p>No EMI data found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Client ID</th>
                    <!-- Dynamically display the column names (months) -->
                    @if ($emiDetails->isNotEmpty())
                        @foreach(array_keys((array)$emiDetails->first()) as $column)
                            @if($column != 'clientid') <!-- Skip clientid column in header -->
                                <th>{{ $column }}</th>
                            @endif
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($emiDetails as $emi)
                    <tr>
                        <td>{{ $emi->clientid }}</td>
                        @foreach((array)$emi as $column => $value)
                            @if($column != 'clientid')
                                <td>{{ number_format($value, 2) }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Form for "Back to Loan Details" Button -->
        <form action="{{ route('loan-details.index') }}" method="GET">
            <button type="submit" class="btn btn-primary">Back to Loan Details</button>
        </form>

    @endif
</div>
@endsection
