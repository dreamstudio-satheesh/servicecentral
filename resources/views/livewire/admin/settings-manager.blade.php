<div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Settings</h5>
                        <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Settings...">
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($settings as $setting)
                                <tr>
                                    <td>{{ ($settings->currentPage() - 1) * $settings->perPage() + $loop->index + 1 }}</td>
                                    <td>{{ $setting->key }}</td>
                                    <td>{{ $setting->value }}</td>
                                    <td>
                                        <button wire:click="edit({{ $setting->id }})" class="btn btn-primary btn-sm">Edit</button>
                                        <button wire:click="delete({{ $setting->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Settings Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $settings->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $settingId ? 'Edit Setting' : 'Create Setting' }}</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <div class="form-group">
                                <label>Key</label>
                                <input type="text" class="form-control" wire:model="key">
                                @error('key') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Value</label>
                                <textarea class="form-control" wire:model="value"></textarea>
                                @error('value') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="pt-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>