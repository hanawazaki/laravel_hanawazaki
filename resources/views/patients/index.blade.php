<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Data Pasien') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="relative overflow-x-auto">
            <div class="flex justify-end items-center pb-4">
              <div class="flex justify-between gap-4 mb-4">
                <select name="hospital_id" id="hospital_id" required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="">-- Pilih Rumah Sakit --</option>
                  @foreach($hospitals as $hospital)
                  <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>
                    {{ $hospital->name }}
                  </option>
                  @endforeach
                </select>
                <a href="{{ route('patients.create') }}" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Tambah</a>
              </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    Nama Pasien
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Alamat
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Telepon
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Rumah Sakit
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($patients as $key => $patient)
                <tr id="patient-{{ $patient->id }}" class="bg-white border-b  border-gray-200">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$patient->name}}
                  </th>
                  <td class="px-6 py-4">
                    {{$patient->address}}
                  </td>
                  <td class="px-6 py-4">
                    {{$patient->phone_number}}
                  </td>
                  <td class="px-6 py-4">
                    {{$patient->hospital->name}}
                  </td>
                  <td class="">
                    <div class="flex px-6 py-4 gap-2">
                      <a href="{{ route('patients.edit', $patient->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ubah
                      </a>
                      <button type="button"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline delete-patient"
                        data-name="{{ $patient->name }}"
                        data-id="{{ $patient->id }}"
                        data-url="{{ route('patients.destroy', $patient->id) }}">

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
            {{ $patients->links() }}
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

    $(document).on('click', '.delete-patient', function() {
      const patientId = $(this).data('id');
      const patientName = $(this).data('name');
      const deleteUrl = $(this).data('url');

      Swal.fire({
        title: 'Hapus data pasien',
        text: "Anda yakin ingin menghapus data pasien: " + patientName,
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

                $('#patient-' + patientId).fadeOut(500, function() {
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
  });
</script>