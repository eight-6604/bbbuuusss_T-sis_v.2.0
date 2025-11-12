<!-- footer.blade.php -->

<footer>
    <p>&copy; 2025 My Company. All rights reserved.</p>
</footer>

<!-- Include main.js -->
<script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Add custom scripts pushed from other views (if any) -->
@stack('scripts')

<!-- Dropdown Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submenuToggle = document.querySelectorAll('.toggle-submenu');
        
        submenuToggle.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const submenu = this.nextElementSibling; // the <ul class="submenu">
                
                // Toggle the visibility of the submenu
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';

                // Optionally, toggle the chevron direction
                const chevronIcon = this.querySelector('.dropdown-icon');
                if (chevronIcon) {
                    chevronIcon.name = submenu.style.display === 'block' ? 'chevron-up-outline' : 'chevron-down-outline';
                }
            });
        });
    });
</script>

<!-- Vite JavaScript (App JS) -->
@vite('resources/js/app.js') <!-- This will be injected by Vite, ensure this is after other custom scripts -->
</body>
</html>
