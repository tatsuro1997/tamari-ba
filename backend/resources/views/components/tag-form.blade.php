{{-- <div class="form-group row">
    {!! Form::label('tags', 'タグ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="{{ $errors->has('tags.*') ? 'is-invalid' : '' }}">
            @foreach ($tags as $key => $tag)
                <div class="form-check form-check-inline">
                    {!! Form::checkbox( 'tags[]', $key, null, ['class' => 'form-check-input', 'id' => 'tag'.$key]) !!}
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
</div> --}}

<div class="p-2 w-1/2 mx-auto">
    <div class="relative">
        <label for="image" class="leading-7 text-sm text-gray-600">タグ（複数可）</label>
        <div class="col-sm-10">
            <div class="{{ $errors->has('tags.*') ? 'is-invalid' : '' }}">
                @foreach ($tags as $key => $tag)
                    <div class="form-check form-check-inline">
                        {!! Form::checkbox( 'tags[]', $key, null, ['class' => 'form-check-input', 'id' => 'tag'.$key ]) !!}
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
