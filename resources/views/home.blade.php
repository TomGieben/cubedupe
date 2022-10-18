@extends('layouts.app')
@section('content')
<style>
    body
    {
        height: 105vh;
        justify-content: center;
        justify-items: center;
        background-image: url("{{asset('img/welcome_background.png')}}");
        background-repeat: no-repeat;
        background-size: cover;
        object-fit: cover;
        overflow: hidden;
    }

    .welcome-card
    {
        position: absolute;
        top: 35%;
        left: 50%;
        transform: translate(-50%, -50%);
        flex-direction: column;
    }
    .blur
    {
        padding: 30px 40px;
        backdrop-filter: blur(5px);
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        color: rgb(255, 255, 255);
    }
    .input-box
    {
        position: relative;
        width: 100%;
    }

    h1
    {
        margin: 0 0 2rem 0;
    }
    .input-box input
    {
        width: 100%;
        padding: 10px;
        border: 1px solid rgb(255, 255, 255);
        background: transparent;
        border-radius: 5px;
        outline: none;
        color: #fff;
        font-size: 1.25em;
        letter-spacing: 0.1em;
    }
    .input-box span
    {
        position: absolute;
        left: 0;
        padding: 10px;
        pointer-events: none;
        font-size: 1.25em;
        color: #fff;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: 0.5s;
    }
    .input-box input:valid ~ span,
    .input-box input:focus ~ span
    {
        color: rgb(106,210,253); /* switch */
        transform: translateX(12px) translateY(-10px);
        font-size: 1em;
        letter-spacing: 0.2em;
        padding: 0 9px;
        background: #fff; /* switch */
        border-radius: 5px;
        backdrop-filter: blur(5px);
        /* border-left: 1px solid #fff; comment uit */
        /* border-right: 1px solid #fff; comment uit */
    }

    .home-submit-btn{
        margin-top: 0.5em;
        border: none;
        border-radius: 5px;
        outline: none;
        background: #fff;
        font-size: 1.25em;
        color: rgb(106, 210, 253);
        width: 100%;
        padding: 5px 12px;
        transition: 0.8s;
        cursor: pointer;
    }
    .home-submit-btn:hover{
        padding: 11px 25px;
        font-size: 1.25em;
        letter-spacing: 0.25em;
    }

    .continue-button
    {
        padding: 0.6em 0.8em;
        color: rgb(106, 210, 253);
        background: #fff;
        text-decoration: none;
        transition: 0.8s;
        border-top: 1px solid #fff;
        border-left: 1px solid #fff;
        border-bottom: 1px solid #fff;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .continue-button:hover{
        padding: 0.6em 2em;
        color: rgb(255, 255, 255);
        background: rgb(67, 255, 83);
        text-decoration: none;
        letter-spacing: 0.3em;
        text-shadow: 2px 2px #000;
        border-top: 1px solid rgb(67, 255, 83);
        border-left: 1px solid rgb(67, 255, 83);
        border-bottom: 1px solid rgb(67, 255, 83);
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    .delete-button
    {
        padding: 0.6em 0.8em;
        color: rgb(106, 210, 253);
        background: #fff;
        text-decoration: none;
        transition: 0.8s;
        text-align: end;
        border-top: 1px solid #fff;
        border-right: 1px solid #fff;
        border-bottom: 1px solid #fff;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        border-left: none;
    }
    .delete-button:hover
    {
        padding: 0.6em 2em;
        color: rgb(255, 255, 255);
        background: rgb(255, 50, 50);
        text-decoration: none;
        letter-spacing: 0.3em;
        text-shadow: 2px 2px #000;
        border-top: 1px solid rgb(255, 50, 50);
        border-right: 1px solid rgb(255, 50, 50);
        border-bottom: 1px solid rgb(255, 50, 50);
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
</style>
<div id="particles-js">
    <div class="welcome-card">
        <div class="blur">
            @if($world)
                <h2 class="text-center mb-2">You have an existing world</h2>
                <form action="{{ route('worlds.delete', [$world]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="row w-100 mx-0">
                        <a href="{{route('game')}}" class="continue-button col">Continue</a>
                        <button type="submit" class="delete-button col">Delete World</button>
                    </div>
                </form>
            @else
                <h2 class="text-center mb-2">Create your CubeDupe world!</h2>
                <form action="{{route('worlds.store')}}" method="post">
                    @csrf
                    <div class="input-box">
                        <input type="text" name="name" required="required" autocomplete="off">
                        <span>World name</span>
                    </div>
                    <div class="input-box">
                        <button type="submit" class="home-submit-btn">
                            Create world
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
@endsection
