<x-frontend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Category Section -->
    <section id="features" class="features section">

        <div class="container">

            <div class="row gy-4 justify-content-center">
                @php
                    $delay = 100;
                @endphp
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                        <div class="features-item">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="" width="30">
                            <h3><a href="" class="stretched-link ms-2">{{ $category->name }}</a></h3>
                        </div>
                    </div>
                    @php
                        $delay += 100;
                    @endphp
                @endforeach
            </div>

        </div>

    </section>
    <!-- /Category Section -->

    <footer id="footer" class="footer container ">

        <div class="footer-newsletter">
            <form>
                <div class="newsletter-form">
                    <input type="text" name="search">
                    <input type="submit" value="Search">
                </div>
            </form>
        </div>
    </footer>

    <!-- Course Section -->
    <section id="team" class="team section">

        <div class="container">

            <div class="row gy-5 justify-content-center">
                @php
                    $delay = 100;
                @endphp

                @foreach ($courses as $course)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                        <div class="member">
                            <div class="pic">
                                <img src="{{ asset('storage/' . $course->cover) }}" class="img-fluid w-100"
                                    alt="" height="300">
                            </div>
                            <div class="member-info">
                                <h4>{{ $course->name }}</h4>
                                <span>Rp. {{ number_format($course->price) }}</span>
                                <div class="text-end">
                                    <a href="{{ route('home.detail', $course->slug) }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $delay += 100;
                    @endphp
                @endforeach

                {{ $courses->links() }}

            </div>

        </div>

    </section><!-- /Course Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-emoji-smile"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $countCategory }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Category</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-journal-richtext"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $countCourse }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Course</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-headset"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $countLecture }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Lecture</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="bi bi-people"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $countStudent }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Student</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    @push('modal')
    @endpush

    @push('script')
    @endpush

</x-frontend>
