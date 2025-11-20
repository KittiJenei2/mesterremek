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
            <select id="dolgozo" class="form-select">
                <option value="">-- Válassz --</option>
                @foreach ($dolgozok as $d)
                    <option value="{{ $d->id }}">{{ $d->nev }}</option>
                @endforeach
            </select>
        </div>

        {{-- 3. Dátum --}}
        <div class="mb-3">
            <label class="form-label">Válassz dátumot:</label>
            <input type="date" id="datum" class="form-control">
        </div>

        {{-- 4. Időpontok --}}
        <div id="idopontok" class="mt-3"></div>

        {{-- Foglalás gomb --}}
        <button id="foglalasBtn" class="btn btn-success mt-3" disabled>Foglalás leadása</button>

    </div>
</div>
@endsection


{{-- FONTOS: MINDEN SCRIPT IDE KERÜL – A HTML UTÁN --}}
@section('scripts')
<script>
let kivalasztottIdopont = null;

document.addEventListener("DOMContentLoaded", function () {

    console.log("JS betöltve!");

    // --- LISTA FIGYELÉSE ---
    document.addEventListener('change', function() {
        let szolg = document.getElementById('szolgaltatas').value;
        let dolgozo = document.getElementById('dolgozo').value;
        let datum = document.getElementById('datum').value;

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
                let div = document.getElementById('idopontok');
                div.innerHTML = "";

                if (data.idopontok.length === 0) {
                    div.innerHTML = "<p class='text-danger'>Nincs elérhető időpont.</p>";
                    return;
                }

                data.idopontok.forEach(t => {
                    div.innerHTML += `
                        <button class="btn btn-outline-primary m-1 idopont-btn" data-time="${t}">
                            ${t}
                        </button>
                    `;
                });
            });
        }
    });

    // --- IDŐPONT KIVÁLASZTÁS ---
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("idopont-btn")) {

            document.querySelectorAll(".idopont-btn").forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');

            kivalasztottIdopont = e.target.getAttribute("data-time");
            document.getElementById("foglalasBtn").disabled = false;

            console.log("Kiválasztott időpont: ", kivalasztottIdopont);
        }
    });

    // --- FOGALÁS KÜLDÉSE ---
    document.getElementById("foglalasBtn").addEventListener("click", function () {

        console.log("GOMB MEGNYOMVA!");

        let szolg = document.getElementById('szolgaltatas').value;
        let dolgozo = document.getElementById('dolgozo').value;
        let datum = document.getElementById('datum').value;

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
            console.log(data);
            alert(data.uzenet);
            location.reload();
        });

    });

});
</script>
@endsection
