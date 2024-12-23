<div>
    <div class="row">
        <!-- Plans List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Plan Manager</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Plans...">
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Billing Cycle</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($plans as $plan)
                            <tr>
                                <td>{{ ($plans->currentPage() - 1) * $plans->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ ucfirst($plan->billing_cycle) }}</td>
                                <td>${{ $plan->price }}</td>
                                <td>
                                    <button wire:click="edit({{ $plan->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button x-data="{ planId: {{ $plan->id }} }" @click="confirmDeletion(planId)" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Plans Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $plans->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Plan Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $plan_id ? 'Edit Plan' : 'Create Plan' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Billing Cycle</label>
                            <select class="form-control" wire:model="billing_cycle">
                                <option value="">Select</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                            @error('billing_cycle') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" step="0.01" class="form-control" wire:model="price">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" wire:click="create" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDeletion(planId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // @this.call('delete', planId);
                    Swal.fire('Deleted!', 'Plan has been deleted.', 'success');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            window.addEventListener('show-toastr', event => {
                toastr.success(event.detail.message);
            });
        });
    </script>
    @endpush
</div>
