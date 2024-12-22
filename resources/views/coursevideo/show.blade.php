<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">
        <div class="mb-3">
            <a class="btn btn-warning" href="{{ route('course.index') }}" role="button">Back</a>
            <a class="btn btn-primary" href="{{ route('coursevideo.create', $course) }}" role="button">Create</a>
            <a class="btn btn-dark" href="{{ asset('backend/files/format-course-video.xlsx') }}" role="button">Download
                Format</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#excelModal">
                Import Excel
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Video</th>
                        <th scope="col">Order</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($course->courseVideos as $courseVideo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $courseVideo->name }}</td>
                            <td>{{ $courseVideo->video }}</td>
                            <td>{{ $courseVideo->order }}</td>
                            <td>
                                <a href="https://www.youtube.com/watch?v={{ $courseVideo->video }}"
                                    class="btn btn-success" target="_blank">
                                    <i class='bx bxl-youtube'></i>
                                </a>
                                <a href="{{ route('coursevideo.edit', $courseVideo) }}" class="btn btn-warning">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-route="{{ route('coursevideo.destroy', $courseVideo) }}">
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

        <div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('coursevideo.import') }}" enctype="multipart/form-data" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload file according to the format</label>
                                <input class="form-control" type="file" id="formFile" name="excel">
                            </div>

                            <input type="hidden" name="course_id" value="{{ $course->id }}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>

                        </form>
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
        </script>
    @endpush

</x-backend>
