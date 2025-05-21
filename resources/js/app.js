import './bootstrap';
import 'node-waves/dist/waves.min.css';
import Waves from 'node-waves';

document.addEventListener('DOMContentLoaded', function() {
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
}