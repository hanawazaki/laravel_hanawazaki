<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tambah Pasien') }}
    </h2>
  </x-slot>

  <form action="{{ route('patients.store') }}" method="POST">
    @csrf
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-4">Tambah Pasien</h1>
            <div class="mb-4">
              <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Pasien:</label>
              <input type="text" name="name" id="name" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Nama Pasien">
            </div>
            <div class="mb-4">
              <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
              <input type="text" name="address" id="address" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Alamat">
            </div>
            <div class="mb-4">
              <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Telepon:</label>
              <input type="text" name="phone_number" id="phone_number" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Telepon">
            </div>
            <div class="mb-4">
              <label for="hospital_id" class="block text-gray-700 text-sm font-bold mb-2">Rumah Sakit:</label>
              <select name="hospital_id" id="hospital_id" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">-- Pilih Rumah Sakit --</option>
                @foreach($hospitals as $hospital)
                <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>
                  {{ $hospital->name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="flex justify-end">
              <a href="{{ route('patients.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                Kembali
              </a>
              <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
              </button>

            </div>
          </div>
        </div>
      </div>
  </form>

</x-app-layout>