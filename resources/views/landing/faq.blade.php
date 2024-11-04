@extends('layouts.homelayout')

@section('content')
    <div class="mt-24 mb-[50px]">
        <section class="text-center bg-gray-50 py-16">
            <h1 class="text-4xl font-bold mb-4">Frequently Asked Questions</h1>
            <p class="text-lg text-gray-600">Cari jawaban yang biasa ditanyakan oleh banyak orang disini.</p>
        </section>

        <section class="container mx-auto max-w-4xl px-6 py-8">
            <!-- Search form -->
            <form action="{{ route('faq.index') }}" method="GET" class="mb-8" onsubmit="scrollToFaq(); return false;">
                <input
                    type="text"
                    name="search"
                    id="searchInput"
                    value="{{ request('search') }}"
                    placeholder="Cari pertanyaan..."
                    class="w-full p-3 border border-gray-300 rounded"
                />
            </form>

            <div id="faqContainer">
                @foreach ($faqsByCategory as $category => $faqs)
                    @php
                        $namaLayanan = $faqs->first()->kategoriLayanan->nama_layanan;
                    @endphp

                    <div class="divide-y divide-gray-200 mt-[80px]">
                        <h1 id="{{ Str::slug($namaLayanan) }}" class="text-center font-bold text-3xl mb-[30px]">
                            {{ $namaLayanan }}
                        </h1>

                        @foreach ($faqs as $faq)
                            @php
                                $uniqueId = Str::slug($namaLayanan) . '-' . $faq->id;
                            @endphp
                            <div class="py-4" id="faq-{{ $faq->id }}">
                                <button class="flex justify-between w-full text-left text-gray-800 font-medium text-lg py-4"
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
                                    id="{{ $uniqueId }}">
                                    @foreach (explode("\n", $faq->penyelesaian) as $point)
                                        <div>{{ $point }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <p class="text-gray-600 text-lg">Didn’t find what you were looking for?</p>
                <a href="{{ route('complaint') }}" class="text-blue-500 font-medium hover:underline">Contact us for
                    further assistance</a>
            </div>
        </section>

        <!-- JavaScript for smooth scrolling and FAQ toggling -->
        <script>
            function toggleFaq(faqId) {
                var answer = document.getElementById(faqId);
                var icon = document.getElementById(faqId + '-icon');

                if (answer.classList.contains('hidden')) {
                    answer.classList.remove('hidden');
                    answer.style.opacity = 0;
                    setTimeout(() => {
                        answer.style.opacity = 1;
                    }, 10);
                    icon.classList.add('rotate-180');
                } else {
                    answer.style.opacity = 0;
                    setTimeout(() => {
                        answer.classList.add('hidden');
                    }, 300);
                    icon.classList.remove('rotate-180');
                }
            }

            function scrollToFaq() {
                const searchQuery = document.getElementById("searchInput").value.toLowerCase();
                const faqItems = document.querySelectorAll("#faqContainer div[id^='faq-']");

                for (let faq of faqItems) {
                    if (faq.querySelector("span").textContent.toLowerCase().includes(searchQuery)) {
                        faq.scrollIntoView({ behavior: "smooth", block: "center" });
                        const button = faq.querySelector("button");
                        const faqId = button.getAttribute("onclick").match(/toggleFaq\('(.+?)'\)/)[1];
                        toggleFaq(faqId);
                        break;
                    }
                }
            }
        </script>
    </div>
@endsection
