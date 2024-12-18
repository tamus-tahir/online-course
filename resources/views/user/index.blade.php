<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">Create</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('user.show', $user) }}" class="btn btn-info">
                                    <i class='bx bx-show'></i>
                                </a>
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-warning">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('user.destroy', $user) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </section>

    @push('modal')
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                <form action="" method="post" id="form-delete">
                    @csrf
                    @method('delete')
                    <div class="modal-content">
                        <div class="modal-body">
                            Are You Sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, Delete It!</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    @endpush

    @push('script')
        <script>
            $('#example').on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })
        </script>
    @endpush

</x-backend>
