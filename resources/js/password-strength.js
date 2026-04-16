/**
 * Jelszó erősség mérő
 * Automatikusan inicializálódik, ha a #password-strength-container elem létezik az oldalon.
 * A jelszó input ID-ja: 'password' (profile/edit) vagy 'jelszo' (register).
 */
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('password-strength-container');
    if (!container) return;

    const bar = document.getElementById('password-strength-bar');
    const text = document.getElementById('password-strength-text');
    const rules = {
        length: document.getElementById('rule-length'),
        lower: document.getElementById('rule-lower'),
        upper: document.getElementById('rule-upper'),
        number: document.getElementById('rule-number')
    };

    // Megkeressük a jelszó inputot – 'password' VAGY 'jelszo' ID-val
    const passwordInput = document.getElementById('password') || document.getElementById('jelszo');
    if (!passwordInput) return;

    passwordInput.addEventListener('input', function () {
        const val = this.value;

        if (val.length === 0) {
            container.style.display = 'none';
            return;
        }

        container.style.display = 'block';
        let score = 0;

        if (val.length >= 8) { score++; updateRule(rules.length, true, '✔ Min. 8 karakter'); }
        else { updateRule(rules.length, false, '✖ Min. 8 karakter'); }

        if (/[a-z]/.test(val)) { score++; updateRule(rules.lower, true, '✔ Kisbetű'); }
        else { updateRule(rules.lower, false, '✖ Kisbetű'); }

        if (/[A-Z]/.test(val)) { score++; updateRule(rules.upper, true, '✔ Nagybetű'); }
        else { updateRule(rules.upper, false, '✖ Nagybetű'); }

        if (/[0-9]/.test(val)) { score++; updateRule(rules.number, true, '✔ Szám'); }
        else { updateRule(rules.number, false, '✖ Szám'); }

        if (/[^A-Za-z0-9]/.test(val) && val.length >= 8) { score++; }

        if (score <= 1) {
            bar.style.width = '25%'; bar.style.backgroundColor = '#dc3545';
            text.textContent = 'Gyenge'; text.style.color = '#dc3545';
        } else if (score <= 3) {
            bar.style.width = '50%'; bar.style.backgroundColor = '#ffc107';
            text.textContent = 'Közepes'; text.style.color = '#d39e00';
        } else if (score === 4) {
            bar.style.width = '75%'; bar.style.backgroundColor = '#0dcaf0';
            text.textContent = 'Jó'; text.style.color = '#0dcaf0';
        } else {
            bar.style.width = '100%'; bar.style.backgroundColor = '#198754';
            text.textContent = 'Erős'; text.style.color = '#198754';
        }
    });

    function updateRule(element, isMet, textStr) {
        if (!element) return;
        element.textContent = textStr;
        element.style.color = isMet ? '#198754' : '#dc3545';
    }
});
