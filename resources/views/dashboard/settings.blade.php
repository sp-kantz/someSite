@extends('layouts.app')

@section('header_title', 'Settings')

@section('content')
    <div class="card-header">Settings</div>
    <div class="card-body">
        <div>
            <form method="POST" action="{{Route('saveSettings')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="theme">Dark Theme</label>
                    <input type="range" id="theme" name="theme" min="0" max="1" value="{{Auth::user()->theme}}" />
                
                    <hr>

                    <label for="profile_image">Profile Photo</label>
                    <img  src="/storage/profile_images/thumbnails/{{Auth::user()->profile_image}}" />
                    <input type="file" name="profile_image" />
                </div>
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
    </div>
@endsection