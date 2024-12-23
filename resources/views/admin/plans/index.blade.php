@extends('layouts.app')

@section('content')
<div>
    <a href="{{ route('plans.create') }}">Create New Plan</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Billing Cycle</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
            <tr>
                <td>{{ $plan->name }}</td>
                <td>{{ ucfirst($plan->billing_cycle) }}</td>
                <td>${{ $plan->price }}</td>
                <td>
                    <a href="{{ route('plans.edit', $plan->id) }}">Edit</a>
                    <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
