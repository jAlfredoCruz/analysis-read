@extends('layouts.manager', ['book' => $book])

@section('content')
<div class="flex- items-center justify-center">
    {!!  $incompleteText !!}
</div>
<div class="flex items-start justify-start mt-3">
    <livewire:redirect-button :route="route('incomplete', ['book' => $book->id])" />
</div>
@endsection
