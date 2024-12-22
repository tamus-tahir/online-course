<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('course.create') }}" role="button">Create</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        @if (account()->role == 'superadmin')
                            <th scope="col">Lecture</th>
                        @endif
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ number_format($course->price) }}</td>
                            <td>{{ $course->category->name }}</td>
                            @if (account()->role == 'superadmin')
                                <td>{{ $course->user->name }}</td>
                            @endif
                            <td class="text-nowrap">
                                <a href="{{ route('course.show', $course) }}" class="btn btn-info">
                                    <i class='bx bx-show'></i>
                                </a>
                                <a href="{{ route('coursevideo.show', $course) }}" class="btn btn-success">
                                    <i class='bx bx-list-plus'></i>
                                </a>
                                <a href="{{ route('course.edit', $course) }}" class="btn btn-warning">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('course.destroy', $course) }}">
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
