 @vite(['resources/css/app.css', 'resources/js/app.js'])
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
 <style>
    .dropify-wrapper .dropify-message p {
        font-size: 14px !important;
        font-weight: 500;
    }
    .dropify-wrapper .dropify-message .file-icon {
        font-size: 30px !important;
        color: #9ca3af !important;
    }
    .dropify-wrapper {
        border-radius: 8px !important;
        border: 2px dashed #e5e7eb !important;
    }
    .dropify-wrapper:hover {
        border-color: #4f46e5 !important;
    }
 </style>
 @stack('styles')
