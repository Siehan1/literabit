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
});