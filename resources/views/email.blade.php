@extends('layouts.app')


<h3>{{$story->title}}</h3>
<p>{{$story->description}}</p>
<a href="{{ route('approve.story', ['approve_token' => $story->approve_token]) }}">Approve this story</a>

