<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use App\Models\Category;
use App\Models\Answer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        $categories = [
            'Sports' => [
                ['Kurā gadā notika pirmās modernās olimpiskās spēles?', ['1896' => true, '1900' => false, '1912' => false, '1924' => false]],
                ['Kuram vīriešu tenisa spēlētājam ir visvairāk "Grand Slam" titulu?', ['Rafaels Nadals' => false, 'Rodžers Federers' => false, 'Novaks Džokovičš' => true, 'Pīts Samprass' => false]],
                ['Kura valsts ir uzvarējusi visvairāk "FIFA World Cup"?', ['Vācija' => false, 'Spānija' => false, 'Argentīna' => false, 'Brazīlija' => true]],
                ['Cik medaļu uzvarēja Latviešu sportisti Olimpiskajās un Paralimpiskajās spēlēs kopā?', ['1' => false, '2' => false, '3' => false, '4' => true]],
                ['Kura valsts bija pirmā, kas izcīnīja Pasaules kausu regbijā?', ['Austrālija' => false, 'Jaunzēlande' => true, 'Dienvidāfrika' => false, 'Anglija' => false]],
                ['Kurš bija pirmais hokejists, kurš NHL spēlē guva 50 vārtus vienā sezonā?', ['Gordijs Hovs' => false, 'Veins Greckis' => false, 'Mario Lemjē' => false, 'Moriss Rišārs' => true]],
                ['Kurā sporta veidā sacenšas "Tour de France" dalībnieki?', ['Riteņbraukšana' => true, 'Teniss' => false, 'Peldēšana' => false, 'Vieglatlētika' => false]],
                ['Kurā sporta veidā sacenšas "Dimanta Līgas" dalībnieki?', ['Peldēšana' => false, 'Golfs' => false, 'Zirgu jāšana' => false, 'Vieglatlētika' => true]],
                ['Kurš ir izcīnījis visvairāk Formula 1 pasaules čempiona titulus?', ['Mihaels Šūmahers' => false, 'Makss Verstapens' => false, 'Airtons Senna' => false, 'Luis Hamiltons' => true]],
                ['Kura valsts izcīnija pirmo FIFA sieviešu pasaules kausa titulu 1991. gadā?', ['Norvēģija' => false, 'ASV' => true, 'Vācija' => false, 'Anglija' => false]],
                ['Kurā sporta veidā Latvija izcīnīja savu pirmo olimpisko medaļu pēc neatkarības atgūšanas?', ['Kamaniņu sports' => true, 'BMX' => false, 'Vieglatlētika' => false, 'Hokejs' => false]],
                ['Cik reizes Austrālija ir uzvarējusi kriketa pasaules kausu?', ['3' => false, '4' => false, '5' => true, '6' => false]],
                ['Kurā stadionā notika 1966. gada FIFA Pasaules kausa fināls?', ['Santiago Bernabéu' => false, 'Old Trafford' => false, 'Wembley' => true, 'Camp Nou' => false]],
                ['Kura valsts uzvarēja zeltu Parīzes Olimpiskajās spēlēs volejbolā?', ['Francija' => true, 'Polija' => false, 'Ungārija' => false, 'ASV' => false]],
                ['Kurā sporta veidā piedalās sportisti, kas sacenšas par "America\'s Cup"?', ['Krikets' => false, 'Burāšana' => true, 'Beisbols' => false, 'Amerikāņu futbols' => false]],
            ],
            'Mūzika' => [
                ['Kurš bija "The Beatles" bundzinieks?', ['Džordžs Harisons' => false, 'Pols Makartijs' => false, 'Džons Lenons' => false, 'Ringo Stārs' => true]],
                ['Kura mūziķe izpilda dziesmu "Rolling in the Deep"?', ['Adele' => true, 'Beyonce' => false, 'Katy Perry' => false, 'Taylor Swift' => false]],
                ['Kurš ir "King of Pop"?', ['Elviss Preslijs' => false, 'Maikls Džeksons' => true, 'Džastins Bībers' => false, 'The Weeknd' => false]],
                ['Kura grupa izdeva albumu "Dark Side of the Moon"?', ['Led Zeppelin' => false, 'Pink Floyd' => true, 'The Rolling Stones' => false, 'The Who' => false]],
                ['Kurs komponists sarakstīja "Piekto simfoniju"', ['Antonio Vivaldi' => false, 'Johans Sebastians Bahs' => false, 'Volfgangs Amadejs Mocarts' => false, 'Ludvigs van Bēthovens' => true]],
                ['Kurā grupas dalībnieks bija Fredijs Merkurijs?', ['Queen' => true, 'Aerosmith' => false, 'Nirvana' => false, 'Guns N\'Roses' => false]],
                ['Kura valsts uzvarēja Eurovision 2021?', ['Francija' => false, 'Latvija' => false, 'Itālija' => true, 'Šveice' => false]],
                ['Kurš dzeidātājs uztāsies Super Bowl LVIII Ņū Orleanā?', ['Drake' => false, 'Lil Wayne' => false, 'Kendrick Lamar' => true, 'Travis Scott' => false]],
                ['Kurā mūzikas žanrā ir pazīstams mākslinieks Johnny Cash?', ['Country' => true, 'Rock' => false, 'Jazz' => false, 'Pop' => false]],
                ['Kurs mākslinieks ir ieguvis visvairāk Grammy balvas?', ['Taylor Swift' => false, 'Beyonce' => true, 'Jay-Z' => false, 'Snoop Dog' => false]],
                ['Cik Grammy ir visvairāk uzvarējušajam māksliniekam?', ['17' => false, '35' => false, '32' => true, '26' => false]],
                ['Kuram ir šobrīd ir visvairāk Spotify Monthly listeners?', ['Taylor Swift' => false, 'The Weeknd' => true, 'Sabrina Carpenter' => false, 'Coldplay' => false]],
                ['Kura dziesma ir vispopulārākā testa izveides brīdī?', ['Dancing In The Flames - The Weeknd' => true, 'Taste - Sabrina Carpenter' => false, 'BIRDS OF FEATHER - Billie Eilish' => false, 'Espresso - Sabrina Carpenter' => false]],
                ['Kurš ir visvairāk skatītais mūzikas video Youtube?', ['Luis Fonsi - Despacito' => true, 'Wiz Khalifa - See you again ft. Charlie Puth' => false, 'Ed Sheeran - Shape of you' => false, 'Mark Ronson - Uptown Funk ft. Bruno Mars' => false]],
                ['Kura dziesma pavadīja visvairāk laika topa #1 pozīcijā?', ['Luis Fonsi - Despacito' => false, 'Lil Nas X - Old Town Road' => true, 'Harry Styles - As It Was' => false, 'Mariah Carey - All I Want for Christmas Is You' => false]],
            ],
            'Filmas' => [
                ['Filmā "The Matrix" Neo izvēlas kuru tableti?', ['Zilo' => false, 'Zaļo' => false, 'Sarkano' => true, 'Dzelteno' => false]],
                ['Kurš režisēja pasaulslaveno filmu "The Godfather"?', ['Stīvens Spīlbergs' => false, 'Frānsiss Fords Kopola' => true, 'Mārtins Skorsēze' => false, 'Ridlijs Skots' => false]],
                ['Kurš aktieris izpildīja galveno lomu filmā "Forrest Gump"?', ['Džonijs Deps' => false, 'Breds Pits' => false, 'Džordžs Klūnijs' => false, 'Toms Henkss' => true]],
                ['Kurā filmā pirmoreiz parādījās Dārts Veiders?', ['"Star Wars: The Empire Strikes Back"' => false, '"Star Wars: The Return of Jedi"' => false, '"Star Wars: A New Hope"' => true, '"Star Wars: The Phantom Menace"' => false]],
                ['Kurš mūzikls 2016. gadā ieguva visvairāk Oskara balvas?', ['"Les Miserables"' => false, '"La La Land"' => true, '"Chicago"' => false, '"The Greatest Showman"' => false]],
                ['Kura ir visaugstāk vērtētā filma iMDb vēsturē?', ['"Schindler\'s List"' => false, '"The Godfather"' => false, '"The Dark Knight"' => false, '"The Shawshank Redemption"' => true]],
                ['Kurš režisēja filmu "Pulp Fiction"?', ['Martins Skorsēze' => false, 'Stīvens Spīlbergs' => false, 'Kristpfers Nolans' => false, 'Kventins Tarantino' => true]],
                ['Kura ir vispelnošākā filma vēsturē?', ['"Titanic"' => false, '"Avengers"' => false, '"Avatar: The Way of Water"' => false, '"Avatar"' => true]],
                ['Kurš aktieris attēloja "Joker" tēlu filmā "The Dark Knight"', ['Džeks Nikolsons' => false, 'Džareds Leto' => false, 'Hīts Ledžers' => true, 'Vakīns Fīnikss' => false]],
                ['Kurā filmā pirmoreiz tika izteikts slavenais teikums: "I see dead people"?', ['"The Sixth Sense"' => true, '"The Others"' => false, '"The Ring"' => false, '"Shutter Island"' => false]],
                ['Kurā filmā Mārtins Skorsēze un Leonardo Di Kaprio pirmo reizi sadarbojās?', ['"The Wolf of Wall Street"' => false, '"The Aviator"' => false, '"Gangs of New York"' => true, '"Shutter Island"' => false]],
                ['Kurā filmā piedalās robots, kurš pazīstams kā WALL-E?', ['Monsters Inc.' => false, 'WALL-E' => true, 'Robots' => false, '9' => false]],
                ['Kurš aktieris spēlēja galveno lomu filmā "The Matrix"?', ['Kianu Rīvs' => true, 'Breds Pits' => false, 'Toms Krūzs' => false, 'Vils Smits' => false]],
                ['Kurš režisēja filmu "Interstellar"?', ['Kristofers Nolans' => true, 'Džeimss Kamerons' => false, 'Deivids Finčers' => false, 'Kventins Tarantīno' => false]],
                ['Kurš bija pirmais basketbolists kurš uzvarēja Oskaru?', ['Kevins Durants - "Two Distant Strangers"' => false, 'Stefens Karijs - "Queen of Basketball"' => false, 'Kobe Braiants - "Dear Basketball"' => true, 'Šakīls Onīls - "Queen of Basketball"' => false]],
            ],
            'Ceļošana' => [
                ['Kurā pilsētā atrodas Eifeļa tornis?', ['Londona' => false, 'Rīga' => false, 'Parīze' => true, 'Roma' => false]],
                ['Kura valsts ir pazīstama ar fjordiem?', ['Zviedrija' => false, 'Norvēģija' => true, 'Dānija' => false, 'Islande' => false]],
                ['Kurš ir augstākais ūdenskritums pasaulē?', ['Niagaras ūdenskritums' => false, 'Viktorijas ūdenskritums' => false, 'Anhela ūdenskritums' => true, 'Iguazu ūdenskritums' => false]],
                ['Kurā pilsētā atrodas Sagrada Familia?', ['Lisabona' => false, 'Madride' => false, 'Barselona' => true, 'Seviļa' => false]],
                ['Kurš ir pasaulē augstākais kalns?', ['Kilimandžaro' => false, 'Montblāns' => false, 'Denali' => false, 'Everests' => true]],
                ['Kurš no šiem pasaules brīnumiem atrodas Jordānijā?', ['Tadžmahals' => false, 'Petra' => true, 'Kolizejs' => false, 'Lielais Ķīnas mūris' => false]],
                ['Kurā valstī atrodas Serengeti nacionālais parks?', ['Kenija' => false, 'Tanzānija' => true, 'Gabona' => false, 'Zambija' => false]],
                ['Cik gara ir pasaulē augstākā ēka?', ['829.8m' => true, '831.2m' => false, '828.1m' => false, '833.6m' => false]],
                ['Kurā pilsētā atrodas Lielais Kanāls?', ['Venēcija' => true, 'Amsterdama' => false, 'Brige' => false, 'Florence' => false]],
                ['Kurš ir pasaulē lielākais tuksnesis?', ['Arābijas tuksnesis' => false, 'Kalahari tuksnesis' => false, 'Sahāras tuksnesis' => false, 'Antarktīdas tuksnesis' => true]],
                ['Kur atrodas Vatikāns, pasaulē mazākā neatkarīgā valsts?', ['Venēcija' => false, 'Roma' => true, 'Milāna' => false, 'Turīna' => false]],
                ['Kurā valstī var atrast Akropoles kompleksu?', ['Turcija' => false, 'Grieķija' => true, 'Latvija' => false, 'Kipra' => false]],
                ['Kurā Latvijas pilsētā atrodas Rundāles pils?', ['Bauska' => true, 'Jelgava' => false, 'Cēsis' => false, 'Sigulda' => false]],
                ['Kurā valstī atrodas slavenā Angkor Wat tempļu kompleksa drupas?', ['Taizeme' => false, 'Kambodža' => true, 'Vjetnama' => false, 'Indija' => false]],
                ['Kura no šīm pilsētām bija visvairāk apmeklētākā 2023 gadā?', ['Antālija, Turcija' => false, 'Dubaija, AAE' => false, 'Londona, Anglija' => false, 'Stambula, Turcija' => true]],
            ],
            'Pārtika' => [
                ['No kuras valstīs nāk suši?', ['Ķīna' => false, 'Japāna' => true, 'Taizeme' => false, 'Vjetnama' => false]],
                ['Kurā valstī ir radusies pica?', ['Spānija' => false, 'Grieķija' => false, 'Itālija' => true, 'Francija' => false]],
                ['Kurš ir galvenais avokado sastāvdaļas guacamole mērcei?', ['Tomāti' => false, 'Avokado' => true, 'Sīpoli' => false, 'Paprika' => false]],
                ['Kurš auglis ir pazīstams kā "ķīniešu ābols"?', ['Apelsīns' => true, 'Greipfrūts' => false, 'Granātābols' => false, 'Papaija' => false]],
                ['Kurā valstī ir radies šokolādes deserts fondī?', ['Francija' => false, 'Šveice' => true, 'Beļģija' => false, 'Itālija' => false]],
                ['Kas ir galvenā sastāvdaļa humusam?', ['Burkāni' => false, 'Selerija' => false, 'Olas' => false, 'Auna zirņi' => true]],
                ['No kura reģiona nāk dzēriens "Tequila"?', ['Spānija' => false, 'Brazīlija' => false, 'Meksika' => true, 'Argentīna' => false]],
                ['Kurā valstī ir populārs ēdiens ceviche, kas teik pagatavots no marinētas zivs?', ['Peru' => true, 'Kuba' => false, 'Venceuēla' => false, 'Čehija' => false]],
                ['No kuras valsts nāk ēdiens "Paella"?', ['Portugāle' => false, 'Spānija' => true, 'Greiķija' => false, 'Bolīvija' => false]],
                ['Kuru sieru izmanto tradicionālajā "Caprese" salātā?', ['Feta' => false, 'Čedars' => false, 'Mocarella' => true, 'Parmezāns' => false]],
                ['Kas ir galvenā "Tiramisu" deserta satāvdaļa?', ['Kartupeļi' => false, 'Mascarpone siers' => true, 'Sviests' => false, 'Šokolāde' => false]],
                ['Kurā valstī radies vīns "Portvīņs"?', ['Francija' => false, 'Spānija' => false, 'Portugāle' => true, 'Itālija' => false]],
                ['Kas ir "Tempura"?', ['Grilēta gaļa' => false, 'Ceptas zivis un dārzeņi' => true, 'Marinēti dārzeņi' => false, 'Tvaicēti rīsi ar gurķiem' => false]],
                ['Kas ir Latvijas nacionālais ēdiens?', ['Pelēkie zirņi' => true, 'Sklandrauši' => false, 'Sālīta/marinēta siļķe' => false, 'Rupjmaize' => false]],
            ],
            'Gaming' => [
                ['Kurš izstrādāja spēli "Minecraft"?', ['EA Sports' => false, 'Notch' => true, 'Blizzard Entertainment' => false, 'Ubisoft' => false]],
                ['Kura spēle pazīstama ar saukli "Finish Him"?', ['Tekken' => false, 'Mortal Combat' => true, 'Street Fighter' => false, 'Injustice' => false]],
                ['Kurā gadā tika izlaista pirmā "The Legend of Zelda" spēle?', ['1983. gads' => false, '1986. gads' => true, '1990. gads' => false, '1995. gads' => false]],
                ['Kas ir galvenais varonis spēlē "The Witcher"?', ['Geralts no Rivijas' => true, 'Ezio Auditore' => false, 'Lara Krofta' => false, 'Kratos' => false]],
                ['Kurā spēlē tiek izmantota virtuālā valūta "V-Bucks"?', ['Fortnite' => true, 'Apex Legends' => false, 'Call of Duty' => false, 'Overwatch' => false]],
                ['Kurš uzņēmums ir izstrādājis konsoli "PlayStation"?', ['Microsoft' => false, 'Nintendo' => false, 'Sony' => true, 'Sega' => false]],
                ['Kurā spēļu sērijā ir sastopams varonis vārdā Master Chief?', ['Gears of War' => false, 'Halo' => true, 'Doom' => false, 'Call of Duty' => false]],
                ['Kurā spēlē Mario pirmoreiz parādījās kā galvenais varonis?', ['Donkey Kong' => true, 'Super Mario Bros' => false, 'Mario Kart' => false, 'Luigis Mansion' => false]],
                ['Kura ir vislabāk pārdotā videospēle pasaulē?', ['Tetris' => false, 'Minecraft' => true, 'GTA V' => false, 'Wii Sports' => false]],
                ['Kura no šīm spēlēm ir Battle Royale žanra pamatlicēja?', ['COD: Warzone' => false, 'PUBG' => true, 'Fortnite' => false, 'Apec Legends' => false]],
                ['Kurš ir galvenais varonis spēlē "God of War"?', ['Artreus' => false, 'Thor' => false, 'Kratos' => true, 'Zeus' => false]],
                ['Kurā gadā izlaista pirmā "Call of Duty" spēle?', ['1998' => false, '2001' => false, '2003' => true, '2005' => false]],
                ['Kurā no šīm spēlēm piedalās varonis vārdā Nathaniel Drake?', ['Tomb Raider' => false, 'Uncharted' => true, 'Far Cry' => false, 'Metal Gear Solid' => false]],
                ['Kurš ir pazīstams kā "Pasaules spēcīgākais pokemons"?', ['Pikachu' => false, 'Charizard' => false, 'Mewtwo' => false, 'Arceus' => true]],
                [
                    'Kura spēle ir izstrādāta Latvijā un ataino Latvijas ielas un vidi?',
                    ['GTA' => false, 'Kaut Kāds Ielu Gang' => true, 'Watch Dogs' => false, 'Cyberpunk 2077' => false]
                ]
            ],
        ];

        foreach ($categories as $categoryName => $questions) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($questions as $questionData) {
                [$questionText, $answers] = $questionData;

                $question = Question::create([
                    'category_id' => $category->id,
                    'question' => $questionText
                ]);

                foreach ($answers as $answerText => $isCorrect) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer' => $answerText,
                        'is_correct' => $isCorrect
                    ]);
                }
            }
        }
    }
}
