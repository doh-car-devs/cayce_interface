@extends('_interface.layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/icons/ICT-Logo.png')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">
                    {{auth()->user()->prefix.' '.auth()->user()->name_family.', '.auth()->user()->name .' '. auth()->user()->name_middle.' , '. auth()->user()->name_extension}}
                </h3>

                <p class="text-muted text-center">{{auth()->user()->designation}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Division</b> <a class="float-right">{{session('division.division_name')}} - {{session('division.division_abbr')}}</a><br>
                        <b>Division Head</b>    <a class="float-right">{{session('division_chief.prefix')}} {{session('division_chief.name_family')}}, {{session('division_chief.name')}} {{session('division_chief.name_middle')}} ,{{session('division_chief.name_extension')}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Section</b> <a class="float-right">{{session('section.section_name')}}</a><br>
                        <b>Section Head</b>    <a class="float-right">{{session('section_head.prefix')}} {{session('section_head.name_family')}}, {{session('section_head.name')}} {{session('section_head.name_middle')}} ,{{session('section_head.name_extension')}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Program</b> <a class="float-right">-</a>
                    </li>
                    <li class="list-group-item">
                        <b>Biometric ID</b> <a class="float-right">{{ auth()->user()->biometricID}}</a>
                    </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">About Me</h3>
            </div>
            <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                    -
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Philippines</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                    <span class="tag tag-danger">-</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @include('_interface.cards.wideCard',
        ['include_title' => 'User Profile','include_content' => '_interface.includes.empty',
        'button' => '', 'include_stat' => ''
        ])
    </div>
</div>
@endsection
