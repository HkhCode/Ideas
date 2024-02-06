@extends('layout.layout')
@section('title', 'Terms')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus culpa distinctio obcaecati reprehenderit
                accusantium. Saepe eos eaque sit voluptatibus sequi ad cum odio alias at blanditiis fugit, commodi minima
                quisquam
                nemo molestias, obcaecati possimus iure, soluta illo debitis dolor sed perspiciatis repellat! Sed, sequi
                natus harum
                magni expedita in quibusdam est optio cum placeat dolores maxime rerum? Ut esse quibusdam iste ratione
                doloribus
                beatae laudantium pariatur id distinctio, at praesentium! Debitis nihil illo numquam quae consequatur,
                molestias
                maiores optio quibusdam perferendis quod corrupti repudiandae illum sapiente voluptate quis vero aliquam
                distinctio,
                ad soluta temporibus dolores incidunt impedit ducimus! Eius, similique!
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
