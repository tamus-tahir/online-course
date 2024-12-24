<x-backend>

    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="section card shadow p-3">

        <div class="table-responsive">
            <table class="table table-bordered" id="table-export">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Student</th>
                        <th scope="col">Income</th>
                        @if (account()->role == 'superadmin')
                            <th scope="col">Lecture</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ number_format(getCountStudentCourse($course->id)) }}</td>
                            <td>{{ number_format(getSumIncome($course->id)) }}</td>
                            @if (account()->role == 'superadmin')
                                <td>{{ $course->user->name }}</td>
                            @endif
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </section>

    @push('modal')
    @endpush

    @push('script')
        <script>
            new DataTable('#table-export', {
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        </script>
    @endpush

</x-backend>
