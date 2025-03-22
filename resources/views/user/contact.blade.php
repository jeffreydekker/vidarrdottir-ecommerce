<x-layout-user>
    <div class="max-w-5xl mx-auto p-6 my-5 bg-[#f8f1e1] rounded-lg shadow-lg border border-[#d4c9ae]">
        <h1 class="text-4xl font-extrabold text-[#3b4d32] mb-4">Get in Touch</h1>

        <p class="text-[#5a6b4b] mb-6">
            Have questions, custom order requests, or collaboration ideas? Drop us a message below, and we'll get back
            to you as soon as possible!
        </p>

        <form action="/contact" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-md font-medium text-[#3b4d32]">Your Name</label>
                <input type="text" id="name" name="name"
                    class="w-full p-3 border border-[#b2a089] rounded-lg bg-[#fffaf1] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#d4a94e] focus:border-[#d4a94e]"required>
            </div>

            <div>
                <label for="email" class="block text-md font-medium text-[#3b4d32]">Your Email</label>
                <input type="email" id="email" name="email"
                    class="w-full p-3 border border-[#b2a089] rounded-lg bg-[#fffaf1] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#d4a94e] focus:border-[#d4a94e]" required>
            </div>

            <div>
                <label for="message" class="block text-md font-medium text-[#3b4d32]">Your Message</label>
                <textarea id="message" name="message" rows="5" class="w-full p-3 border border-[#b2a089] rounded-lg bg-[#fffaf1] text-gray-900
                            focus:outline-none focus:ring-2 focus:ring-[#d4a94e] focus:border-[#d4a94e]" required></textarea>
            </div>

            <button type="submit"
                class="w-full bg-[#d4a94e] hover:bg-[#c9923e] text-white font-bold py-3 rounded-lg shadow-md transition-all duration-200">
                Send Message
            </button>
        </form>
    </div>
</x-layout-user>
