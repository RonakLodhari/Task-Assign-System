@extends('layouts.user')
@section('content')
    <h2>Submit Timesheet</h2>
    <form action="{{ route('user.timesheet.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Hours Worked</label>
            <input type="number" name="hours" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
