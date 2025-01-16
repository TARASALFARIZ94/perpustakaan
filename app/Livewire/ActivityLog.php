<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\View;

class ActivityLog extends Component
{
    public $logs = []; // Contoh data logs

    public function mount()
    {
        // Set the page title dynamically
        View::share('title', 'Activity Log');
        
        // Load initial logs (dapat diambil dari database)
        $this->logs = [
            ['date' => '2025-01-10', 'action' => 'Login', 'details' => 'Successful login'],
            ['date' => '2025-01-11', 'action' => 'Update Profile', 'details' => 'Updated profile details'],
        ];
    }

    public function render()
    {
        return view('livewire.activity-log');
    }
}