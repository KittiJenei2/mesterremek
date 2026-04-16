/**
 * Intelligens telefonszám formázó (+36 formátum)
 * Automatikusan inicializálódik minden input[name="telefonszam"] elemre.
 */
document.addEventListener('DOMContentLoaded', function () {
    const phoneInputs = document.querySelectorAll('input[name="telefonszam"]');
    if (phoneInputs.length === 0) return;

    phoneInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            if (e.inputType === 'deleteContentBackward') return;

            let numbers = this.value.replace(/\D/g, '');

            if (numbers.length === 0) {
                this.value = '';
                return;
            }

            // Ha '06'-tal kezdődik, cseréljük '36'-ra
            if (numbers.startsWith('06')) {
                numbers = '36' + numbers.substring(2);
            }

            // Ha épp csak egy '0'-t írt be
            if (numbers === '0') {
                this.value = '0';
                return;
            }

            // Ha nem 36-tal és nem 0-val kezdődik, elérakjuk a 36-ot
            if (numbers.length >= 2 && !numbers.startsWith('36') && !numbers.startsWith('0')) {
                numbers = '36' + numbers;
            }

            let res = '';

            if (numbers.startsWith('36')) {
                res = '+' + numbers.substring(0, 2);

                if (numbers.length > 2) {
                    let isBp = numbers.charAt(2) === '1';
                    let areaLength = isBp ? 1 : 2;

                    res += ' ' + numbers.substring(2, 2 + areaLength);

                    if (numbers.length > 2 + areaLength) {
                        res += ' ' + numbers.substring(2 + areaLength, 5 + areaLength);
                    }
                    if (numbers.length > 5 + areaLength) {
                        res += ' ' + numbers.substring(5 + areaLength, 9 + areaLength);
                    }
                }
                this.value = res;
            } else if (numbers === '3') {
                this.value = '+' + numbers;
            } else {
                this.value = '+' + numbers;
            }
        });
    });
});
