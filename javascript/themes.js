document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('loading');

    window.addEventListener('load', function() {
        // Add a delay of 2 seconds before hiding the preloader
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 1000);
    });
});
