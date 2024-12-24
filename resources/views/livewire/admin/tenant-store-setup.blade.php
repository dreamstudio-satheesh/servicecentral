<div>
    <form wire:submit.prevent="save">
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
            <label>Status</label>
            <select class="form-control" wire:model="status">
                <option value="trial">Trial</option>
                <option value="active">Active</option>
                <option value="suspended">Suspended</option>
                <option value="cancelled">Cancelled</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Trial Start Date</label>
            <input type="date" class="form-control" wire:model="trial_start_date">
            @error('trial_start_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Trial End Date</label>
            <input type="date" class="form-control" wire:model="trial_end_date">
            @error('trial_end_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Store</button>
    </form>
</div>
