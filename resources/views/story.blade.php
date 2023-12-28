@extends('layouts.app')
<body>
<h4 class=" text-primary font-weight-bold">{{$adminEmail}}</h4>
<div class="container mt-5">
    <button class="btn btn-primary"><a href="{{route('approved.stories')}}" class="approved_stories">Approved stories</a></button>
    <button class="btn btn-primary"><a href="{{route('logout.user')}}" class="approved_stories">Log out</a></button>

    <h2 class="mb-4">Create a story</h2>
   <form method="post" action="{{route('stories.store')}}">
        @csrf
        <div class="form-group " >
            <label for="postTitle">Title:</label>
            <input type="text" name="title" class="form-control" id="postTitle" placeholder="Enter post title">
        </div>

        <div class="form-group">
            <label for="postDescription">Description:</label>
            <textarea class="form-control" name="description" id="postDescription" rows="3" placeholder="Enter post description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary"> Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
