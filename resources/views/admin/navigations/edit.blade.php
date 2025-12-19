@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- BREADCRUMBS --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.navigations.index') }}">Navigations</a></li>
            <li class="breadcrumb-item active">Edit: {{ $navigation->title }}</li>
        </ol>
    </nav>

    <form action="{{ route('admin.navigations.update', $navigation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-warning fw-bold">
                            <i class="fas fa-edit me-2"></i> Edit Content
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- TITLE --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Navigation Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title', $navigation->title) }}" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- SLUG (READONLY) --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold text-muted">URL Slug (Protected)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted small border-end-0">
                                        <i class="fas fa-link me-2"></i> {{ url('/') }}/
                                    </span>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control bg-light border-start-0"
                                        value="{{ $navigation->slug }}" readonly tabindex="-1">
                                </div>
                                <div class="form-text text-info"><i class="fas fa-info-circle me-1"></i> Changing the title will automatically update this URL.</div>
                            </div>

                            {{-- SHORT CONTENT --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Short Description</label>
                                <textarea name="short_content" rows="2" class="form-control">{{ old('short_content', $navigation->short_content) }}</textarea>
                            </div>

                            {{-- MAIN CONTENT --}}
                            <div class="col-md-12 mb-0">
                                <label class="form-label fw-bold">Main Body Content</label>
                                <textarea name="main_content" id="editor" rows="10" class="form-control">{{ old('main_content', $navigation->main_content) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-sliders-h me-2"></i>Configuration</h6>
                    </div>
                    <div class="card-body">

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active', $navigation->is_active) == 1 ? 'selected' : '' }}>Published</option>
                                <option value="0" {{ old('is_active', $navigation->is_active) == 0 ? 'selected' : '' }}>Draft / Hidden</option>
                            </select>
                        </div>

                        {{-- PARENT NAVIGATION --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Parent Level</label>
                            <select name="parent_id" class="form-select">
                                <option value="0">Root (No Parent)</option>
                                @foreach($parents as $p)
                                <option value="{{ $p->id }}" {{ old('parent_id', $navigation->parent_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PAGE TYPE --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Template Type</label>
                            <select name="page_type_id" class="form-select">
                                <option value="">Standard Page</option>
                                @foreach($pageTypes as $type)
                                <option value="{{ $type->id }}" {{ old('page_type_id', $navigation->page_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- POSITION (READONLY FOR DISPLAY) --}}
                        <div class="mb-3 p-3 bg-light rounded border">
                            <label class="form-label fw-bold text-secondary small uppercase">Current Position</label>
                            <div class="d-flex align-items-center">
                                <input type="number" name="position" class="form-control form-control-sm border-0 bg-transparent fw-bold fs-5"
                                    value="{{ $navigation->position }}" readonly>
                                <span class="badge bg-secondary">Locked</span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-white border-0 d-grid gap-2 pb-4">
                        <button type="submit" class="btn btn-warning btn-lg shadow-sm fw-bold">
                            <i class="fas fa-save me-1"></i> Update Changes
                        </button>
                        <a href="{{ route('admin.navigations.index', ['parent' => $navigation->parent_id]) }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- DANGER ZONE --}}
                <div class="card border-danger shadow-sm opacity-75">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <span class="small text-danger fw-bold">Danger Zone</span>
                        <form action="{{ route('admin.navigations.destroy', $navigation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this? All children will also be deleted.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Keep Slug in sync with Title during editing
    document.getElementById('title').addEventListener('input', function() {
        let slug = this.value.toLowerCase()
            .trim()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection