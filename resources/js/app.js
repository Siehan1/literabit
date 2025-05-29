import './bootstrap';
import 'node-waves/dist/waves.min.css';
import Waves from 'node-waves';

document.addEventListener('DOMContentLoaded', function() {
    // konfirmasi password
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const message = document.getElementById('message');
    const btnDaftar = document.getElementById('btn-daftar');

    if (confirm) { // Tambahkan pengecekan untuk memastikan elemen ada
        confirm.addEventListener('input', function () {
            if (confirm.value === "") {
                message.textContent = "";
                message.className = "italic text-sm";
            } else if (password.value === confirm.value) {
                message.textContent = "Password cocok ✓";
                message.className = "italic text-green-600 text-sm";
            } else {
                message.textContent = "Password tidak cocok ✗";
                message.className = "italic text-red-700 text-sm";
            }
        });
    }

    Waves.init({
        duration: 500,
        delay: 200
    });
    
    // Tambahkan efek waves ke elemen dengan class .waves
    Waves.attach('.waves', ['waves-float']);

    // toggle mata
    const toggleButton = document.querySelector('.toggle-password');
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClose = document.getElementById('eyeClose');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClose.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClose.classList.remove('hidden');
            }
        });
    }

    // Navside toggle
    const navside = document.getElementById('navside');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('toggleNav');
    const brandText = document.getElementById('brandText');
    const navTexts = document.querySelectorAll('.nav-text');
    let isCollapsed = false;

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            isCollapsed = !isCollapsed;
            const toggleIcon = this.querySelector('svg');
            
            if (isCollapsed) {
                navside.style.width = '70px';
                mainContent.style.marginLeft = '70px';
                toggleIcon.style.transform = 'rotate(180deg)';
                brandText.style.opacity = '0';
                navTexts.forEach(text => text.style.opacity = '0');
                
                setTimeout(() => {
                    brandText.style.display = 'none';
                    navTexts.forEach(text => text.style.display = 'none');
                }, 300);
            } else {
                navside.style.width = '250px';
                mainContent.style.marginLeft = '250px';
                toggleIcon.style.transform = 'rotate(0deg)';
                brandText.style.display = 'flex';
                navTexts.forEach(text => text.style.display = 'block');
                
                setTimeout(() => {
                    brandText.style.opacity = '1';
                    navTexts.forEach(text => text.style.opacity = '1');
                }, 50);
            }
        });
    }
});

// toggle mata
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClose = document.getElementById('eyeClose');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.classList.remove('hidden');
        eyeClose.classList.add('hidden');
    } else {
        passwordInput.type = 'password';
        eyeOpen.classList.add('hidden');
        eyeClose.classList.remove('hidden');
    }
}

// Menambahkan event listener untuk tombol toggle password
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('[onclick="togglePassword()"]');
    if (toggleButton) {
        toggleButton.addEventListener('click', togglePassword);
        // Menghapus atribut onclick untuk menghindari duplikasi event
        toggleButton.removeAttribute('onclick');
    }
});

// Dropdown Menu
document.addEventListener('DOMContentLoaded', () => {
    const dropdownBtn = document.getElementById('dropdownBtn');
    const dropdownContent = document.getElementById('dropdownContent');
    let isOpen = false;

    if (dropdownBtn && dropdownContent) {
        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            isOpen = !isOpen;
            dropdownContent.classList.toggle('hidden', !isOpen);
        });

        // Menutup dropdown ketika mengklik di luar
        document.addEventListener('click', (e) => {
            if (!dropdownContent.contains(e.target) && isOpen) {
                isOpen = false;
                dropdownContent.classList.add('hidden');
            }
        });
    }
});


// change name file
const inputFile = document.getElementById('pdf_file');
const uploadContent = document.getElementById('uploadContent');

if (inputFile) { // Tambahkan pengecekan elemen ada
    inputFile.addEventListener('change', function () {
        if (inputFile.files.length > 0) {
            const fileName = inputFile.files[0].name;
            uploadContent.innerHTML = `
                <svg class="w-8 h-8 mb-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p class="mb-1 text-sm font-semibold text-green-600">File berhasil diunggah!</p>
                <p class="text-xs text-gray-500 truncate">${fileName}</p>
            `;
        }
    });
}


