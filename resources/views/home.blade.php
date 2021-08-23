@extends('layouts.app')

@section('content')
<div class="container">
    @include('_interface.includes.messages')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{$data['division']->division_abbr}} - {{$data['section']->section_abbr}} Dashboard
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    {{-- {{session('user_links')}} --}}
                    <br>
                        <strong>Links</strong>
                        @foreach ($data['links'] as $link)
                        <br>
                            {{$link->name}}
                        @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
