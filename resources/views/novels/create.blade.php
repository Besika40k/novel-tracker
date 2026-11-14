@extends('layouts.app')

@section('title', 'Add a novel')

@section('content')
    <h1>Add a novel</h1>

    <form method="POST" action="{{ route('novels.store') }}" class="novel-form">
        @csrf

        @include('novels._form')

        <div class="form-buttons">
            <button type="submit" class="button">Add novel</button>
            <a href="{{ route('novels.index') }}" class="button secondary">Cancel</a>
        </div>
    </form>
@endsection
