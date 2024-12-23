@extends('layouts.app')

@section('content')
<div>
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <label>Name</label>
        <input type="text" name="name" required>
        
        <label>Billing Cycle</label>
        <select name="billing_cycle" required>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
        
        <label>Price</label>
        <input type="number" step="0.01" name="price" required>
        
        <label>Description</label>
        <textarea name="description"></textarea>
        
        <button type="submit">Create Plan</button>
    </form>
</div>
@endsection
