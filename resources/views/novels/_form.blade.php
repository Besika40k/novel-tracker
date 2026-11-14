{{-- Shared by create and edit. old() brings back what the user typed after a validation error;
     otherwise the novel's own value shows (empty on create, the saved value on edit). --}}

<div class="field">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $novel->title) }}">
    @error('title')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="field">
    <label for="author">Author</label>
    <input type="text" id="author" name="author" value="{{ old('author', $novel->author) }}">
    @error('author')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="field-row">
    <div class="field">
        <label for="origin">Origin</label>
        <select id="origin" name="origin">
            <option value="">Choose…</option>
            @foreach ($origins as $origin)
                <option value="{{ $origin }}" @selected(old('origin', $novel->origin) === $origin)>{{ ucfirst($origin) }}</option>
            @endforeach
        </select>
        @error('origin')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="">Choose…</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $novel->status) === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        @error('status')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="field-row">
    <div class="field">
        <label for="chapters_read">Chapters read</label>
        <input type="number" id="chapters_read" name="chapters_read" min="0" value="{{ old('chapters_read', $novel->chapters_read) }}">
        @error('chapters_read')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="total_chapters">Total chapters</label>
        <input type="number" id="total_chapters" name="total_chapters" min="1" value="{{ old('total_chapters', $novel->total_chapters) }}">
        @error('total_chapters')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="rating">Rating (0–10)</label>
        <input type="number" id="rating" name="rating" min="0" max="10" step="0.1" value="{{ old('rating', $novel->rating) }}">
        @error('rating')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="field checkbox">
    {{-- An unticked checkbox sends nothing, so the hidden 0 is sent first and a tick replaces it with 1 --}}
    <input type="hidden" name="is_favourite" value="0">
    <label>
        <input type="checkbox" name="is_favourite" value="1" @checked(old('is_favourite', $novel->is_favourite))>
        Favourite
    </label>
</div>
