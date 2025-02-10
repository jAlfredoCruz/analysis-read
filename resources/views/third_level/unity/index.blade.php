@extends('layouts.manager', ['book' => $book])

@section('content')
<div>
    <livewire:unity.unity :book="$book" />
</div>
@endsection
