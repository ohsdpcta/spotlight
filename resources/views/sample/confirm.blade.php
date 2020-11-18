@extends('layouts.user')

@section('content')
<form method="post" action="complate">
    @csrf
    <div class="form-group">
        <p class="confirm-input">{!! nl2br(e($checkbox)) !!}</p>
    </div>
    
    @foreach($data->getAttributes() as $key => $value)
        @if(isset($value))
            {{-- @if(is_array($value))
                @foreach($value as $subValue)
                    <input name="{{ $key }}[]" type="hidden" value="{{ $subValue }}">
                @endforeach
            else
                <input name="{{ $key }}" type="hidden" value="{{ $value }}">
            @endif --}}
        @endif
    @endforeach
    <button type="submit" name="action" value="back"><a href="multidel">戻る</button>
    <button type="submit" name="action" value="submit"><a href="complate">削除</button>
</form>

@endsection
