<div>
    Show Tweets

    <form method="post" wire:submit.prevent="create">
        <input type="text" name="content" id="content" wire:model="content">
        @error('content') {{$message}} @enderror
        <button type="submit">Criar Tweet</button>
    </form>
    <hr>

    @foreach($tweets as $tweet)
        <div class="flex">
            <div class="w-2/8">
                @if ($tweet->user->photo)
                    <img src="{{url("storage/{$tweet->user->getImageAtrribute()}")}}" alt="{{$tweet->user->name}}"
                         class="rounded-full h-8 w-8">
                @else
                    <img src="{{url('imgs/no-image.png')}}" alt="{{$tweet->user->name}}" class="rounded-full h-8 w-8">
                @endif
            </div>
            <div class="w-6/8">
                {{$tweet->user->name}} - {{$tweet->content}}
                {{$tweet->likes->count()}} Curtidas
                @if($tweet->likes->count())
                    <a href="#" wire:click.prevent="deslike({{$tweet->id}})">Descurtir</a>
                @else
                    <a href="#" wire:click.prevent="like({{$tweet->id}})">Curtir</a>
                @endif

            </div>
        </div>
        <br>
    @endforeach

    <hr>
    {{$tweets->links()}}
</div>
