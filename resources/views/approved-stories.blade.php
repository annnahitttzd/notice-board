@extends('layouts.app')
<body class="body">
<div class="container">
    <div class="story-container">
                @foreach($approvedStories as $story)
                    <div class="story" id="story_{{$story->id}}">
                        <h3>{{ $story->title }}</h3>
                        {{$story->description}}
                       <button class="btn btn-primary"><a href="{{route('delete.story', ['id' => $story->id])}}">Delete</a></button>
                    </div>
                @endforeach
    </div>
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script type="module">



        function updateApprovedStories(){
        $.ajax({
            url: "{{route('approved.stories')}}",
            method:'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success:function (response){
                response.forEach(function (arr){
                    let id = arr.id;
                    let tagId = 'story_' + id;
                    if(!$('#' + tagId).length) {
                        $('.story-container').append(
                            '<div class="story" id="' + tagId + '">' +
                            '<h3>' + arr.title + '</h3>' +
                            arr.description +
                            '<button class="btn btn-primary"><a href="{{route('delete.story', ['id' => $story->id])}}">Delete</a></button>' +
                            '</div>'
                        )
                    }
                })
            },
            error: function (error) {
                console.error('Error fetching approved stories:', error);
            }
        })
    }
    setInterval(function () {
        updateApprovedStories();
    }, 5000);
</script>

</body>
