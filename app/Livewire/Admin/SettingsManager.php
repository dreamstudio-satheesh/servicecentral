<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class SettingsManager extends Component
{
    use WithPagination;

    public $search = '';
    public $key = '';
    public $value = '';
    public $settingId = null;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'key' => 'required|string|max:255|unique:settings,key,' . $this->settingId,
            'value' => 'nullable|string',
        ];
    }

    public function resetInputFields()
    {
        $this->key = '';
        $this->value = '';
        $this->settingId = null;
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->settingId = $setting->id;
    }

    public function save()
    {
        $data = $this->validate();

        Setting::updateOrCreate(['id' => $this->settingId], $data);

        session()->flash('success', $this->settingId ? 'Setting Updated Successfully' : 'Setting Created Successfully');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Setting::findOrFail($id)->delete();
        session()->flash('success', 'Setting Deleted Successfully');
    }

    public function render()
    {
        $query = Setting::query();

        if (!empty($this->search)) {
            $query->where('key', 'like', '%' . $this->search . '%')
                  ->orWhere('value', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.settings-manager', [
            'settings' => $query->orderBy('key')->paginate(10),
        ]);
    }
}
