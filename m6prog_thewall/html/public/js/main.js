const form = document.querySelector('.post-form form');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    const data = {
        text: formData.get('bericht'),
        sign: formData.get('name')
    };

    console.log(JSON.stringify(data, null, 2));

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newWall = doc.querySelector('.wall');
        if (newWall) {
            document.querySelector('.wall').innerHTML = newWall.innerHTML;
        }
        form.reset();
    })
    .catch(error => console.error('Error:', error));
});
