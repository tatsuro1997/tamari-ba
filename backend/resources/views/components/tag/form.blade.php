@php
   if(isset($bike)){
        $rTag = $bike->tags;
   }
   if(isset($road)){
        $rTag = $road->tags;
   }
@endphp
@if (!isset($rTag))
    <div class="p-2 w-1/2 mx-auto">
        <div class="relative">
            <label for="image" class="leading-7 text-sm text-gray-600">タグ（複数可）</label>
            <div class="col-sm-10">
                <div class="{{ $errors->has('tags.*') ? 'is-invalid' : '' }}">
                    @foreach ($tags as $key => $tag)
                        <div class="form-check form-check-inline">
                            <input id="tag{{$key}}" type="checkbox" name="tags[]" value="{{$key}}" @if(explode('.', Route::currentRouteName())[2]==='edit') @if($key===$rTag->first()->pivot->tag_id)checked @endif @endif>
                            <label class="form-check-label" for="tag{{$key}}">{{ $tag }}</label>
                        </div>
                    @endforeach
                </div>
                @error('tags.*')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>
@endif

