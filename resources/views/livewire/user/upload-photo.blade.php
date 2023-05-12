<div class="w-10/12 mx-auto">
    <h1 class="text-4xl py-6 font-bold">Atualizar Foto do Perfil</h1>
    <form action="#" method="POST" wire:submit.prevent="storagePhoto" enctype="multipart/form-data"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8 m-8">
        @if ($photo)
            <div class="mb-4">
                <img src="{{ $photo->temporaryUrl() }}" style="max-width: 200px;">
            </div>
        @endif

        <div class="mb-4">
            <input type="file" wire:model="photo" id="photo" name="photo" class="form-control">
        </div>
        @error('photo')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
        <button type="submit" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded">Upload Foto</button>
    </form>

</div>
