<x-frontend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mt-5">
        <!-- Section Title -->
        <div class=" section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>Filter Course</h2>
            <div>{{ $title }}</div>
        </div><!-- End Section Title -->
    </div>

    <footer id="footer" class="footer container " data-aos="fade-up" data-aos-delay="100">

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
                                    <a href="{{ route('home.detail', $course->slug) }}" class="btn-read-more">Detail</a>
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

    @push('modal')
    @endpush

    @push('script')
    @endpush

</x-frontend>
