# presentie-tool
PresentieTool die ik voor MediaCollege heb gemaakt.

## file-based database 
Gezien de hoeveelheid data die wordt verzameld heb ik gekozen voor een file-based database, de data is te vinden in data :)

## Onesignal Account.
Deze tool is gekoppeld aan een one-signal account, voor push-notifications. Dit is de enige webworker die erinzit.
Het is geen volledige webapp.

## features
### Leerling
- present zetten via school wifi= gecontroleerd of je er bent. (sort of) Het wordt in praktijk nu wel gebruikt als bewijs.
- Met check_student.php kun je voor een leerling in een bepaalde periode alle gemelde presentie zien.
- De lokalen waar je mag zitten, zitten in dropdown box
- mogelijkheid om een ander lokaal op te geven. Wordt nu vaak gebruikt voor opgeven activiteiten buiten school.
- Geeft aan welk uur het NU is (en aantal minuten van uur in svg ernaast).
- Geeft een overzicht, waarin naar jouw entry wordt gescrolled.
- sorteren op bedrijf geeft overzicht waar jouw bedrijfsleden zijn.
- push notificaties (40% gebruikt dit)
- bel signaal (als je de browser open laat staan, velen doen dat)

### Leerkracht
- directe (openbare) toegang tot lijst.
- zelfde sortering als magister.
- ook op achternaam sortering mogelijk.
- terugbladeren naar vorige presenties.
- check_student.
- auto refresh

### algemeen
- easy access via http://snoh.hosts.ma-cloud.nl/ links boven.
- regels voor presentie en smoelenboek in de LET-OP-balk.
- houd locatie vast bij geen melding, maar telt niet als 'bewijs'. (oogje)
- legenda wat alle kleurtjes betekenen.

## security issues
- geen https
- IP-adres is geen bewijs
- fingerprinting van leerlingen bleek in de praktijk niet handig, aangezien leerlingen veel devices gebruiken om zich aan te melden. 
- fingerprint: Het opnieuw zetten van een fingerprint ging via de schoolmail.
- fingerprint: Het bijhouden van meerdere fingerprints voor een leerling is minder makkelijk en zou voor volledigheid ontdubbeld moeten worden met andere leerlingen.
- de makkelijkste manier is nu om een leerling die op school IS te vragen jou even present te zetten, het enige dat nodig is, is je leerling nummer.
