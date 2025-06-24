@extends('acuaponico::layouts.master')

@section('content3')
<div class="container mt-4">
    <h2 class="text-center mb-4" style="font-family: 'Noto Sans', sans-serif; font-weight: 600;">
        Activity List
    </h2>

    {{-- FORMULARIO DE CREACIÓN --}}
    <form action="{{ route('acuaponico.admin.admin.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label>Apprentice:</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Date:</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label>Start Date:</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label>End Date:</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="col-md-3 mt-2">
                <label>Status:</label>
                <select name="activity_status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Create Activity</button>
            </div>
        </div>
    </form>

    <hr>

    {{-- TABLA DE ACTIVIDADES --}}
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $index => $activity)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $activity->user->first_name }} {{ $activity->user->last_name }}</td>
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
                        <td>
                            {{-- EDIT BUTTON (trigger modal) --}}
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $activity->id }}">Edit</button>

                            {{-- DELETE FORM --}}
                            <form action="{{ route('acuaponico.admin.admin.destroy', $activity->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this activity?')">Delete</button>
                            </form>

                            {{-- SEND FORM --}}
                            <form action="{{ route('acuaponico.admin.admin.send', $activity->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-success">Send</button>
                            </form>
                        </td>
                    </tr>

                    {{-- EDIT MODAL --}}
                    <div class="modal fade" id="editModal{{ $activity->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $activity->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('acuaponico.admin.admin.update', $activity->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $activity->id }}">Edit Activity</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-md-4">
                                            <label>Apprentice:</label>
                                            <select name="user_id" class="form-control">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $activity->user_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Date:</label>
                                            <input type="date" name="date" class="form-control" value="{{ $activity->date }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Start Date:</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ $activity->start_date }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>End Date:</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ $activity->end_date }}">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>Description:</label>
                                            <input type="text" name="description" class="form-control" value="{{ $activity->description }}">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>Status:</label>
                                            <select name="activity_status" class="form-control">
                                                <option value="pending" {{ $activity->activity_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $activity->activity_status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $activity->activity_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $activity->activity_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No activities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection