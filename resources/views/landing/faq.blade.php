@extends('layouts.homelayout')

@section('content')
    <div class="mt-24 mb-[50px]">
        <section class="text-center bg-gray-50 py-16">
            <h1 class="text-4xl font-bold mb-4">Frequently Asked Questions</h1>
            <p class="text-lg text-gray-600">Cari jawaban yang biasa ditanyakan oleh banyak orang disini.</p>
        </section>

        <section class="container mx-auto max-w-4xl px-6 py-8">
            <!-- Search form -->
            <form action="#" method="GET" class="mb-4" onsubmit="scrollToFaq(); return false;">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                    placeholder="Cari pertanyaan..." class="w-full p-3 border border-gray-300 rounded mb-2" />
                <div class="flex justify-end">
                    <button type="submit"
                        class="mr-2 px-4 py-2 bg-blue-500 text-white font-medium rounded hover:bg-blue-600">
                        Search
                    </button>
                    <button type="button" onclick="clearSearch()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 font-medium rounded hover:bg-gray-400">
                        Clear
                    </button>
                </div>
            </form>

            <div id="faqContainer">
                @if ($faqsByCategory->isEmpty())
                    <div class="text-center py-8">
                        <h2 class="text-2xl font-semibold text-gray-700">Hasil Pencarian Tidak Ditemukan</h2>
                        <p class="text-gray-500 mt-2">Coba gunakan kata kunci lain untuk pencarian Anda.</p>
                    </div>
                @else
                    @foreach ($faqsByCategory as $category => $faqs)
                        @php
                            $namaLayanan = $faqs->first()->kategoriLayanan->nama_layanan;
                        @endphp

                        <div class="faq-category" id="category-{{ Str::slug($namaLayanan) }}">
                            <h1 class="text-center font-bold text-3xl mb-[30px]">
                                {{ $namaLayanan }}
                            </h1>

                            @foreach ($faqs as $faq)
                                @php
                                    $uniqueId =
                                        Str::slug($namaLayanan) . '-' . $category . '-' . $faq->id . '-' . $loop->index;
                                @endphp
                                <div class="faq-item py-4" id="faq-{{ $uniqueId }}">
                                    <button type="button"
                                        class="flex justify-between w-full text-left text-gray-800 font-medium text-lg py-4"
                                        onclick="toggleFaq('{{ $uniqueId }}')">
                                        <span>{{ $faq->pertanyaan }}</span>
                                        <svg class="w-6 h-6 transform transition-transform duration-300"
                                            id="{{ $uniqueId }}-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div class="text-gray-600 hidden transition-opacity duration-300 break-words"
                                        id="answer-{{ $uniqueId }}">
                                        @foreach (explode("\n", $faq->penyelesaian) as $point)
                                            <div>{{ $point }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>


            <div class="mt-12 text-center">
                <p class="text-gray-600 text-lg">Didn’t find what you were looking for?</p>
                <a href="{{ route('complaint') }}" class="text-blue-500 font-medium hover:underline">Contact us for
                    further assistance</a>
            </div>
        </section>

        <div id="popupBox" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800">Pencarian Tidak Ditemukan</h2>
                <p class="text-gray-600 mt-2">Coba gunakan kata kunci lain untuk pencarian Anda.</p>
                <button onclick="closePopup()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Tutup
                </button>
            </div>
        </div>


        {{-- <script>
            function toggleFaq(faqId) {
                const answer = document.getElementById("answer-" + faqId);
                const icon = document.getElementById(faqId + '-icon');

                answer.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }

            function scrollToFaq() {
                const searchQuery = document.getElementById("searchInput").value.toLowerCase();
                const categories = document.querySelectorAll(".faq-category");
                let firstMatch = null;

                categories.forEach(category => {
                    const faqs = category.querySelectorAll(".faq-item");
                    let hasVisibleFaq = false;

                    faqs.forEach(faq => {
                        const questionText = faq.querySelector("span").textContent.toLowerCase();
                        const answer = faq.querySelector("[id^='answer-']");
                        const icon = faq.querySelector("svg[id$='-icon']");

                        if (questionText.includes(searchQuery)) {
                            faq.classList.remove('hidden');
                            answer.classList.add('hidden'); // Ensure answer remains hidden
                            icon.classList.remove('rotate-180'); // Ensure dropdown is closed
                            hasVisibleFaq = true;

                            if (!firstMatch) {
                                firstMatch = faq;
                            }
                        } else {
                            faq.classList.add('hidden');
                        }
                    });

                    if (hasVisibleFaq) {
                        category.style.display = "block";
                    } else {
                        category.style.display = "none";
                    }
                });

                if (firstMatch) {
                    firstMatch.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                }
            }

            function clearSearch() {
                document.getElementById("searchInput").value = "";

                const categories = document.querySelectorAll(".faq-category");
                categories.forEach(category => {
                    category.style.display = "block";
                    const faqs = category.querySelectorAll(".faq-item");
                    faqs.forEach(faq => {
                        faq.classList.remove("hidden");
                        const answer = faq.querySelector("[id^='answer-']");
                        const icon = faq.querySelector("svg[id$='-icon']");
                        answer.classList.add("hidden");
                        icon.classList.remove("rotate-180");
                    });
                });
            }

            function showPopup() {
                const popupBox = document.getElementById("popupBox");
                popupBox.classList.remove("hidden");
            }

            function closePopup() {
                const popupBox = document.getElementById("popupBox");
                popupBox.classList.add("hidden");
            }

            document.addEventListener("DOMContentLoaded", () => {
                const searchQuery = "{{ request('search') }}";
                const faqsFound = {{ $faqsByCategory->isEmpty() ? 'false' : 'true' }};

                console.log("Search Query:", searchQuery);
                console.log("FAQs Found:", faqsFound);

                if (searchQuery && faqsFound === 'false') {
                    console.log("Showing popup...");
                    showPopup();
                }
            });
        </script> --}}

        <script>
            function toggleFaq(faqId) {
                const answer = document.getElementById("answer-" + faqId);
                const icon = document.getElementById(faqId + '-icon');

                answer.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }

            function clearSearch() {
                document.getElementById("searchInput").value = "";

                const categories = document.querySelectorAll(".faq-category");
                categories.forEach(category => {
                    category.style.display = "block";
                    const faqs = category.querySelectorAll(".faq-item");
                    faqs.forEach(faq => {
                        faq.classList.remove("hidden");
                        const answer = faq.querySelector("[id^='answer-']");
                        const icon = faq.querySelector("svg[id$='-icon']");
                        answer.classList.add("hidden");
                        icon.classList.remove("rotate-180");
                    });
                });
            }

            function showPopup() {
                const popupBox = document.getElementById("popupBox");
                popupBox.classList.remove("hidden");
            }

            function closePopup() {
                const popupBox = document.getElementById("popupBox");
                popupBox.classList.add("hidden");
            }

            document.addEventListener("DOMContentLoaded", () => {
                const searchQuery = "{{ request('search') }}";
                const faqsFound = {{ $faqsByCategory->isEmpty() ? 'false' : 'true' }};

                console.log("Search Query:", searchQuery);
                console.log("FAQs Found:", faqsFound);

                if (searchQuery && faqsFound === 'false') {
                    console.log("Showing popup...");
                    showPopup();
                }
            });
        </script>


    </div>
@endsection
