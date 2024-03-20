### Procenten-rekentool

Deze tool is bedoeld om het begrip van rekenen met procenten te vergroten in het kader van het vak rekenen op het MBO niveau 4, in het bijzonder aan de Software Developer opleiding aan het Alfa-college locatie Boumaboulevard.

#### Het rekenmodel

De benadering van het hele procentenrekenen is geschoeid op het concept met vermenigvuldigingsfactoren (of groeifactoren, of kortweg factoren): bij elke procentsom kun je een **factor** bedenken. Daarnaast is er altijd sprake van een **oud**-bedrag en een **nieuw**-bedrag. Het verband tussen deze 3 variabelen is te schrijven op 3 manieren:

1. nieuw = factor * oud &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(denk aan: 6 = 2 * 3)
2. oud = nieuw / factor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(denk aan: 3 = 6 / 2)
3. factor = nieuw / oud &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(denk aan 2 = 6 / 3)

***Bij elke procentsom kun je op basis van de factor spreken van 3 soorten:***

1. je neemt ergens 'zoveel % van'
2. er is sprake van toename
3. er is sprake van afname

***De soort en de factor zijn onlosmakelijk aan elkaar verbonden***

#### Wat de tool kan (functioneel ontwerp - voor de klant)

Als een gebruiker een procentsom op moet lossen, moet de gebruiker uit de som waarden voor 2 van de 3 variabelen vinden. Met deze 2 waarden van variabelen kan de waarde van de 3<sup>e</sup> variabele uitgerekend worden - zie alinea hier boven.

De gebruiker moet daartoe de 2 gevonden waarden op de juiste plek invoeren in de tool. Als de 2 waarden zijn ingevuld, wordt de 'Los op'-knop actief en na het klikken op deze knop kan de gebruiker het antwoord aflezen uit de tool.

Door deze tool te ontwikkelen wordt hopelijk het begrip van procenten vergroot en het hele concept van werken met een factor maakt dat hulpmiddelen als verhoudingstabellen tot het verleden behoren.

#### Technisch ontwerp ####

1. onze app moet steeds checken of 2 van de 3 variabelen een waarde hebben gekregen; dus onder elk input-veld moet een onchange-listener komen die checkt of er 2 van de 3 waarden ingevuld zijn; deze functie heet `checkInput()`
    - `checkInput()` moet na het invullen (`onchange`) bij 3 input velden checken of er wat staat; daarom:  
    `const oud = document.getElementById("oud")`,  
    `const nieuw = document.getElementById("nieuw")`,  
    `const percentage = document.getElementById("percentage")` i.c.m  
    `const soort = document.getElementById("soort")`
    - de combinatie van gekozen soort.value en percentage.value leidt tot de factor:
        - als `soort.value == 1` dan geldt:  
        `factor = percentage.value / 100`
        - als `soort.value == 2` dan geldt:  
        `factor = 1 + percentage.value / 100`
        - als `soort.value == 3` dan geldt:  
        `factor = 1 - percentage.value / 100`
    - als er 2 van de 3 ingevuld zijn, dan:
    
    `if(oud.value != '' && percentage.value != '' && soort.value != '')`   
    `{ nieuw.value = oud.value * factor }`  
    `elseif(nieuw.value != '' && percentage.value != '' && soort.value != '')`  
    `{ oud.value = nieuw.value / factor }`  
    `elseif(oud.value != '' && nieuw.value != '')`  
    `{ factor = nieuw.value / oud.value`  
        `if(factor > 1) { soort.value = 2`  
        `percentage.value = (factor - 1) * 100 }`  
        `else { soort.value = 3`
                `percentage.value = (1 - factor) * 100 }`
    `} else`  
    {doe niks}  
2. als er 2 van de 3 gevuld zijn, moet het attribuut `disabled` van de Los op-knop verwijderd worden zodat de knop actief wordt. Vergelijkbaar moet de `class='is-invalid'` van een inputveld dat gevuld is, veranderen in `class='is-valid'`
3. als de gebruiker vervolgens op de Los op-knop klikt, moet de waarde van de overgebleven variabele gevuld worden met het juiste antwoord
