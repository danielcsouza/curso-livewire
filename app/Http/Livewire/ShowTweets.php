<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class ShowTweets extends Component
{
    public string $content = "Apenas um teste";
    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->get(); // evita o n+1
        //$tweets = Tweet::get(); // jeito errado de fazer com relação a performance
        return view('livewire.show-tweets', compact('tweets'));
    }


    public function create()
    {
        // dd($this->message);

        $this->validate();

        Tweet::create([
            'user_id' => 1,
            'content' => $this->content
        ]);

        $this->content = '';

    }
}
