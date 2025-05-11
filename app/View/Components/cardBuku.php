<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardBuku extends Component
{
    /**
     * Create a new component instance.
     */

    public $cover;
    public $judul;
    public $penulis;
    public $profile;
    public $genre;

    public function __construct($cover, $judul, $penulis, $profile, $genre)
    {
        $this->cover = $cover;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->profile = $profile;
        $this->genre = $genre;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-buku');
    }
}
