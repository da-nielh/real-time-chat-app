document.querySelectorAll('.users-list a').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        const url = this.getAttribute('data-url');
        document.getElementById('contentFrame').setAttribute('src', url);
    });
});
