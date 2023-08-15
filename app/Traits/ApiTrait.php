<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

trait ApiTrait
{

    public function getApiCustimized(string $filter_data_determination = null, string $query_param = null)
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






        // adding filter feature to api respone elements which is multidimensional array
        // this functionality will make a collection and iterate over nested items to order
        // items corresponding to the $filter_determination factor if exist


        $collection_api_result = collect($api_elements);


        $collect = collect($api_elements)->groupBy(function($item) use($filter_data_determination) {
            if($filter_data_determination == 'genres'){
              return $item['genres'][0]['name'];}
            return $item[$filter_data_determination];
          })->keyBy(function($item) {
            return $item['name'];
          });
          return $api_elements;
}
}

