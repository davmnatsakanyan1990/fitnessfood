<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_pages')->insert([
                [
                    'title' => '{"am":"Գլխավոր","ru":"Главный","en":"Home"}',
                    'content' => '{"am":" <div class=\"row text-center\"> <div class=\"col-sm-6\"> <h1>Մեր Մասին<\/h1>\n                <p>\n                    Fitness Cook Ապրանքանիշը ներկայացնում է թխվածքների և հացերի տեսականի, որոնք Չեն Պարունակում ալյուր, շաքար (Sugar Free), գլյուտեն (Gluten Free), թթխմորներ (Дрожжи), ունեն շատ ցածր կալորիականություն և պատրաստվում են 100% բնական հումքից։\n                    <br><br>\n                    Ալյուրի փոխարեն մենք օգտագործում ենք վարսակի թեփ (Овсяные Отруби), իսկ շաքարի փոխարեն օգտագործում ենք Ստեվիա (стевия), ամեն ինչ պատրաստվում է անյուղ կաթնամթերքից և չի պարունակում կարագ և քիմիական հավելանյութեր։\n                    <br><br>\n                    Եղեք Առողջ և Քաղցրակեր :)\n                <\/p>\n            <\/div>\n            <div class=\"col-sm-6\">\n                <div class=\"video-wrap\">\n                    <iframe width=\"100%\" height=\"280\" src=\"https:\/\/www.youtube.com\/embed\/5Zzz2ZyjigU\" frameborder=\"0\" allowfullscreen=\"\"><\/iframe>\n                <\/div>\n            <\/div>\n<\/div>\n                                        ","ru":"\n        <div class=\"row text-center\">\n             <div class=\"col-sm-6\">\n                <h1>Մեր Մասին<\/h1>\n                <p>\n                    Fitness Cook Ապրանքանիշը ներկայացնում է թխվածքների և հացերի տեսականի, որոնք Չեն Պարունակում ալյուր, շաքար (Sugar Free), գլյուտեն (Gluten Free), թթխմորներ (Дрожжи), ունեն շատ ցածր կալորիականություն և պատրաստվում են 100% բնական հումքից։\n                    <br><br>\n                    Ալյուրի փոխարեն մենք օգտագործում ենք վարսակի թեփ (Овсяные Отруби), իսկ շաքարի փոխարեն օգտագործում ենք Ստեվիա (стевия), ամեն ինչ պատրաստվում է անյուղ կաթնամթերքից և չի պարունակում կարագ և քիմիական հավելանյութեր։\n                    <br><br>\n                    Եղեք Առողջ և Քաղցրակեր :)\n                <\/p>\n            <\/div>\n            <div class=\"col-sm-6\">\n                <div class=\"video-wrap\">\n                    <iframe width=\"100%\" height=\"280\" src=\"https:\/\/www.youtube.com\/embed\/5Zzz2ZyjigU\" frameborder=\"0\" allowfullscreen=\"\"><\/iframe>\n                <\/div>\n            <\/div>\n<\/div>\n                                        ","en":"\n        <div class=\"row text-center\">\n            <div class=\"col-sm-6\">\n                <h1>Մեր Մասին<\/h1>\n                <p>\n                    Fitness Cook Ապրանքանիշը ներկայացնում է թխվածքների և հացերի տեսականի, որոնք Չեն Պարունակում ալյուր, շաքար (Sugar Free), գլյուտեն (Gluten Free), թթխմորներ (Дрожжи), ունեն շատ ցածր կալորիականություն և պատրաստվում են 100% բնական հումքից։\n                    <br><br>\n                    Ալյուրի փոխարեն մենք օգտագործում ենք վարսակի թեփ (Овсяные Отруби), իսկ շաքարի փոխարեն օգտագործում ենք Ստեվիա (стевия), ամեն ինչ պատրաստվում է անյուղ կաթնամթերքից և չի պարունակում կարագ և քիմիական հավելանյութեր։\n                    <br><br>\n                    Եղեք Առողջ և Քաղցրակեր :)\n                <\/p>\n            <\/div>\n            <div class=\"col-sm-6\">\n                <div class=\"video-wrap\">\n                    <iframe width=\"100%\" height=\"280\" src=\"https:\/\/www.youtube.com\/embed\/5Zzz2ZyjigU\" frameborder=\"0\" allowfullscreen=\"\"><\/iframe>\n                <\/div>\n            <\/div>\n        <\/div>"}',
                    'page_id' => 1
                ]
        ]);
    }
}
