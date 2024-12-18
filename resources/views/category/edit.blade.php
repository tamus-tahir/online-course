<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <form action="{{ route('category.update', $category) }}" method="post" enctype="multipart/form-data"
            id="form">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">
                    Name <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                    name="name" required value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('category.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </section>

    @push('modal')
    @endpush

    @push('script')
    @endpush

</x-backend>
