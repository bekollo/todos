<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;

class Todos extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalDeleteConfirmVisible = false;

    public $todoId;
    public $title;

    protected $rules = [
        'title' =>'required'
    ];

    public function mount() {
        $this->resetPage();
    }

    public function showModalForm() {
        $this->reset();
        $this->resetValidation();
        $this->modalFormVisible = true;
    }

    public function save() {
        $this->validate();
        Todo::create($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
    }
    public function showUpdateModalForm($id) {
        $this->reset();
        $this->resetValidation();
        $this->todoId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }
    public function update() {
        Todo::find ($this->todoId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('updated');
    }
    public function justDoIt($id){
        Todo::find($id)->update([
            'status'=> true
        ]);

    }

    public function modelData() {
        return [
            'title'=>$this->title
        ];
    }
    public function loadModel() {
        $todo = Todo::find($this->todoId);
        $this->title = $todo->title;
    }
    public function showModalDeleteConfirm($id){
        $this->todoId = $id;
        $this->modalDeleteConfirmVisible = true;
    }
    public function delete() {
        Todo::destroy($this->todoId);
        $this->modalDeleteConfirmVisible = false;
        $this->emit('deleted');
    }
    public function render()
    {
        return view('livewire.frontend.todos', [
            'todos'=>Todo::paginate(5)
        ]);
    }
}
