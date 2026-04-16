<!DOCTYPE html>
<html>
<head>
    <title>Időpont módosítva</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #ffc107;">Kedves {{ $adatok['nev'] }}!</h2>
    <p>Sikeresen módosítottad a foglalásod időpontját. A frissített részletek:</p>
    
    <div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;">
        <p><strong>Szolgáltatás:</strong> {{ $adatok['szolgaltatas'] }}</p>
        <p><strong>Szakember:</strong> {{ $adatok['dolgozo'] }}</p>
        <p><strong>Dátum:</strong> {{ $adatok['datum'] }}</p>
        <p style="color: #d39e00; font-size: 1.1em;"><strong>Új időpont:</strong> {{ substr($adatok['uj_ido'], 0, 5) }}</p>
    </div>

    <p>Sok szeretettel várunk!</p>
    <p>Üdvözlettel,<br><strong>A Fresh Szalon csapata</strong></p>
</body>
</html>