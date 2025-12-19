@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-4">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.navigations.index') }}">Navigations</a>
            </li>
            <li class="breadcrumb-item active">
                Edit: {{ $navigation->title }}
            </li>
        </ol>
    </nav>

    {{-- ================= UPDATE FORM ================= --}}
    <form action="{{ route('admin.navigations.update', $navigation->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- 🔒 Preserve Parent (prevents disappearing bug) --}}
        <input type="hidden" name="parent_id" value="{{ $navigation->parent_id }}">

        <div class="row">

            {{-- ================= MAIN CONTENT ================= --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-warning fw-bold">
                            <i class="fas fa-edit me-2"></i> Edit Navigation
                        </h5>
                    </div>

                    <div class="card-body">

                        {{-- TITLE --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Navigation Title <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                name="title"
                                id="title"
                                class="form-control form-control-lg @error('title') is-invalid @enderror"
                                value="{{ old('title', $navigation->title) }}"
                                required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SLUG (READONLY) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">
                                URL Slug (Auto-generated)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">
                                    {{ url('/') }}/
                                </span>
                                <input type="text"
                                    id="slug"
                                    class="form-control bg-light"
                                    value="{{ $navigation->slug }}"
                                    readonly>
                            </div>
                            <small class="text-muted">
                                Changing title updates slug automatically.
                            </small>
                        </div>

                        {{-- SHORT CONTENT --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Short Description</label>
                            <textarea name="short_content"
                                rows="2"
                                class="form-control">{{ old('short_content', $navigation->short_content) }}</textarea>
                        </div>

                        {{-- MAIN CONTENT --}}
                        <div>
                            <label class="form-label fw-bold">Main Content</label>
                            <textarea name="main_content"
                                id="editor"
                                rows="10"
                                class="form-control">{{ old('main_content', $navigation->main_content) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ================= SIDEBAR ================= --}}
            <div class="col-lg-4">

                {{-- CONFIG --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-cogs me-2"></i> Configuration
                        </h6>
                    </div>

                    <div class="card-body">

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ $navigation->is_active ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="0" {{ !$navigation->is_active ? 'selected' : '' }}>
                                    Draft / Hidden
                                </option>
                            </select>
                        </div>

                        {{-- PAGE TYPE --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Page Template</label>
                            <select name="page_type_id" class="form-select">
                                <option value="">Standard Page</option>
                                @foreach($pageTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ $navigation->page_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- POSITION (DISPLAY ONLY) --}}
                        <div class="mb-3 p-3 bg-light rounded border">
                            <label class="form-label fw-bold text-secondary small">
                                Current Position
                            </label>
                            <div class="fs-4 fw-bold">
                                {{ $navigation->position }}
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-white border-0 d-grid gap-2 pb-4">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold">
                            <i class="fas fa-save me-1"></i> Update Navigation
                        </button>

                        <a href="{{ route('admin.navigations.index', ['parent' => $navigation->parent_id]) }}"
                            class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>

    {{-- ================= DANGER ZONE (SEPARATE FORM) ================= --}}
    <div class="card border-danger shadow-sm mt-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <span class="fw-bold text-danger">Danger Zone</span>

            <form action="{{ route('admin.navigations.destroy', $navigation->id) }}"
                method="POST"
                onsubmit="return confirm('Are you sure? This will delete all child navigations.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    Delete Navigation
                </button>
            </form>
        </div>
    </div>

</div>

{{-- ================= SCRIPT ================= --}}
<script>
    document.getElementById('title').addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');

        document.getElementById('slug').value = slug;
    });
</script>
@endsection