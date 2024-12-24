<div class="container mt-4">
    <div class="row">
        <!-- Form Card -->
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5>Tenant Store Setup</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <!-- Row 1 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Store Name</label>
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subdomain</label>
                                    <input type="text" class="form-control" wire:model="subdomain">
                                    @error('subdomain') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Database Name</label>
                                    <input type="text" class="form-control" wire:model="database_name">
                                    @error('database_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Plan</label>
                                    <select class="form-control" wire:model="plan_id">
                                        <option value="">Free Trail</option>
                                        @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('plan_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control" wire:model="user_id">
                                        <option value="">-- Select User --</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trial Start Date</label>
                                    <input type="date" class="form-control" wire:model="trial_start_date">
                                    @error('trial_start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trial End Date</label>
                                    <input type="date" class="form-control" wire:model="trial_end_date">
                                    @error('trial_end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                         <div class="pt-3">
                         <button type="submit" class="btn btn-primary mt-3">Save Store</button>
                         <button type="button" wire:click="$set('user_id', '')" class="btn btn-secondary mt-3">Reset</button>
                         </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
