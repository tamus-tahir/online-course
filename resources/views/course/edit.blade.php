<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <form action="{{ route('course.update', $course) }}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            @method('put')

            <div class="row g-3 mb-3">

                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                            name="name" required value="{{ old('name', $course->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control tinymce-editor @error('description') is-invalid @enderror " id="description"
                            name="description" cols="30" rows="10">{!! old('description', $course->description) !!}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="price" class="form-label">
                            Price <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror " id="price"
                            name="price" required value="{{ old('price', $course->price) }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="trailer" class="form-label">
                            Trailer <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('trailer') is-invalid @enderror "
                            id="trailer" name="trailer" required value="{{ old('trailer', $course->trailer) }}">
                        @error('trailer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">
                            Category <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id" required>
                            <option value="">-- Chose Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($course->category_id == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cover" class="form-label">
                            Upload Cover
                            <span class="text-danger">(Type Image, Max Size 500kb)</span>
                        </label>
                        <input class="form-control" type="file" id="upload" name="cover">
                    </div>
                    <img src="{{ asset('storage/' . $course->cover) }}" alt="" class="w-100 rounded"
                        id="preview">

                </div>

            </div>

            <a href="{{ route('course.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </section>

    @push('modal')
    @endpush

    @push('script')
        <script>
            $('#upload').on('change', function(event) {
                $('#preview').attr('src', URL.createObjectURL(event.target.files[0]))
            })
        </script>
    @endpush

</x-backend>
