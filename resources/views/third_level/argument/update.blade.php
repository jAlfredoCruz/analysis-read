@extends('layouts.manager')

@section('content')
    <livewire:argument.form-argument :book="$book" :argument="$argument" />
@endsection
