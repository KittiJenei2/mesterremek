<!DOCTYPE html>
<html>
<head>
    <title>Időpont lemondva</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #dc3545;">Kedves {{ $adatok['nev'] }}!</h2>
    <p>Értesítünk, hogy az alábbi időpontodat sikeresen lemondtad a rendszerünkben:</p>
    
    <div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #dc3545; margin: 20px 0;">
        <p><strong>Szolgáltatás:</strong> {{ $adatok['szolgaltatas'] }}</p>
        <p><strong>Szakember:</strong> {{ $adatok['dolgozo'] }}</p>
        <p><strong>Dátum:</strong> {{ $adatok['datum'] }}</p>
        <p><strong>Eredeti időpont:</strong> {{ substr($adatok['ido'], 0, 5) }}</p>
    </div>

    <p>Sajnáljuk, hogy most nem tudsz eljönni. Bármikor foglalhatsz új időpontot a weboldalunkon!</p>
    <p>Üdvözlettel,<br><strong>A Fresh Szalon csapata</strong></p>
</body>
</html>