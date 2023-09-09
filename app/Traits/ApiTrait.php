<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

trait ApiTrait
{

    public function getApiCustimized(string $query_param = null)
    {

        $rapid_api_key = env('API_RAPID_KEY');


        $api_response = collect(Http::withUrlParameters([
            'endpoint' => 'https://api.rawg.io/api/games?',
            'key' => $rapid_api_key,
            'query_search' => $query_param,


        ])->timeout(60)->get('{+endpoint}key={key}{query_search?}')->json()['results']);

        $required_fields = array_flip(['name', 'slug', 'background_image', 'rating', 'released', 'genres',]);

        $api_elements = [];
        foreach ($api_response as $outerkey => $array) {



            foreach ($array as $innerkey => $item) {


                if (array_key_exists($innerkey, $required_fields)) {



                    $api_elements[$outerkey][$innerkey] = $array[$innerkey];
                }
                if (isset($api_elements[$outerkey]['genres'])) {

                    break;
                }
            }
        }
        return $api_elements;
    }
}
