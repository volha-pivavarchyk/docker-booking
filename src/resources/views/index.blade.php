@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-5 col-11 m-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">List of 5 hotels with the smallest number of weekend stays </h4>
                    <table class="table table-stripe mt-2">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hotel ID</th>
                            <th scope="col">Stays</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($hotelsWithSmallestStaysNumbers as $hotel => $count)
                            <tr>
                                <th scope="row"> {{ $loop->iteration}}</th>
                                <td>{{ $hotel }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 col-11 m-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">The average rejection rate per hotel </h4>
                    <table class="table table-stripe mt-2">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hotel ID</th>
                            <th scope="col">Rejection Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($averageRejectionRate as $hotel => $rate)
                            <tr>
                                <th scope="row"> {{ $loop->iteration}}</th>
                                <td>{{ $hotel }}</td>
                                <td>{{ $rate }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 col-11 m-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">List the 5 most unlucky customers</h4>
                    <table class="table table-stripe mt-2">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Rejection Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($averageRejectionRate as $customer => $rejection)
                            <tr>
                                <th scope="row"> {{ $loop->iteration}}</th>
                                <td>{{ $customer }}</td>
                                <td>{{ $rejection }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
