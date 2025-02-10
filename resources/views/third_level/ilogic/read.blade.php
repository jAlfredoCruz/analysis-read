@extends('layouts.manager', ['book' => $book])

@section('content')
<div class="flex- items-center justify-center">
    {!!  $ilogicText !!}
</div>
<div class="flex items-start justify-start mt-3">
    <livewire:redirect-button :route="route('ilogic', ['book' => $book->id])" />
</div>
@endsection
