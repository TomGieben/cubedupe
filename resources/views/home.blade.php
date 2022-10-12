@extends('layouts.app')

@section('content')
<div class="mt-4">
    {{ $world->render() }}
    {{-- @foreach ($blocks as $block)
        {{ $block->render() }}
    @endforeach --}}
</div>
@endsection
