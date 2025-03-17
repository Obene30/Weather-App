@extends('layout')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg mx-auto mt-6">
    <h2 class="text-2xl font-semibold mb-4 text-center">📩 Contact Us</h2>
    <p class="text-gray-600 text-center mb-4">Have any inquiries? Fill out the form below, and we’ll get back to you.</p>

    <!-- ✅ Display Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Contact Form -->
    <form action="/contact" method="POST" class="space-y-4">
        @csrf

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-gray-700 font-semibold">Full Name</label>
            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" placeholder="Enter your full name" required>
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold">Email Address</label>
            <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" placeholder="Enter your email" required>
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block text-gray-700 font-semibold">Your Message</label>
            <textarea id="message" name="message" class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" rows="4" placeholder="Enter your message here..." required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Send Inquiry
            </button>
        </div>
    </form>
</div>
@endsection
