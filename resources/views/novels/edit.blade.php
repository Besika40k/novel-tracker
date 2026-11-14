@extends('layouts.app')

@section('title', 'Edit ' . $novel->title)

@section('content')
    <h1>Edit “{{ $novel->title }}”</h1>

    {{-- Browsers only send GET and POST; @method('PUT') tells Laravel this is an update --}}
    <form method="POST" action="{{ route('novels.update', $novel) }}" class="novel-form">
        @csrf
        @method('PUT')

        @include('novels._form')

        <div class="form-buttons">
            <button type="submit" class="button">Save changes</button>
            <a href="{{ route('novels.index') }}" class="button secondary">Cancel</a>
        </div>
    </form>
@endsection