// change name icon 
const inputIcon = document.getElementById('icon_path');
const iconContent = document.getElementById('uploadIcon');

if (inputIcon) { // Tambahkan pengecekan elemen ada
    inputIcon.addEventListener('change', function () {
        if(inputIcon.files.length > 0){
            const fileName = inputIcon.files[0].name;
            iconContent.innerHTML = `
                    <svg class="w-8 h-8 mb-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="mb-1 text-sm font-semibold text-green-600">Icon berhasil diunggah!</p>
                    <p class="text-xs text-gray-500 truncate">${fileName}</p>`;
        }
    });
} // Tutup blok if (inputIcon) di sini

// Move this code outside of the icon input event listener
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success');
    
    if (successMessage) {
        // Add initial fade-out animation
        successMessage.style.transition = 'opacity 0.5s ease-out';
        
        setTimeout(function() {
            successMessage.style.opacity = '0';
            
            // Remove element after fade animation
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 500);
        }, 3000);
    }
});

// dropdow mission
document.addEventListener('DOMContentLoaded', function () {
    const missionsToggle = document.getElementById('missions-dropdown-toggle');
    const missionsMenu = document.getElementById('missions-dropdown-menu');
    const missionsArrow = document.getElementById('missions-arrow');

    if (missionsToggle && missionsMenu && missionsArrow) {
        // Set initial state for animation
        missionsMenu.style.maxHeight = '0';
        missionsMenu.style.overflow = 'hidden';
        missionsMenu.style.opacity = '0';
        missionsMenu.classList.add('transition-all', 'duration-300', 'ease-in-out'); // Tambahkan kelas transisi Tailwind

        missionsToggle.addEventListener('click', function () {
            const isOpen = missionsMenu.style.maxHeight !== '0px'; // Cek status berdasarkan max-height

            if (!isOpen) {
                // Buka dropdown
                missionsMenu.classList.remove('hidden'); // Pastikan tidak hidden
                missionsMenu.style.maxHeight = missionsMenu.scrollHeight + 'px'; // Set max-height ke tinggi konten
                missionsMenu.style.opacity = '1'; // Set opacity ke 1
                missionsArrow.classList.add('rotate-180'); // Putar panah ke atas
            } else {
                // Tutup dropdown
                missionsMenu.style.maxHeight = '0'; // Set max-height ke 0
                missionsMenu.style.opacity = '0'; // Set opacity ke 0
                missionsArrow.classList.remove('rotate-180'); // Kembalikan panah ke bawah
                 // Opsional: Sembunyikan sepenuhnya setelah transisi selesai
                 setTimeout(() => {
                     missionsMenu.classList.add('hidden');
                 }, 300); // Sesuaikan dengan durasi transisi
            }
        });

        // Optional: Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!missionsToggle.contains(event.target) && !missionsMenu.contains(event.target)) {
                if (missionsMenu.style.maxHeight !== '0px') { // Cek jika sedang terbuka
                    missionsMenu.style.maxHeight = '0';
                    missionsMenu.style.opacity = '0';
                    missionsArrow.classList.remove('rotate-180');
                     setTimeout(() => {
                         missionsMenu.classList.add('hidden');
                     }, 300); // Sesuaikan dengan durasi transisi
                }
            }
        });

        // Optional: Adjust max-height if window is resized while open
        window.addEventListener('resize', function() {
             if (missionsMenu.style.maxHeight !== '0px' && !missionsMenu.classList.contains('hidden')) {
                 missionsMenu.style.maxHeight = 'none'; // Reset untuk mendapatkan scrollHeight yang benar
                 missionsMenu.style.maxHeight = missionsMenu.scrollHeight + 'px';
             }
        });
    }
});

    // Carousel scroll smooth
    window.scrollCarousel = function(direction) {
        const container = document.querySelector('.overflow-x-auto');
        const scrollAmount = 300;
        if (container) {
            const newScroll = direction === 'left' ? container.scrollLeft - scrollAmount : container.scrollLeft + scrollAmount;
            container.scrollTo({ left: newScroll, behavior: 'smooth' });
        }
    }
