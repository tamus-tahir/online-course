<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <form action="{{ route('coursevideo.update', $courseVideo) }}" method="post" id="form">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">
                    Name <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                    name="name" required value="{{ old('name', $courseVideo->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="video" class="form-label">
                        ID Video <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('video') is-invalid @enderror " id="video"
                        name="video" required value="{{ old('video', $courseVideo->video) }}">
                    @error('video')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="order" class="form-label">
                        Order <span class="text-danger">*</span>
                    </label>
                    <input type="integer" class="form-control @error('order') is-invalid @enderror " id="order"
                        name="order" required value="{{ old('order', $courseVideo->order) }}">
                    @error('order')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <a href="{{ route('coursevideo.show', $courseVideo->course_id) }}" class="btn btn-warning">Back</a>
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