<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: '<ul class="text-left">' +
                    @json($errors->all())
                    .map(function(m) {
                        return '<li>' + m + '</li>';
                    })
                    .join('') +
                    '</ul>'
            });
        @endif

        // Initialize Dropify
        if ($('.dropify').length > 0) {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drop or Upload',
                    'replace': 'Drop or Upload to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                }
            });
        }
    });
</script>
<script>
    // Preline dropdown toggle
    document.addEventListener('click', function(e) {
        const toggle = e.target.closest('[data-dropdown-toggle]');
        if (toggle) {
            const menu = toggle.nextElementSibling;
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d !== menu) d.classList.add('hidden');
            });
            if (menu) menu.classList.toggle('hidden');
        } else {
            document.querySelectorAll('.dropdown').forEach(d => d.classList.add('hidden'));
        }
    });

    // Sidebar Logic - "Always Show" on Desktop
    (function() {
        const btn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        if (!btn || !sidebar) return;

        function toggleMobile() {
            const isHidden = sidebar.classList.contains('hidden');
            if (isHidden) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('fixed', 'inset-y-0', 'left-0', 'h-full', 'h-[100dvh]', 'z-[100]', 'shadow-2xl');
                
                // Add overlay
                const overlay = document.createElement('div');
                overlay.id = 'sidebar-overlay';
                overlay.className = 'fixed inset-0 bg-black/50 z-[55] lg:hidden';
                overlay.addEventListener('click', toggleMobile);
                document.body.appendChild(overlay);
                document.body.classList.add('overflow-hidden');
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('fixed', 'top-0', 'left-0', 'h-full', 'z-[60]', 'shadow-2xl');
                const overlay = document.getElementById('sidebar-overlay');
                if (overlay) overlay.remove();
                document.body.classList.remove('overflow-hidden');
            }
        }

        btn.addEventListener('click', function() {
            if (window.innerWidth < 1024) {
                toggleMobile();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('hidden', 'fixed', 'inset-y-0', 'left-0', 'h-full', 'h-[100dvh]', 'z-[100]', 'shadow-2xl');
                const overlay = document.getElementById('sidebar-overlay');
                if (overlay) overlay.remove();
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('fixed', 'inset-y-0', 'left-0', 'h-full', 'h-[100dvh]', 'z-[100]', 'shadow-2xl');
            }
        });
    })();
</script>
@stack('scripts')
