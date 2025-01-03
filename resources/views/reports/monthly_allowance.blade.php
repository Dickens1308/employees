@extends('layouts.app')

@section('section')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Employee name</th>
            <th scope="col">Food</th>
            <th scope="col">Transport</th>
            <th scope="col">Communication</th>
            <th scope="col">Child care</th>
            <th scope="col">School fee</th>
            <th scope="col">Total</th>
            <th scope="col">average</th>
            <th scope="col">Overall rank by average</th>
            <th scope="col">Rank by gender</th>
            <th scope="col"></th>
        </tr>
        </thead>
        @foreach($employeesReport as $index =>  $data)
            <tr>
                <td>{{ $loop->iteration + $employees->perPage() * ($employees->currentPage() - 1) }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['food'] }}</td>
                <td>{{ $data['transport'] }}</td>
                <td>{{ $data['communication'] }}</td>
                <td>{{ $data['child_care'] }}</td>
                <td>{{ $data['school_fee'] }}</td>
                <td>{{ $data['total'] }}</td>
                <td>{{ $data['average'] }}</td>
                <td>{{ $data['rank_by_average'] }}</td>
                <td>{{ $data['rank_by_gender'] }}</td>
            </tr>
        @endforeach
    </table>

    <div class="pagination">
        {{ $employees->links() }}
    </div>
@endsection
