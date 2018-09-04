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

        $first_level = $this->getFirstLevel();
        $level = 1;

        foreach ($first_level as $word) {
            $response = json_decode(file_get_contents('http://api.datamuse.com/words?sp='.$word.'&md=d'), true);

            if (empty($response[0]['defs'][0])) {
                continue;
            }

            $definition = $response[0]['defs'][0];

            $definition = str_replace("adv\t", '', $definition);
            $definition = str_replace("adj\t", '', $definition);
            $definition = str_replace("v\t", '', $definition);
            $definition = str_replace("n\t", '', $definition);

            DB::table('words')->insert([
                'word'       => $word,
                'definition' => $definition,
                'level'      => $level,
            ]);
        }
    }

    private function getWordJSON(): array
    {
        $json = Storage::disk('local')->get('dictionary.json');

        return json_decode($json, true);
    }

    private function getFirstLevel(): array
    {
        return [
            'about',
            'after',
            'again',
            'also',
            'another',
            'any',
            'ask',
            'back',
            'because',
            'been',
            'before',
            'by',
            'could',
            'are',
            'easy',
            'listen',
            'second',
            'they',
            'answer',
            'enough',
            'make',
            'since',
            'thing',
            'above',
            'first',
            'made',
            'sometimes',
            'usually',
            'another',
            'found',
            'more',
            'said',
            'use',
            'about',
            'float',
            'many',
            'saw',
            'very',
            'after',
            'friends',
            'new',
            'sure',
            'with',
            'again',
            'favorite',
            'nice',
            'school',
            'went',
            'before',
            'girl',
            'one',
            'small',
            'won',
            'because',
            'have',
            'our',
            'thank',
            'won’t',
            'best',
            'how',
            'other',
            'those',
            'where',
            'being',
            'hear',
            'off',
            'that’s',
            'were',
            'body',
            'house',
            'often',
            'talking',
            'wanted',
            'beautiful',
            'however',
            'outside',
            'them',
            'who',
            'brothers',
            'heard',
            'people',
            'to',
            'wrong',
            'could',
            'its',
            'phone',
            'two',
            'when',
            'can’t',
            'into',
            'pretty',
            'too',
            'what',
            'city',
            'idea',
            'piece',
            'tell',
            'will',
            'clock',
            'joke',
            'quit',
            'there',
            'write',
            'crash',
            'jump',
            'question',
            'they’re',
            'watch',
            'caught',
            'junk',
            'ride',
            'their',
            'why',
            'children',
            'knew',
            'right',
            'thought',
            'was',
            'don’t',
            'kicked',
            'rain',
            'through',
            'whole',
            'didn’t',
            'low',
            'really',
            'than',
            'we',
            'drink',
            'line',
            'sister',
            'then',
            'young',
            'eating',
            'little',
        ];
    }
}
