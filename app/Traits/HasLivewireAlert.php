<?php

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

trait HasLivewireAlert
{
    use LivewireAlert;

    public function destroyAlert($value = null)
    {
        if ($value === null) {
            $value = $this->mySelected;
        }

        $this->alert('warning', 'Delete this post?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'delete',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'value' => $value
            ]
        ]);
    }
    
    public function bulkDelete($model, $message = 'Bulk delete success')
    {
        if ($this->mySelected) {
            try {
                if (is_int($this->mySelected)) {
                    $this->mySelected = [$this->mySelected];
                }
                $model::whereIn('id', $this->mySelected)->delete();
                $this->mySelected = [];
                $this->selectedAll = false;
                $this->alert('success', $message);
            } catch (\Throwable $th) {
                dd($th);
                // $this->alert('error', $th);
            }
        } else {
            $this->alert('error', 'No records selected');
        }
        // if (auth()->user()->can('delete')) {
        // } else {
        //     $this->alert('error', 'You do not have permission');
        //     $this->mySelected = [];
        //     $this->selectedAll = false;
        // }
    }
}
