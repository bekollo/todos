<?php

namespace App\Http\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public function admin($id){
        User::find($id)->update([
            'status'=> true
        ]);
        $this->emit('saved');
    }
    public function user($id){
        User::find($id)->update([
            'status'=> false
        ]);
        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.backend.users', [
            'users'=>User::paginate(5)
        ]);
    }
}
