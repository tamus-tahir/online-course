<x-frontend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="contact" class="contact section container">

        <!-- Section Title -->
        <div class=" section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>{{ $title }}</h2>
            <div>{{ $course->name }}</div>
        </div><!-- End Section Title -->

        <div class="row g-3 mb-3">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="200">
                <iframe height="400" class="w-100 rounded" src="https://www.youtube.com/embed/{{ $course->trailer }}">
                </iframe>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card shadow p-3">
                    <table class="table">
                        <tr>
                            <td width="120">Release Date</td>
                            <td width="3">:</td>
                            <td>{{ $course->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>:</td>
                            <td>{{ $course->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>:</td>
                            <td>{{ number_format($course->price) }}</td>
                        </tr>
                        <tr>
                            <td>Lecture</td>
                            <td>:</td>
                            <td>{{ $course->user->name }}</td>
                        </tr>
                    </table>


                    @if (account())
                        <button type="button" class="btn btn-read-more" data-bs-toggle="modal"
                            data-bs-target="#subscribeModal">
                            Subscribe
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-read-more">
                            Subscribe
                        </a>
                    @endif

                </div>
            </div>

        </div>

        <div class="mb-3 card shadow p-3">
            {!! $course->description !!}
        </div>

        <p class="mt-3 fw-bold">Course Lessons:</p>
        <ul class="list-group">
            @foreach ($course->courseVideosOrder as $courseVideo)
                <li class="list-group-item">
                    {{ $loop->iteration . '. ' . $courseVideo->name }}
                </li>
            @endforeach
        </ul>

    </section>

    @push('modal')
        <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Subscribe Course</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <table class="table">
                            <tr>
                                <td width="160">Price</td>
                                <td width="3">:</td>
                                <td>Rp. {{ number_format($course->price) }}</td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td>BNI</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>Tamus Tahir</td>
                            </tr>
                            <tr>
                                <td>Account Number</td>
                                <td>:</td>
                                <td>07878508833</td>
                            </tr>
                        </table>


                        <form action="{{ route('course-student.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="proof" class="form-label">
                                    Upload Proof
                                    <span class="text-danger">(Type Image, Max Size 500kb)</span>
                                </label>
                                <input class="form-control" type="file" id="upload" name="proof">

                                <img src="{{ asset('backend/img/noimage-landscape.png') }}" alt=""
                                    class="w-100 rounded" id="preview">
                            </div>

                            <input type="hidden" name="slug" value="{{ $course->slug }}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('script')
        <script>
            $('#upload').on('change', function(event) {
                $('#preview').attr('src', URL.createObjectURL(event.target.files[0]))
            })
        </script>
    @endpush

</x-frontend>
