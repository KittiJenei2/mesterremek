/**
 * Élő keresés/szűrés modul
 * Automatikusan inicializálódik a #szuroForm, #talalatokContainer, #szuroGombok elemekre.
 * Használja: szolgaltatasok/index.blade.php és termekek/index.blade.php
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('szuroForm');
    if (!form) return;

    let debounceTimer;

    // Gépelés és legördülő változás figyelése
    document.body.addEventListener('input', function (e) {
        if (e.target.closest('#szuroForm')) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => { fetchResults(form); }, 400);
        }
    });

    // Form submit letiltása (AJAX-al dolgozunk)
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        clearTimeout(debounceTimer);
        fetchResults(form);
    });

    // Törlés gomb (X) kezelése
    document.body.addEventListener('click', function (e) {
        const resetBtn = e.target.closest('.reset-btn');
        if (resetBtn) {
            e.preventDefault();
            const kereses = form.querySelector('#kereses');
            const kategoria = form.querySelector('#kategoria');
            if (kereses) kereses.value = '';
            if (kategoria) kategoria.value = '';
            fetchResults(form);
        }
    });

    function fetchResults(formElement) {
        const container = document.getElementById('talalatokContainer');
        if (container) container.style.opacity = '0.4';

        const searchParams = new URLSearchParams(new FormData(formElement));
        const url = `${formElement.action}?${searchParams.toString()}`;

        window.history.pushState({}, '', url);

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newContainer = doc.getElementById('talalatokContainer');
                if (newContainer && container) {
                    container.innerHTML = newContainer.innerHTML;
                    container.style.opacity = '1';
                }

                const oldBtns = document.getElementById('szuroGombok');
                const newBtns = doc.getElementById('szuroGombok');
                if (oldBtns && newBtns) oldBtns.innerHTML = newBtns.innerHTML;
            });
    }
});
