@extends('frontend.common.master')
@section('content')

    <div id="wrapper" class="wrap overflow-hidden-x">

        <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">Privacy policy</span></li>
                </ul>
            </div>
        </div>

        <!-- Header -->
        <section class="py-5 text-center">
            <div class="container">
                {{-- <h2 class="display-5 fw-bold mb-3">Contact Us</h2> --}}
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    We're here to assist you. Reach out anytime—we usually respond within a few hours.
                </p>
            </div>
        </section>

        <section class="pb-5">
            <div class="container">

                <div class="row g-4">

                    <!-- Contact Form -->
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-lg rounded-4 h-100 contact-card">
                            <div class="card-body p-4 p-md-5">

                                <h4 class="fw-bold mb-4">Send us a Message</h4>

                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                                placeholder="John Doe" value="{{ old('name') }}" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                                placeholder="john@example.com" value="{{ old('email') }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label">Phone Number (Optional)</label>
                                        <input type="text" name="phone" class="form-control form-control-lg rounded-3"
                                            placeholder="+91 98765 43210" value="{{ old('phone') }}">
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label">Message <span class="text-danger">*</span></label>
                                        <textarea name="message" rows="5"
                                            class="form-control form-control-lg rounded-3 @error('message') is-invalid @enderror"
                                            placeholder="Write your message..." required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-3 shadow-sm">
                                            Send Message
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Contact Info + Map -->
                    <div class="col-lg-5">

                        <!-- Contact Info -->
                        <div class="card border-0 shadow-lg rounded-4 mb-4 contact-card">
                            <div class="card-body p-4 p-md-5">
                                <h4 class="fw-bold mb-4">Get in Touch</h4>

                                <div class="d-flex mb-2">
                                    <div class="icon-box">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold">Address</h6>
                                        <p class="text-muted mb-0">
                                            11, East Netaji Subhash Marg, Babarpur, Shahdara Delhi-110032
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex mb-2">
                                    <div class="icon-box">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold">Phone</h6>
                                        <p class="text-muted mb-0">+91 98765 43210</p>
                                    </div>
                                </div>

                                <div class="d-flex mb-2">
                                    <div class="icon-box">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold">Email</h6>
                                        <a href="mailto:info@bharatheadline.in" class="text-primary">
                                            info@bharatheadline.in
                                        </a>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="icon-box">
                                        <i class="bi bi-clock-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold">Office Hours</h6>
                                        <p class="text-muted mb-0">
                                            Mon–Sat: 10 AM – 6 PM<br>
                                            <small class="text-muted">Sunday Closed</small>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Google Map -->
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden contact-card">
                            <div class="ratio ratio-4x3">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.7893833759604!2d72.874584315359!3d19.113645187059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c7d5c0a0b0c1%3A0x94f08d3a9e5f5e55!2sAndheri%20East%2C%20Mumbai!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                                    style="border:0;" allowfullscreen loading="lazy"></iframe>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .icon-box {
            width: 52px;
            height: 52px;
            background: #eef4ff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.4rem;
            color: #0d6efd;
        }

        .contact-card {
            transition: 0.3s ease;
            border-radius: 18px !important;
        }

        .contact-card:hover {
            transform: translateY(-6px);
            box-shadow: 0px 12px 28px rgba(0, 0, 0, 0.15) !important;
        }

        @media (max-width: 576px) {
            h1.display-5 {
                font-size: 1.9rem;
            }

            .icon-box {
                width: 45px;
                height: 45px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Smooth reveal on scroll
        document.querySelectorAll('.contact-card').forEach((card, index) => {
            card.style.opacity = 0;
            card.style.transform = "translateY(20px)";
            setTimeout(() => {
                card.style.transition = "all 0.6s ease";
                card.style.opacity = 1;
                card.style.transform = "translateY(0)";
            }, 200 * index);
        });
    </script>
@endpush