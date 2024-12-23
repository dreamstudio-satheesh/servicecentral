<div>
    <div class="row">
        <!-- User List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>User Manager</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Users...">
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>{{ ucfirst($user->status) }}</td>
                                <td>
                                    <button wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $user->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Users Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update User Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $user_id ? 'Edit User' : 'Create User' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" wire:model="mobile_number">
                            @error('mobile_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" wire:model="company_name">
                            @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" wire:model="role">
                                <option value="tenant">Tenant</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="suspended">Suspended</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" wire:click="create" class="btn btn-secondary">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>