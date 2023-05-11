<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;
    public string $content = "";
    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->latest()->paginate(5); // evita o n+1
        //$tweets = Tweet::get(); // jeito errado de fazer com relação a performance
        return view('livewire.show-tweets', compact('tweets'));
    }


    public function create()
    {
        // dd($this->message);

        $this->validate();
        auth()->user()->tweets()->create([
            'content' => $this->content
        ]);

        $this->content = '';

    }

    public function like($tweetId)
    {
        $tweet = Tweet::find($tweetId);
        $tweet->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function deslike(Tweet $tweet)
    {
        $tweet->likes()->delete();
    }
}
