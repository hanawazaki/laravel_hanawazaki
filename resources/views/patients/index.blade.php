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
                <select name="hospital-filter" id="hospital-filter" required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="">-- Pilih Rumah Sakit --</option>
                  @foreach($hospitals as $hospital)
                  <option value="{{ $hospital->id }}" {{ old('id="hospital-filter"') == $hospital->id ? 'selected' : '' }}>
                    {{ $hospital->name }}
                  </option>
                  @endforeach
                </select>
                <a href="{{ route('patients.create') }}" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Tambah</a>
              </div>
            </div>
            <div id='patients-table-container'>
              @include('patients.table', ['patients' => $patients])
            </div>
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

    $('#hospital-filter').on('change', function() {
      filterPatients();
    });

    function filterPatients() {
      const hospitalId = $('#hospital-filter').val();

      // console.log(hospitalId);
      $.ajax({
        url: "{{ route('patients.filter') }}",
        type: 'GET',
        data: {
          hospital_id: hospitalId
        },
        success: function(response) {
          $('#patients-table-container').html(response);
        },
        error: function(xhr) {
          console.error('Error:', xhr);
        }
      });
    }

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