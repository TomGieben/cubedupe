@extends('layouts.app')
@section('content')
<style>
    body{
    height: 100vh;
    background-image: url("{{asset('img/welcome_background.png')}}");
    background-repeat: no-repeat;
    background-size: cover;
    object-fit: cover;
    overflow: hidden;
    }
</style>
<div id="particles-js">
    <div class="container">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
@endsection
