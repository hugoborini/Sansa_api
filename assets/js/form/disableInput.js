const input = document.querySelector('input[name="site"]');

if(input) {
    input.addEventListener('change', () => {
            document.querySelector('input[id="siteName"]').toggleAttribute('disabled');
            if(input.checked) {
                document.querySelector('input[id="siteName"]').value = "-";
            } else {
                document.querySelector('input[id="siteName"]').value = "www.association.fr";
            }
    });
}