@extends('layouts.app')

@section('content')
<div>
    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name</label>
        <input type="text" name="name" value="{{ $plan->name }}" required>
        
        <label>Billing Cycle</label>
        <select name="billing_cycle" required>
            <option value="monthly" {{ $plan->billing_cycle == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly" {{ $plan->billing_cycle == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
        
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ $plan->price }}" required>
        
        <label>Description</label>
        <textarea name="description">{{ $plan->description }}</textarea>
        
        <button type="submit">Update Plan</button>
    </form>
</div>
@endsection
