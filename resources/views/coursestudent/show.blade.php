<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">
        <div class="mb-3">
            <a href="{{ route('course-student.index') }}" class="btn btn-warning">Back</a>
        </div>

        <table class="table">
            <tr>
                <td width="120">Name</td>
                <td width="3">:</td>
                <td>{{ $courseStudent->course->name }}</td>
            </tr>
            <tr>
                <td>Category</td>
                <td>:</td>
                <td>{{ $courseStudent->course->category->name }}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>:</td>
                <td>{{ number_format($courseStudent->ammount) }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>:</td>
                <td>{!! $courseStudent->course->description !!}</td>
            </tr>
        </table>

        <ul class="list-group">
            <li class="list-group-item">
                <a href="https://www.youtube.com/watch?v={{ $courseStudent->course->trailer }}" target="_blank">0.
                    Trailer</a>
            </li>

            @foreach ($courseStudent->course->courseVideosOrder as $courseVideo)
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
