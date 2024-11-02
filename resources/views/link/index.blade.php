<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-blue-400">
        <div class="w-1/2 h-3/4 bg-blue-50 rounded-lg shadow-lg p-10 flex flex-col items-center">
            <!-- Логотип -->
            <div>
                <img src="{{ asset('images/loh.kz.svg') }}" alt="Logo" class="w-140 h-60">
            </div>
            <div class="mb-4">
                <p class="font-mono font-bold text-4xl text-blue-500 drop-shadow-lg">Light Optimized Hyperlink</p>
            </div>

            <!-- Форма -->
            <form id="urlForm" class="w-full mt-5">
                @csrf
                <div>
                    <div class="relative mx-auto rounded-md shadow-">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                            <span class="text-gray-500 sm:text-sm font-mono">URL</span>
                        </div>
                        <input type="text" name="url" id="url"
                               class="block w-full font-mono h-12 text-xl rounded-md border-0 py-2 pl-10 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                               placeholder="Enter your URL" required>
                    </div>
                </div>
                <div class="mt-5 flex items-center justify-center">
                    <button type="submit" id="submitButton" class="rounded-md font-mono bg-indigo-600 px-4 py-2 text-xl font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <span id="buttonText">Shorten</span>
                        <span id="loading" class="loader hidden"></span>
                    </button>

                </div>
            </form>

            <!-- Отображение результата -->
            <div id="copyAlert" class="hidden absolute bg-blue-100 text-blue-800 font-semibold px-4 py-2 rounded shadow-md transform -translate-y-10 transition duration-300 ease-in-out">Copied!</div>

            <div id="result" class="mt-8 text-center">
            </div>
        </div>
    </div>
</x-layout>

<x-script></x-script>
