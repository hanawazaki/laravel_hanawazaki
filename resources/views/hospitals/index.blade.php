<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Data Rumah Sakit') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="relative overflow-x-auto">
            <div class="flex justify-end items-center pb-4">
              <a href="{{ route('hospitals.create') }}" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Tambah</a>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    Nama RUmah sakit
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Alamat
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Telepon
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Email
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($hospitals as $key => $hospital)
                <tr id="hospital-{{ $hospital->id }}" class="bg-white border-b  border-gray-200">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$hospital->name}}
                  </th>
                  <td class="px-6 py-4">
                    {{$hospital->address}}
                  </td>
                  <td class="px-6 py-4">
                    {{$hospital->phone_number}}
                  </td>
                  <td class="px-6 py-4">
                    {{$hospital->email}}
                  </td>
                  <td class="">
                    <div class="flex px-6 py-4 gap-2">
                      <a href="{{ route('hospitals.edit', $hospital->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ubah
                      </a>
                      <button type="button"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline delete-hospital"
                        data-name="{{ $hospital->name }}"
                        data-id="{{ $hospital->id }}"
                        data-url="{{ route('hospitals.destroy', $hospital->id) }}">

                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">tidak ada data</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center mt-3">
            {{ $hospitals->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

@vite('resources/js/app.js')
<script>
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click', '.delete-hospital', function() {
      const hospitalId = $(this).data('id');
      const hospitalName = $(this).data('name');
      const deleteUrl = $(this).data('url');

      Swal.fire({
        title: 'Hapus Data rumah sakit',
        text: "ANda yakin ingin menghapus data " + hospitalName,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: {
              '_method': 'DELETE',
              '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if (response.success) {
                Swal.fire(
                  'Deleted!',
                  response.message,
                  'success'
                );

                $('#hospital-' + hospitalId).fadeOut(500, function() {
                  $(this).remove();
                });
              } else {
                Swal.fire(
                  'Error!',
                  response.message || 'Something went wrong.',
                  'error'
                );
              }
            },
            error: function(xhr) {
              console.error('Error:', xhr);
              Swal.fire(
                'Error!',
                'Failed to delete ',
                'error'
              );
            }
          });
        }
      });
    })

  })
</script>