<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data" id="form">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">
                    Name <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                    name="name" required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">
                    Upload Icon
                    <span class="text-danger">(Type Image, Max Size 500kb)</span>
                </label>
                <input class="form-control" type="file" id="upload" name="icon">

                <img src="{{ asset('backend/img/noimage-landscape.png') }}" alt="" class="w-25 rounded"
                    id="preview">
            </div>


            <a href="{{ route('category.index') }}" class="btn btn-warning">Back</a>
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
