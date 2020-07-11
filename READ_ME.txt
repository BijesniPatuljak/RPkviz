login.php je prva stranica aplikacije
On poziva init.php (trebamo tu liniju maknuti iz komentara prilikom prvog poziva)
Ako se logiramo s imenom 'admin' dat će nam mogućnost ubacivanja novih kvizova i novih pitanja
U protivnom možemo otvoriti stare kvizove i rješavati ih

To se odvija na stranici menu.php

Ako odlučimo igrati kviz pralazimo na stranice load_quiz i rezultat

U protivnom ubacujemo novi kviz ili novo pitanje u kviz za što se brinu preostale datoteke ovisno o potrebi:
Ulazimo u create_quiz1 za unos imena kviza i create_quiz2 za odabir tipa pitanja
Potom se create_question-i brinu za izradu pojedinih pitanja

Komunikacija s bazom podataka, definiranje tablica i njihovo inicijalno seedanje se vrše u datotekama iz direktorija database

U direktoriju model se nalaze definicije klasa i funkcija koje koristimo u aplikaciji