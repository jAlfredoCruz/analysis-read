@extends('layouts.manager', ['book' => $book])

@section('content')
 <livewire:ilogic.form-ilogic :book="$book" />
@endsection
