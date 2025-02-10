@extends('layouts.manager')

@section('content')
<div class="flex- items-center justify-center">
    {!!  $argumentText !!}
</div>
<div class="flex items-start justify-start mt-3">
    <livewire:redirect-button :route="route('argument', ['book' => $book->id])" />
</div>
@endsection
