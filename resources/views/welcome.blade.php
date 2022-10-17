@extends('layouts.app')
@section('content')
<style>
    body{
    height: 105vh;
    background-image: url("{{asset('img/welcome_background.png')}}");
    background-repeat: no-repeat;
    background-size: cover;
    object-fit: cover;
    overflow: hidden;
    }

    #blur{
        position: absolute;
        width: 16rem;
        height: 20rem;
        top: calc(40% - 8rem);
        left: calc(50% - 10rem);
        backdrop-filter: blur(5px);
        /* border: 1px solid white; */
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        padding: 10px;
        color: rgb(255, 255, 255);
    }
</style>
<div id="particles-js">
    <div id="blur">
        @if ($hasworld)
            VERDERSPELEN
            <a href="{{route('home')}}">Naarwereld</a>
        @else
        <form action="{{route('worlds.store')}}" method="post">
            @csrf
            <div class="form-row">
                <input type="text" name="name" class="form-control">
                <button type="submit" class="btn btn-success col">
                    Create world
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
@endsection
