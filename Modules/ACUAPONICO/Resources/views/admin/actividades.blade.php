@extends('acuaponico::layouts.master')

@section('content3')
<div class="container mt-4">
    <h2 class="text-center mb-4" style="font-family: 'Noto Sans', sans-serif; font-weight: 600;">
        Activity List
    </h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Apprentice Name</th>
                    <th>Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $index => $activity)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $activity->user->first_name }} {{ $activity->user->last_name }}
                        </td>
                        <td>{{ $activity->date }}</td>
                        <td>{{ $activity->start_date }}</td>
                        <td>{{ $activity->end_date }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>
                            <span class="badge 
                                @if($activity->activity_status == 'pending') badge-warning
                                @elseif($activity->activity_status == 'in_progress') badge-info
                                @elseif($activity->activity_status == 'completed') badge-success
                                @elseif($activity->activity_status == 'cancelled') badge-danger
                                @endif
                            ">
                                {{ ucfirst(str_replace('_', ' ', $activity->activity_status)) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No activities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection