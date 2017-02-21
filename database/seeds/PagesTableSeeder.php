<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            ['title' => 'about us', 'content' => '<div class="responsive-height-block"><!-- Important --></div>
    <main class="about-main">
    <div class="container">
        <div class="row text-center">
            <div>
                <img src="/images/about/about-logo.png" alt="about-logo.png">
            </div>
            <div class="col-sm-6">
                <h1>Մեր Մասին</h1>
                <p>
                    Fitness Cook Ապրանքանիշը ներկայացնում է թխվածքների և հացերի տեսականի, որոնք Չեն Պարունակում ալյուր, շաքար (Sugar Free), գլյուտեն (Gluten Free), թթխմորներ (Дрожжи), ունեն շատ ցածր կալորիականություն և պատրաստվում են 100% բնական հումքից։
                    <br><br>
                    Ալյուրի փոխարեն մենք օգտագործում ենք վարսակի թեփ (Овсяные Отруби), իսկ շաքարի փոխարեն օգտագործում ենք Ստեվիա (стевия), ամեն ինչ պատրաստվում է անյուղ կաթնամթերքից և չի պարունակում կարագ և քիմիական հավելանյութեր։
                    <br><br>
                    Եղեք Առողջ և Քաղցրակեր :)
                </p>
            </div>
            <div class="col-sm-6">
                <div class="video-wrap">
                    <iframe width="100%" height="280" src="https://www.youtube.com/embed/5Zzz2ZyjigU" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>']
        ]);
    }
}
