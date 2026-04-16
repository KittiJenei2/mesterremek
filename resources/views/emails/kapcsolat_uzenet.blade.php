@component('mail::message')
# Új kapcsolatfelvételi üzenet érkezett a weboldalról!

**Feladó neve:** {{ $adatok['name'] }}
**E-mail címe:** {{ $adatok['email'] }}
**Tárgy:** {{ $adatok['subject'] }}

**Üzenet:**
{{ $adatok['message'] }}

Üdvözlettel,<br>
Fresh Szalon Rendszer
@endcomponent