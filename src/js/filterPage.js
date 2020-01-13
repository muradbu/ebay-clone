function filterFormValidate(e) {
    let start = parseFloat(document.getElementById('start').value);
    let end = parseFloat(document.getElementById('end').value);

    if (start && end) {
        if (start > end) {
            document.getElementById('start').classList.add('is-invalid');
            document.getElementById('end').classList.add('is-invalid');
            e.preventDefault();
        }
    }
}
