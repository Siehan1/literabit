function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.group.lg\\:hidden');
    const closeBtn = document.querySelector('button.lg\\:hidden');
    const navMenu = document.getElementById('nav-menu');

    // Toggle menu dengan hamburger
    hamburgerBtn.addEventListener('click', () => {
        navMenu.classList.remove('hidden');
        // Beri waktu untuk transisi
        setTimeout(() => {
            navMenu.classList.remove('-right-full');
            navMenu.classList.add('right-0');
        }, 10);
    });

    // Tutup menu dengan tombol close
    closeBtn.addEventListener('click', () => {
        navMenu.classList.remove('right-0');
        navMenu.classList.add('-right-full');
        // Tunggu transisi selesai sebelum menyembunyikan menu
        setTimeout(() => {
            navMenu.classList.add('hidden');
        }, 300);
    });

    // Tutup menu saat mengklik link
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                navMenu.classList.remove('right-0');
                navMenu.classList.add('-right-full');
                setTimeout(() => {
                    navMenu.classList.add('hidden');
                }, 300);
            }
        });
    });
});