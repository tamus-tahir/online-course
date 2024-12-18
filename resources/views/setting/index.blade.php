<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <form action="{{ route('setting.update', $setting) }}" method="post" enctype="multipart/form-data" id="form">
            @csrf('')
            @method('put')

            <div class="row g-3 mb-3">

                <div class="col-md-4">
                    <label for="app_name" class="form-label">
                        App Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('app_name') is-invalid @enderror " id="app_name"
                        name="app_name" required value="{{ old('app_name', $setting->app_name) }}">
                    @error('app_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label for="login_title" class="form-label">
                        Login Title <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('login_title') is-invalid @enderror "
                        id="login_title" name="login_title" required
                        value="{{ old('login_title', $setting->login_title) }}">
                    @error('login_title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="copyright" class="form-label">
                        Copyright <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('copyright') is-invalid @enderror " id="copyright"
                        name="copyright" required value="{{ old('copyright', $setting->copyright) }}">
                    @error('copyright')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="keywords" class="form-label">
                        Keywords
                    </label>
                    <input type="text" class="form-control @error('keywords') is-invalid @enderror " id="keywords"
                        name="keywords" value="{{ old('keywords', $setting->keywords) }}">
                    @error('keywords')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">
                        Description
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror " id="description" name="description"
                        cols="30" rows="3">{{ old('description', $setting->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="icon" class="form-label">
                            Upload Icon
                            <span class="text-danger">(Type Image, Max Size 500kb)</span>
                        </label>
                        <input class="form-control" type="file" id="upload" name="icon">
                    </div>
                    <img src="{{ $setting->icon ? asset('storage/' . $setting->icon) : asset('backend/img/logo.png') }}"
                        alt="" class="w-50" id="preview">
                </div>

            </div>


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
