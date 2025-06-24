@extends('acuaponico::layouts.masterpa')

@section('content2')
<div class="container mt-4">
    <h2 class="text-center mb-4">Sent Activities</h2>
    <a href="{{ route('acuaponico.pasante.pasante.indexactivity') }}" class="btn btn-secondary mb-3">Back</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Apprentice</th>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $index => $activity)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $activity->user->first_name }} {{ $activity->user->last_name }}</td>
                    <td>{{ $activity->date }}</td>
                    <td>{{ $activity->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection