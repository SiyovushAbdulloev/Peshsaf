<?php

namespace App\Livewire;

use App\Actions\DeleteFileAction;
use App\Models\File;
use Illuminate\Support\Collection;
use Livewire\Component;

class Files extends Component
{
    public ?Collection $files;

    public function mount(Collection $files): void
    {
        $this->files = $files;
    }

    public function render()
    {
        return view('livewire.files');
    }

    public function delete(File $file): void
    {
        app(DeleteFileAction::class)->execute($file);

        session()->flash('success', 'Файл успешно удален');

        $this->redirect(url()->previous());
    }
}
