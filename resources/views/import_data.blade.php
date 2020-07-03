@extends('layouts.app')

@section('content')

    <form action="{{route('import.data')}}" method="post">
        @csrf
        <input type="text" name="type">
        <button type="submit">Submit</button>
    </form>


@endsection
