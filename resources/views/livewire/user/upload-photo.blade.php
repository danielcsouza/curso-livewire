<div>
   <form action="#" method="POST" wire:submit.prevent="storagePhoto">
       <input type="file" wire:model="photo" id="photo" name="photo" class="form-control">
       @error('photo')
           <div class="alert alert-danger mt-2">
               {{ $message }}
           </div>
        @enderror
       <br>
       <input type="submit" value="Upload Foto" class="btn">
   </form>


</div>
