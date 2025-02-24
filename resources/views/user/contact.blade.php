<x-layout-user>
    <h1>Contact</h1>

    <p>For general inquiries, custom orders, or collaborations, please reach out via the form below. We will respond to your message as soon as possible.</p>

    <form action="/contact" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
</x-layout-user>
