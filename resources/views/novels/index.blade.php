@extends('layouts.app')

@section('title', 'My novels')

@section('content')
    <h1>My novels</h1>

    {{-- GET, so the search and filter stay in the address and page links can keep them --}}
    <form method="GET" action="{{ route('novels.index') }}" class="search">
        <input type="text" name="search" value="{{ $searchTerm }}" placeholder="Search title or author">

        <select name="status">
            <option value="">All statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>

        <button type="submit" class="button">Search</button>
        <a href="{{ route('novels.index') }}" class="button secondary">Reset</a>
    </form>

    <p class="count">Showing {{ $novels->total() }} of {{ $totalNovels }} novels</p>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Origin</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Rating</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($novels as $novel)
                <tr>
                    <td>
                        {{ $novel->title }}
                        @if ($novel->is_favourite)
                            <span class="badge favourite">★ Favourite</span>
                        @endif
                    </td>
                    <td>{{ $novel->author }}</td>
                    <td>{{ ucfirst($novel->origin) }}</td>
                    <td><span class="badge status-{{ $novel->status }}">{{ ucfirst($novel->status) }}</span></td>
                    <td>
                        @if ($novel->chapters_read >= $novel->total_chapters)
                            <span class="badge caught-up">Caught up</span>
                        @else
                            {{ $novel->chapters_read }} / {{ $novel->total_chapters }}
                        @endif
                    </td>
                    <td>{{ $novel->rating }}</td>
                    <td class="actions">
                        <a href="{{ route('novels.edit', $novel) }}" class="button secondary">Edit</a>
                        <form method="POST" action="{{ route('novels.destroy', $novel) }}" onsubmit="return confirm('Delete this novel?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">No novels match your search.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- The plain list version of the page links; public/css/app.css styles it --}}
    {{ $novels->links('pagination::bootstrap-4') }}
@endsection
