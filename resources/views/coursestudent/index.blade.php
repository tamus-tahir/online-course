<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <div class="table-responsive">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Ammount</th>
                        <th scope="col">Status</th>
                        @if (account()->role == 'superadmin')
                            <th scope="col">Student</th>
                        @endif
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($courseStudents as $courseStudent)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $courseStudent->course->name }}</td>
                            <td>{{ number_format($courseStudent->ammount) }}</td>
                            <td>{!! $courseStudent->status == 0
                                ? '<span class="badge text-bg-warning">Waiting</span>'
                                : '<span class="badge text-bg-success">Approve</span>' !!}
                            </td>
                            @if (account()->role == 'superadmin')
                                <td>{{ $courseStudent->user->name }}</td>
                            @endif
                            <td>

                                @if ($courseStudent->status == 1)
                                    <a href="{{ route('course-student.show', $courseStudent) }}" class="btn btn-info">
                                        <i class='bx bx-show'></i>
                                    </a>
                                @endif


                                @if (account()->role == 'superadmin')
                                    <button type="button" class="btn btn-primary btn-proof" data-bs-toggle="modal"
                                        data-bs-target="#proofModal"
                                        data-proof="{{ asset('storage/' . $courseStudent->proof) }}">
                                        <i class='bx bx-image-alt'></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-route="{{ route('course-student.update', $courseStudent) }}">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif

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
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-body">
                            Are You Sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, Approve It!</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        {{-- proof --}}
        <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Proof</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" alt="" id="img-proof" class="w-100">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('script')
        <script>
            $('#example').on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })

            $('#example').on('click', '.btn-proof', function() {
                $('#img-proof').attr('src', $(this).data('proof'))
            })
        </script>
    @endpush

</x-backend>
