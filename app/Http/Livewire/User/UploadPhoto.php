<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UploadPhoto extends Component
{
    public $photo;

    use WithFileUploads;

    public function storagePhoto()
    {
        $this->validate([
                            'photo' => 'required|image|max:1024'
                        ]);

        $nameFile = Str::slug(auth()->user()->name) . '-' . auth()->user()->id;
        $extension = $this->photo->getClientOriginalExtension();
        $path = $this->photo->storeAs('users', $nameFile . '.' . $extension);

        if ($path)
        {
            auth()->user()->update([
                                       'profile_photo_path' => $path
                                   ]);
        }

        return redirect()->route('tweets.home');
    }

    public function render()
    {
        return view('livewire.user.upload-photo');
    }
}
