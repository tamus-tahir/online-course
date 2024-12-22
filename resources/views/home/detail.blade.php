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
    @endpush

    @push('script')
    @endpush

</x-frontend>
