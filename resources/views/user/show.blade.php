<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <div class="mb-3">
            <a href="{{ route('user.index') }}" class="btn btn-warning">Back</a>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('backend/img/noprofil.png') }}"
                    alt="Avatar" class="w-100 rounded">
            </div>
            <div class="col-md-9">
                <table class="table">
                    <tr>
                        <td width="120">Name</td>
                        <td width="3">:</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td>:</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <td>Updated</td>
                        <td>:</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </section>

    @push('modal')
    @endpush

    @push('script')
    @endpush

</x-backend>
