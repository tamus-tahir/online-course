<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">
        <div class="mb-3">
            <a href="{{ route('course.index') }}" class="btn btn-warning">Back</a>
        </div>

        <table class="table">
            <tr>
                <td width="120">Name</td>
                <td width="3">:</td>
                <td>{{ $course->name }}</td>
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
                <td>Category</td>
                <td>:</td>
                <td>{!! $course->description !!}</td>
            </tr>
            <tr>
                <td>Cover</td>
                <td>:</td>
                <td>
                    <img src="{{ asset('storage/' . $course->cover) }}" alt="" class="w-25">
                </td>
            </tr>
        </table>

        <ul class="list-group">
            <li class="list-group-item">
                <a href="https://www.youtube.com/watch?v={{ $course->trailer }}" target="_blank">0. Trailer</a>
            </li>

            @foreach ($course->courseVideosOrder as $courseVideo)
                <li class="list-group-item">
                    <a href="https://www.youtube.com/watch?v={{ $courseVideo->video }}"
                        target="_blank">{{ $loop->iteration . '. ' . $courseVideo->name }}</a>

                </li>
            @endforeach

        </ul>
    </section>

    @push('modal')
    @endpush

    @push('script')
    @endpush

</x-backend>
