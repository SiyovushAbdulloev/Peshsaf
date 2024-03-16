<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Form extends Component
{
    public ?string $role;
    public ?int $outlet;
    public ?int $warehouse;

    public User $user;

    public ?string $roleSelect;

    public Collection $roles;
    public Collection $warehouses;
    public Collection $outlets;

    public function render()
    {
        return view('livewire.admin.users.form');
    }

    public function mount(
        $role,
        $outlet,
        $warehouse,
        $roles,
        $user,
        $warehouses,
        $outlets
    )
    {
        $this->role = $role;
        $this->roleSelect = $role;
        $this->warehouse = $warehouse;
        $this->outlet = $outlet;
        $this->roles = $roles;
        $this->warehouses = $warehouses;
        $this->outlets = $outlets;
        $this->user = $user;
    }

    public function setRole()
    {
        $this->roleSelect = $this->role;
    }
}
