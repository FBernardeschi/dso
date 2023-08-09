let select = document.querySelector('select.sort');

formarHref();

select.addEventListener('change', () => {
    formarHref();
});

function formarHref() {
    let sorted = document.querySelectorAll('.main .title-account>a');
    sorted.forEach(e => {
        e.href = 'index.php?sorted=' + e.dataset.sorted + '&desc=' + select.value;
    });
};