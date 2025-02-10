@extends('layouts.manager', ['book' => $book])

@section('content')
<div class="flex- items-center justify-center">
    {!!  $desinformationText !!}
</div>
<div class="flex items-start justify-start mt-3">
    <livewire:redirect-button :route="route('desinformation', ['book' => $book->id])" />
</div>
@endsection
