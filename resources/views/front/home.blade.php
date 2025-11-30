@extends('front.layouts.app')

@section('title', __('Home'))

@section('content')
<div class="mainContainer">
    
    <!-- تأثير مؤشر الماوس -->
    <div class="cursorEffect" id="cursorEffect"></div>


    <!-- Hero Section -->
    @include('front.sections.hero')

    <!-- Skills Section -->
    @include('front.sections.skills')

    <!-- Projects Section -->
    @include('front.sections.projects-home')

    <!-- Experience Section -->
    @include('front.sections.experience')

    @include('front.sections.contact')
</div>



    <link href="{{ asset('front/css/front.css') }}" rel="stylesheet">


@endsection