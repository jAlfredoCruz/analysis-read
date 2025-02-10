@extends('layouts.manager', ['book' => $book])

@section('content')
 <livewire:ilogic.ilogics :book="$book" />
@endsection
