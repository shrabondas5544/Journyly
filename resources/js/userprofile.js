export function initializeProfile() {
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebarButtons = document.querySelectorAll('[role="button"]');
    const profileSection = document.getElementById('profileSection');
   
    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 1024) {
            if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                sidebar.classList.add('hidden');
            }
        }
    });

    // Show profile section by default
    profileSection.classList.remove('hidden');

    // Handle sidebar button clicks
    sidebarButtons.forEach(button => {
        button.addEventListener('click', function() {
            sidebarButtons.forEach(btn => {
                btn.classList.remove('bg-blue-100');
            });

            this.classList.add('bg-blue-100');

            if (this.textContent.trim().toLowerCase() === 'profile') {
                profileSection.classList.remove('hidden');
            } else {
                profileSection.classList.add('hidden');
            }

            if (window.innerWidth < 1024) {
                sidebar.classList.add('hidden');
            }
        });
    });

    // Set initial active state on profile button
    const profileButton = Array.from(sidebarButtons)
        .find(button => button.textContent.trim().toLowerCase() === 'profile');
    if (profileButton) {
        profileButton.classList.add('bg-blue-100');
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    });
}