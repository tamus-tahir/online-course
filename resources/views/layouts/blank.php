<x-backend>

  <x-slot:title>{{ $title }}</x-slot:title>

  <section class="section card shadow p-3">
    <p>Content</p>
  </section>

  @push('modal')
  @endpush

  @push('script')
  @endpush

</x-backend>