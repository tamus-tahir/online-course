<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data" id="form">
            @csrf

            <div class="row g-3 mb-3">

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">
                            Upload Avatar
                            <span class="text-danger">(Type Image, Max Size 500kb)</span>
                        </label>
                        <input class="form-control" type="file" id="upload" name="avatar">
                    </div>
                    <img src="{{ asset('backend/img/noprofil.png') }}" alt="" class="w-100 rounded"
                        id="preview">
                </div>

                <div class="col-md-8">
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
                        <label for="email" class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror " id="email"
                            name="email" required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password <span class="text-danger">* (Min 8 characther)</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror "
                            id="password" name="password" required minlength="8">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="passwordconfirm" class="form-label">
                            Passwordconfirm <span class="text-danger">* (Min 8 characther)</span>
                        </label>
                        <input type="password" class="form-control @error('passwordconfirm') is-invalid @enderror "
                            id="passwordconfirm" name="passwordconfirm" required data-parsley-equalto="#password">
                        @error('passwordconfirm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">
                            Role <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                            required>
                            <option value="">-- Chose Role --</option>
                            <option value="superadmin" @selected(old('role') == 'superadmin')>Superadmin</option>
                            <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                        </select>

                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

            </div>

            <a href="{{ route('user.index') }}" class="btn btn-warning">Back</a>
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
