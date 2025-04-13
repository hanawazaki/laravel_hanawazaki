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
<div class="flex justify-center mt-3">
  {{ $patients->links() }}
</div>