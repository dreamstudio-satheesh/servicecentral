<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceManager extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $filterStore = '';
    public $filterIssueDate = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterStore()
    {
        $this->resetPage();
    }

    public function updatingFilterIssueDate()
    {
        $this->resetPage();
    }

    public function updateInvoiceStatus($id, $status)
    {
        $invoice = Invoice::findOrFail($id);

        if (in_array($status, Invoice::getStatusOptions())) {
            $invoice->update(['status' => $status]);
            session()->flash('success', "Invoice marked as {$status}.");
        } else {
            session()->flash('error', 'Invalid status provided.');
        }
    }


    public function render()
    {
        $query = Invoice::with(['store', 'plan']);

        if (!empty($this->search)) {
            $query->whereHas('store', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->filterStatus)) {
            $query->where('status', $this->filterStatus);
        }

        if (!empty($this->filterStore)) {
            $query->whereHas('store', function ($q) {
                $q->where('name', 'like', '%' . $this->filterStore . '%');
            });
        }

        if (!empty($this->filterIssueDate)) {
            $query->whereDate('issue_date', $this->filterIssueDate);
        }

        $invoices = $query->orderBy('issue_date', 'desc')->paginate(10);

        return view('livewire.admin.invoice-manager', [
            'invoices' => $invoices,
        ]);
    }
}
