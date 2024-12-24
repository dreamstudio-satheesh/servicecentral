<div class="container mt-4">
    <div class="row">
        <!-- Store List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Store Manager</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Stores...">
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Subdomain</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stores as $store)
                            <tr>
                                <td>{{ ($stores->currentPage() - 1) * $stores->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->subdomain }}</td>
                                <td>{{ ucfirst($store->status) }}</td>
                                <td>
                                    <button wire:click="edit({{ $store->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $store->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Stores Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $stores->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Store Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $store_id ? 'Edit Store' : 'Create Store' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Store Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Subdomain</label>
                            <input type="text" class="form-control" wire:model="subdomain">
                            @error('subdomain') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Database Name</label>
                            <input type="text" class="form-control" wire:model="database_name">
                            @error('database_name') <span class="text-danger">{{ $message }}</span> @enderror
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
                            <label>User</label>
                            <select class="form-control" wire:model="user_id">
                                <option value="">-- Select User --</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="trial">Trial</option>
                                <option value="active">Active</option>
                                <option value="suspended">Suspended</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Save Store</button>
                            <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
