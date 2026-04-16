<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Jelszó frissítése') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Biztonságod érdekében használj hosszú, véletlenszerű karakterekből álló jelszót.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Jelenlegi jelszó')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Új jelszó')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            
            {{-- ÚJ: JELSZÓERŐSSÉG MÉRŐ SZEKCIÓ --}}
            <div id="password-strength-container" style="display: none; margin-top: 10px; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="font-size: 0.85rem; color: #6c757d;">Jelszó erőssége:</span>
                    <span id="password-strength-text" style="font-size: 0.85rem; font-weight: bold; color: #dc3545;">Gyenge</span>
                </div>
                
                {{-- A csík maga --}}
                <div style="height: 6px; background-color: #e9ecef; border-radius: 10px; overflow: hidden;">
                    <div id="password-strength-bar" style="height: 100%; width: 0%; background-color: #dc3545; transition: width 0.4s ease, background-color 0.4s ease;"></div>
                </div>

                {{-- Követelmények listája --}}
                <ul style="margin-top: 12px; margin-bottom: 0; padding-left: 0; list-style: none; font-size: 0.8rem; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                    <li id="rule-length" style="color: #dc3545; transition: color 0.3s;">✖ Min. 8 karakter</li>
                    <li id="rule-lower" style="color: #dc3545; transition: color 0.3s;">✖ Kisbetű</li>
                    <li id="rule-upper" style="color: #dc3545; transition: color 0.3s;">✖ Nagybetű</li>
                    <li id="rule-number" style="color: #dc3545; transition: color 0.3s;">✖ Szám</li>
                </ul>
            </div>
            {{-- JELSZÓERŐSSÉG MÉRŐ VÉGE --}}

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Jelszó megerősítése')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Mentés') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Mentve.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- ÚJ: JELSZÓERŐSSÉG JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('update_password_password');
    const container = document.getElementById('password-strength-container');
    const bar = document.getElementById('password-strength-bar');
    const text = document.getElementById('password-strength-text');
    
    const rules = {
        length: document.getElementById('rule-length'),
        lower: document.getElementById('rule-lower'),
        upper: document.getElementById('rule-upper'),
        number: document.getElementById('rule-number')
    };

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;
            
            // Ha üres a mező, elrejtjük a dobozt
            if (val.length === 0) {
                container.style.display = 'none';
                return;
            } else {
                container.style.display = 'block';
            }

            let score = 0;

            // 1. Szabály: Hossz (min 8 karakter)
            if (val.length >= 8) { score++; updateRule(rules.length, true, '✔ Min. 8 karakter'); } 
            else { updateRule(rules.length, false, '✖ Min. 8 karakter'); }

            // 2. Szabály: Kisbetű
            if (/[a-z]/.test(val)) { score++; updateRule(rules.lower, true, '✔ Kisbetű'); } 
            else { updateRule(rules.lower, false, '✖ Kisbetű'); }

            // 3. Szabály: Nagybetű
            if (/[A-Z]/.test(val)) { score++; updateRule(rules.upper, true, '✔ Nagybetű'); } 
            else { updateRule(rules.upper, false, '✖ Nagybetű'); }

            // 4. Szabály: Szám
            if (/[0-9]/.test(val)) { score++; updateRule(rules.number, true, '✔ Szám'); } 
            else { updateRule(rules.number, false, '✖ Szám'); }

            // Extra bónusz pont a speciális karakterekért (ha már legalább 8 hosszú)
            if (/[^A-Za-z0-9]/.test(val) && val.length >= 8) { score++; }

            // Színek és szövegek frissítése a pontszám alapján
            if (score <= 1) {
                bar.style.width = '25%';
                bar.style.backgroundColor = '#dc3545'; // Piros
                text.textContent = 'Gyenge';
                text.style.color = '#dc3545';
            } else if (score === 2 || score === 3) {
                bar.style.width = '50%';
                bar.style.backgroundColor = '#ffc107'; // Sárga
                text.textContent = 'Közepes';
                text.style.color = '#d39e00'; // Sötétebb sárga a szövegnek
            } else if (score === 4) {
                bar.style.width = '75%';
                bar.style.backgroundColor = '#0dcaf0'; // Világoskék
                text.textContent = 'Jó';
                text.style.color = '#0dcaf0';
            } else if (score >= 5) {
                bar.style.width = '100%';
                bar.style.backgroundColor = '#198754'; // Zöld
                text.textContent = 'Erős';
                text.style.color = '#198754';
            }
        });
    }

    // Segédfüggvény a lista elemek pipálására
    function updateRule(element, isMet, textStr) {
        element.textContent = textStr;
        element.style.color = isMet ? '#198754' : '#dc3545'; // Zöld ha teljesül, piros ha nem
    }
});
</script>