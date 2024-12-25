<div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Invoice Manager</h5>
                        <div class="d-flex gap-2">
                            <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search by Store">
                            <select wire:model="filterStatus" class="form-control">
                                <option value="">-- Filter by Status --</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <input wire:model="filterIssueDate" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Store</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ ($invoices->currentPage() - 1) * $invoices->perPage() + $loop->index + 1 }}</td>
                                    <td>{{ $invoice->store->name }}</td>
                                    <td>{{ $invoice->plan->name }}</td>
                                    <td>${{ $invoice->amount }}</td>
                                    <td>{{ ucfirst($invoice->status) }}</td>
                                    <td>{{ $invoice->issue_date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if ($invoice->status !== 'Paid')
                                            <button wire:click="updateInvoiceStatus({{ $invoice->id }}, 'Paid')" class="btn btn-success btn-sm">Mark Paid</button>
                                            @endif
                                            @if ($invoice->status !== 'Unpaid')
                                            <button wire:click="updateInvoiceStatus({{ $invoice->id }}, 'Unpaid')" class="btn btn-warning btn-sm">Mark Unpaid</button>
                                            @endif
                                            @if ($invoice->status !== 'Cancelled')
                                            <button wire:click="updateInvoiceStatus({{ $invoice->id }}, 'Cancelled')" class="btn btn-danger btn-sm">Cancel</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No invoices found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>