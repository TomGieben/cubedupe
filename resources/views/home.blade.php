@extends('layouts.app')
@section('content')
<style>
    body
    {
        height: 100vh;
        background-image: url("{{asset('img/welcome_background.png')}}");
        background-repeat: no-repeat;
        background-size: cover;
        object-fit: cover;
        overflow: hidden;
        align-items: center;
    }

    .welcome-card
    {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .blur
    {
        padding: 20px 40px;
        backdrop-filter: blur(5px);
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        color: rgb(255, 255, 255);
    }

    .input-box
    {
        position: relative;
        width: 18vw;
    }
    .input-box input
    {
        width: 100%;
        padding: 10px;
        border: 2px solid rgba(0, 51, 102, 0.25);
        background: transparent;
        border-radius: 5px;
        outline: none;
        color: #fff;
        font-size: 1em;
    }
    .input-box input span
    {
        position: absolute;
        left: 0;
        padding: 10px;
        pointer-events: none;
        font-size: 1em;
        color: rgba(0, 51, 102, 0.25);
        text-transform: uppercase;
    }
    .input-box input:valid ~ span
    {
        color: #5bc0de;
    }
    .input-box input:focus ~ span
    {
        color: #5bc0de;
    }
</style>
<div id="particles-js">
    <div class="welcome-card">
        <div class="blur">
            @if ($hasworld)
                VERDERSPELEN
                <a href="{{route('home')}}">Naarwereld</a>
            @else
            <form action="{{route('worlds.store')}}" method="post">
                @csrf
                <div class="input-box">
                    <input type="text" name="name" required="required">
                    <span>World name</span>
                </div>
                <button type="submit" class="">
                    Create world
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
@endsection
