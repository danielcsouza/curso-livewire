<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;
    public string $content = "";
    protected $rules = [
        'content' => 'required|min:3|max:140'
    ];
    protected $messages = [
        'content.required' => 'O campo de tweet é obrigatório',
        'content.min' => 'O campo de tweet precisa ter no mínimo 3 caracteres',
        'content.max' => 'O campo de tweet precisa ter no máximo 255 caracteres'
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

        if (!Auth::check())
        {
            return redirect()->route('login');
        }

        $this->validate();
        auth()->user()->tweets()->create([
            'content' => $this->content
        ]);

        $this->content = '';

    }

    public function like($tweetId)
    {
        if (!Auth::check())
        {
            return redirect()->route('login');
        }

        $tweet = Tweet::find($tweetId);
        $tweet->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function deslike(Tweet $tweet)
    {
        if (!Auth::check())
        {
            return redirect()->route('login');
        }

        $tweet->likes()->delete();
    }
}
