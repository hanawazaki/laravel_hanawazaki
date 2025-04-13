<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tambah Rumah Sakit') }}
    </h2>
  </x-slot>

  <form action="{{ route('hospitals.store') }}" method="POST">
    @csrf
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-4">Tambah Rumah Sakit</h1>
            <div class="mb-4">
              <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Rumah Sakit:</label>
              <input type="text" name="name" id="name" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Nama Rumah Sakit">
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
              <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
              <input type="email" name="email" id="email" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Email">
            </div>
            <div class="flex justify-end">
              <a href="{{ route('hospitals.index') }}"
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