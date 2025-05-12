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
