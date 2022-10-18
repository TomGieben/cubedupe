@extends('layouts.app')

@section('content')
<div class="mt-1">
    <div id="save">
        {{ $world->render() }}
    </div>
    @include('js/character')
    @include('js/break-blocks')
</div>
@endsection
