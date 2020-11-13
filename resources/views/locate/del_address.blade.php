@extends('layouts/user')

@section('content')

<html>

    <form action="del_address" method="POST">
        @csrf
        <div>
            <label><input type="submit" value="削除"></label>
        </div>
    </form>

</html>
@endsection
