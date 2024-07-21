<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{

    public $number = 9;
    public function render()
    {
        return view('livewire.test');
    }
    public function increment(){
        $this->number++;
    }
    public function decrement(){
        $this->number--;
    }
}
