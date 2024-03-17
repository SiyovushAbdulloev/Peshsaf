<?php

namespace App\Livewire\Admin\Users;

use App\Models\Outlet;
use App\Models\Role;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Form extends Component
{
    public ?string $role;

    public ?int $outlet;

    public ?int $warehouse;

    public bool $isLimited;

    public User $user;

    public Collection $roles;

    public Collection $warehouses;

    public Collection $outlets;

    public function mount(User $user)
    {
        $this->roles      = Role::get();
        $this->warehouses = Warehouse::get();
        $this->outlets    = Outlet::get();
        $this->user       = $user;

        $this->role      = old('role', $this->user->role?->name);
        $this->outlet    = old('outlet', $this->user->outlet_id);
        $this->warehouse = old('warehouse', $this->user->outlet_id);
    }

    public function render()
    {
        return view('livewire.admin.users.form');
    }
}
