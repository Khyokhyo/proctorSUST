@extends('layouts.app')

@section('content')
<!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
            	<div class="intro-heading">{{Auth::user()->username}}</div>
                <div class="intro-lead-in">Welcome to your account</div>
            </div>
        </div>
    </header>

@endsection