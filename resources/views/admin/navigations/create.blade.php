@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- BREADCRUMBS --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.navigations.index') }}">Navigations</a></li>
            @if(isset($parent))
            <li class="breadcrumb-item"><a href="{{ route('admin.navigations.index', ['parent' => $parent->id]) }}">{{ $parent->title }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">New Entry</li>
        </ol>
    </nav>

    <form action="{{ route('admin.navigations.store') }}" method="POST">
        @csrf
        {{-- Logical Parent ID --}}
        <input type="hidden" name="parent_id" value="{{ $parent->id ?? 0 }}">

        <div class="row">
            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary fw-bold">
                            <i class="fas fa-layer-group me-2"></i>
                            {{ isset($parent) ? "Add Sub-item to '{$parent->title}'" : 'Create Navigation' }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Navigation Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    placeholder="Enter menu title..." value="{{ old('title') }}" required autofocus>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- URL SLUG (LOCKED) --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold text-muted">URL Slug (Auto-generated)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted small border-end-0">
                                        <i class="fas fa-link me-2"></i> {{ url('/') }}/
                                    </span>
                                    <input type="text"
                                        name="slug"
                                        id="slug"
                                        class="form-control bg-light border-start-0 @error('slug') is-invalid @enderror"
                                        placeholder="slug-will-appear-here"
                                        value="{{ old('slug') }}"
                                        readonly
                                        tabindex="-1">
                                </div>
                                <div class="form-text">The slug is automatically locked to match the title for SEO consistency.</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Short Description</label>
                                <textarea name="short_content" rows="2" class="form-control" placeholder="Brief summary for SEO or hover effects...">{{ old('short_content') }}</textarea>
                            </div>

                            <div class="col-md-12 mb-0">
                                <label class="form-label fw-bold">Main Body Content</label>
                                <textarea name="main_content" id="editor" rows="8" class="form-control" placeholder="Write page content here...">{{ old('main_content') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-cog me-2"></i>Settings</h6>
                    </div>
                    <div class="card-body">

                        {{-- PARENT SELECTION --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Parent Navigation</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="0" {{ old('parent_id', $parent->id ?? 0) == 0 ? 'selected' : '' }}>Top-level (No Parent)</option>
                                @foreach($allNavigations as $navItem)
                                {{-- Prevent selecting self as parent --}}
                                @if(!isset($parent) || $navItem->id != $parent->id)
                                <option value="{{ $navItem->id }}" {{ old('parent_id') == $navItem->id ? 'selected' : '' }}>
                                    {{ $navItem->title }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- AUTO-INCREMENTED POSITION --}}
                        <div class="mb-4 p-3 bg-light rounded border">
                            <label class="form-label fw-bold text-secondary small uppercase">Sort Order</label>
                            <div class="d-flex align-items-center">
                                <input type="number" name="position" class="form-control form-control-sm border-0 bg-transparent fw-bold fs-5"
                                    value="{{ $nextPosition }}" readonly>
                                <span class="badge bg-info text-dark">Auto-assigned</span>
                            </div>
                            <p class="small text-muted mb-0 mt-1">This item will appear as #{{ $nextPosition }} in the list.</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Visibility Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Public (Published)</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Hidden (Draft)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Template Type</label>
                            <select name="page_type_id" class="form-select @error('page_type_id') is-invalid @enderror">
                                @foreach($pageTypes as $type)
                                <option value="{{ $type->id }}" {{ old('page_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('page_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 d-grid gap-2 pb-4">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-check-circle me-1"></i> Publish Navigation
                        </button>
                        <a href="{{ route('admin.navigations.index', ['parent' => $parent->id ?? 0]) }}" class="btn btn-outline-secondary">
                            Discard Changes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Slug Auto-generation Logic
    document.getElementById('title').addEventListener('input', function() {
        let slug = this.value.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection