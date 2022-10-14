@extends('layouts.app')

@section('content')
<div class="mt-1">
    {{ $world->render() }}
    @include('js/character')
</div>
@endsection
