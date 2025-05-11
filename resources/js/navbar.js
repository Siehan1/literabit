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


// scrolll navbar
let lastScrollTop = 0;
let navbar = document.querySelector('header');
let timer = null;

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Menghilangkan navbar saat scroll ke bawah
    if (scrollTop > lastScrollTop) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.3s ease-in-out';
    } 
    // Menampilkan navbar saat scroll ke atas
    else {
        navbar.style.transform = 'translateY(0)';
        navbar.style.transition = 'transform 0.3s ease-in-out';
    }
    
    lastScrollTop = scrollTop;

    // Clear timer yang ada
    if (timer !== null) {
        clearTimeout(timer);
    }

    // Set timer baru untuk menampilkan navbar setelah scroll berhenti
    timer = setTimeout(function() {
        navbar.style.transform = 'translateY(0)';
    }, 150); // Waktu tunggu 150ms setelah scroll berhenti
});