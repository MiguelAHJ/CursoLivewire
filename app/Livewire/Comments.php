<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{

    public $comments = [
        'Artículo 1 creado',
        'Artículo 2 creado',
        'Artículo 3 creado',
    ];

    #[On('post-created')]
    public function addComment(){
        array_unshift($this->comments, 'Nuevo artículo creado');
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
