<?php

use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('words')->delete();

        $json = $this->getWordJSON();

        foreach ($json as $word => $info) {
            if ( empty( $info['definitions'][0]['definition'] ) ) {
                continue;
            }

            DB::table('words')->insert([
                'word'       => $word,
                'definition' => $info['definitions'][0]['definition'],
            ]);
        }
    }

    private function getWordJSON(): array
    {
        $json = Storage::disk('local')->get('words-definitions.json');

        return json_decode($json, true);
    }
}
