<x-layout-user>
    <div class="max-w-4xl mx-auto px-6 py-12 bg-[#f8f1e1] rounded-2xl shadow-2xl border border-[#d4c9ae]" style="margin-top: 8%; margin-bottom: 2%">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#3b4d32] mb-6 border-b border-[#d4c9ae] pb-2">
            ✉️ Get in Touch
        </h1>

        <p class="text-[#5a6b4b] mb-1 text-lg leading-relaxed">
            Have questions, custom order requests, or collaboration ideas?
            Drop us a message below and we’ll respond as soon as possible.
        </p>

        <form action="/contact" method="POST" class="space-y-2">
            @csrf

            <div>
                <label for="name" class="block text-md font-semibold text-[#3b4d32] mb-1">Your Name</label>
                <input type="text" id="name" name="name"
                    class="w-full p-4 border border-[#b2a089] rounded-lg bg-[#fffaf1] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#d4a94e] focus:border-[#d4a94e] shadow-inner"
                    required>
            </div>

            <div>
                <label for="email" class="block text-md font-semibold text-[#3b4d32] mb-1">Your Email</label>
                <input type="email" id="email" name="email"
                    class="w-full p-4 border border-[#b2a089] rounded-lg bg-[#fffaf1] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#d4a94e] focus:border-[#d4a94e] shadow-inner"
                    required>
            </div>

            <div>
                <label for="message" class="block text-md font-semibold text-[#3b4d32] mb-1">Your Message</label>
                <textarea id="message" name="message" rows="6"
                    class="w-full p-4 border border-[#b2a089] rounded-lg bg-[#fffaf1] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#d4a94e] focus:border-[#d4a94e] shadow-inner"
                    required></textarea>
            </div>

            <button type="submit"
                class="w-full bg-[#d4a94e] hover:bg-[#c9923e] text-white font-bold py-3 rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-1">
                📬 Send Message
            </button>
        </form>
    </div>
</x-layout-user>
