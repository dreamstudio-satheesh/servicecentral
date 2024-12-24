<div class="container mt-4">
    <div class="row">
        <!-- Subscription List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Manage Subscriptions</h5>
                    <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Search Subscriptions...">
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Store</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subscriptions as $subscription)
                            <tr>
                                <td>{{ ($subscriptions->currentPage() - 1) * $subscriptions->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $subscription->store->name }}</td>
                                <td>{{ $subscription->plan->name }}</td>
                                <td>{{ ucfirst($subscription->status) }}</td>
                                <td>{{ $subscription->plan_start_date->format('Y-m-d') }}</td>
                                <td>{{ $subscription->plan_end_date->format('Y-m-d') }}</td>
                                <td>
                                    <button wire:click="edit({{ $subscription->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $subscription->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Subscriptions Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $subscriptions->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Subscription Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $subscription_id ? 'Edit Subscription' : 'Create Subscription' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label>Store</label>
                            <select class="form-control" wire:model="store_id">
                                <option value="">-- Select Store --</option>
                                @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endforeach
                            </select>
                            @error('store_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Plan</label>
                            <select class="form-control" wire:model="plan_id">
                                <option value="">-- Select Plan --</option>
                                @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                            @error('plan_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" wire:model="plan_start_date">
                            @error('plan_start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" wire:model="plan_end_date">
                            @error('plan_end_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                                <option value="pending_renewal">Pending Renewal</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
