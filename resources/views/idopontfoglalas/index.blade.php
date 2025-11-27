@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Időpontfoglalás</h2>

    <div class="card shadow p-4">

        {{-- 1. Szolgáltatás --}}
        <div class="mb-3">
            <label class="form-label">Válassz szolgáltatást:</label>
            <select id="szolgaltatas" class="form-select">
                <option value="">-- Válassz --</option>
                @foreach ($szolgaltatasok as $sz)
                    <option value="{{ $sz->id }}">
                        {{ $sz->nev }} ({{ $sz->ar }} Ft, {{ $sz->idotartam }} perc)
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 2. Dolgozó --}}
        <div class="mb-3">
            <label class="form-label">Válassz dolgozót:</label>
            <select id="dolgozo" class="form-select" disabled>
                <option value="">-- Előbb válassz szolgáltatást --</option>
            </select>
        </div>

        {{-- 3. Dátum --}}
        <div class="mb-3">
            <label class="form-label">Válassz dátumot:</label>
            <input type="text" id="datum" class="form-control" placeholder="Válassz dátumot..." disabled>
        </div>

        {{-- 4. Időpontok --}}
        <div id="idopontok" class="mt-3"></div>

        {{-- Foglalás gomb --}}
        <button id="foglalasBtn" class="btn btn-success mt-3" disabled>Foglalás leadása</button>

    </div>
</div>
@endsection

@section('scripts')
<script>
function formatDateYmd(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}

document.addEventListener("DOMContentLoaded", function () {

    let kivalasztottIdopont = null;

    const szolgaltatasInput = document.getElementById('szolgaltatas');
    const dolgozoInput      = document.getElementById('dolgozo');
    const datumInput        = document.getElementById('datum');
    const idopontokDiv      = document.getElementById('idopontok');
    const foglalasBtn       = document.getElementById('foglalasBtn');

    // --- FLATPICKR ---
    let picker = flatpickr("#datum", {
        locale: "hu",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                if (!window.allowedDates) return true;
                return !window.allowedDates.includes(formatDateYmd(date));
            }
        ],
    });

    // --- FIGYELMEZTETÉS ha dátummezőt korán nyomják meg ---
    datumInput.addEventListener("click", function () {
        if (!szolgaltatasInput.value) {
            alert("Először válassz szolgáltatást!");
            return;
        }
        if (!dolgozoInput.value) {
            alert("Előbb válassz dolgozót a szolgáltatáshoz!");
            return;
        }
    });

    // --- DOLGOZÓK LEKÉRÉSE SZOLGÁLTATÁS ALAPJÁN ---
    szolgaltatasInput.addEventListener("change", function () {

        idopontokDiv.innerHTML = "";
        foglalasBtn.disabled = true;

        if (!szolgaltatasInput.value) {
            dolgozoInput.disabled = true;
            dolgozoInput.innerHTML = `<option value="">-- Előbb válassz szolgáltatást --</option>`;
            return;
        }

        fetch(`/dolgozok-szolgaltatas-alapjan?szolgaltatas_id=${szolgaltatasInput.value}`)
            .then(res => res.json())
            .then(dolgozok => {

                dolgozoInput.innerHTML = `<option value="">-- Válassz dolgozót --</option>`;

                dolgozok.forEach(d => {
                    dolgozoInput.innerHTML += `<option value="${d.id}">${d.nev}</option>`;
                });

                dolgozoInput.disabled = false;
            });

        picker.clear();
        datumInput.disabled = true;
        window.allowedDates = null;
    });

    // --- Foglalható napok lekérése ---
    function fetchFoglalhatoNapok() {
        const szolg = szolgaltatasInput.value;
        const dolgoz = dolgozoInput.value;

        if (!szolg || !dolgoz) {
            datumInput.disabled = true;
            datumInput.value = "";
            picker.clear();
            picker.set("disable", [() => true]);
            idopontokDiv.innerHTML = "";
            foglalasBtn.disabled = true;
            return;
        }

        fetch(`/foglalhato-napok?dolgozo_id=${dolgoz}&szolgaltatas_id=${szolg}`)
            .then(res => res.json())
            .then(napok => {
                window.allowedDates = napok;

                picker.set("disable", [
                    function(date) {
                        return !window.allowedDates.includes(formatDateYmd(date));
                    }
                ]);

                datumInput.disabled = false;
                datumInput.value = "";
                picker.clear();
                idopontokDiv.innerHTML = "";
                foglalasBtn.disabled = true;
            });
    }

    dolgozoInput.addEventListener("change", fetchFoglalhatoNapok);

    // --- Szabad időpontok lekérése ---
    document.addEventListener('change', function() {

        let szolg = szolgaltatasInput.value;
        let dolgozo = dolgozoInput.value;
        let datum = datumInput.value;

        if (szolg && dolgozo && datum) {

            fetch('/idopontfoglalas/szabad-idopontok', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    szolgaltatas_id: szolg,
                    dolgozo_id: dolgozo,
                    datum: datum
                })
            })
            .then(res => res.json())
            .then(data => {

                idopontokDiv.innerHTML = "";

                if (!data.idopontok || data.idopontok.length === 0) {
                    idopontokDiv.innerHTML = "<p class='text-danger'>Nincs elérhető időpont.</p>";
                    foglalasBtn.disabled = true;
                    return;
                }

                data.idopontok.forEach(t => {
                    idopontokDiv.innerHTML += `
                        <button class="btn btn-outline-primary m-1 idopont-btn" data-time="${t}">
                            ${t}
                        </button>`;
                });

                foglalasBtn.disabled = true;
                kivalasztottIdopont = null;
            });
        }
    });

    // --- Időpont kiválasztás ---
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("idopont-btn")) {
            document.querySelectorAll(".idopont-btn").forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            kivalasztottIdopont = e.target.getAttribute("data-time");
            foglalasBtn.disabled = false;
        }
    });

    // --- Foglalás küldése ---
    foglalasBtn.addEventListener("click", function () {

        let szolg = szolgaltatasInput.value;
        let dolgozo = dolgozoInput.value;
        let datum = datumInput.value;

        if (!kivalasztottIdopont) {
            alert("Válassz időpontot!");
            return;
        }

        fetch('/idopontfoglalas/store', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                szolgaltatas_id: szolg,
                dolgozo_id: dolgozo,
                datum: datum,
                ido_kezdes: kivalasztottIdopont
            })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.uzenet);
            location.reload();
        });

    });

});
</script>
@endsection
