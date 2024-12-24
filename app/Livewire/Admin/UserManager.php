<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    use WithPagination;

    public $user_id;
    public $name;
    public $email;
    public $mobile_number;
    public $company_name;
    public $role = 'tenant';
    public $status = 'pending';
    public $password;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'mobile_number' => 'required|string|max:15',
        'company_name' => 'required|string|max:255',
        'role' => 'required|in:admin,tenant',
        'status' => 'required|in:active,pending,suspended',
        'password' => 'required|min:8',
    ];

    public function render()
    {        
        $query = User::where('role', 'tenant');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.user-manager', compact('users'));
    }

    public function resetInputFields()
    {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->mobile_number = '';
        $this->company_name = '';
        $this->role = 'tenant';
        $this->status = 'pending';
        $this->password = '';
    }

    public function store()
    {
        $this->rules['email'] = 'required|email|unique:users,email,' . $this->user_id;

        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'company_name' => $this->company_name,
            'role' => $this->role,
            'status' => $this->status,
            'password' => Hash::make($this->password),
        ];

        User::updateOrCreate(['id' => $this->user_id], $data);

        $this->resetInputFields();
        $this->dispatch('show-toastr', ['message' => 'User ' . ($this->user_id ? 'Updated' : 'Created') . ' Successfully.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile_number = $user->mobile_number;
        $this->company_name = $user->company_name;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->password = ''; 
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'User Deleted Successfully.');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
