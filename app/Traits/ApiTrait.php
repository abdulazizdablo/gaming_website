<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

trait ApiTrait
{

    public function getApiCustimized(?string $filter_data_determination)
    {
        $rapid_api_key = env('API_RAPID_KEY');


        $api_response = Http::withUrlParameters([
            'endpoint' => 'https://api.rawg.io/api/games?',
            'key' => $rapid_api_key

        ])->timeout(60)->get('{+endpoint}key={key}');





        /*$desired_games = array_intersect_key(
    $api_response['results'],  // the array with all keys
    array_intersect_key(['name', 'released', 'last_name','genres']) // keys to be extracted
);*/



        /*$callback = fn( $k,  $v): string => "$k was the $v";*/
        /*$desired_games = [];

$desired_games = array_map(function ($array) {
$array = array_flip(['name', 'released','genres']);

	return array_intersect_key(['name', 'released','genres','rating']);
}, $api_response['results']);*/


        $api_response_resutls = $api_response['results'];
        $required_fields = array_flip(['name', 'background_image', 'rating', 'released', 'genres',]);
        /* dd($api_response_resutls);*/
        $api_elements = [];
        foreach ($api_response_resutls as $outerkey => $array) {

            $api_elements[$outerkey] = array_intersect($array, $required_fields);



            /* foreach ($array as $innerkey => $item) {


                if (array_key_exists($innerkey, $required_fields)) {




                    $api_elements[$outerkey][$innerkey] = $array[$innerkey];
                }
                if (isset($api_response_resutls['genres'])) {

                    break;
                }
            }*/
        }
        /*


        $api_required_elements = array_map(
            function ($api_response_resutls) use ($required_fields) {
                $api_elements = [];
                foreach ($api_response_resutls as  $key => $array) {
                    
                    foreach ($array as $k => $values)

                    if (array_key_exists($k, $required_fields)) {




                        $api_elements[$required_fields] = $api_response_resutls[$required_fields];


                        return   $api_elements;
                    }
                }
            },
            $api_response_resutls
        );


        /* foreach ($api_response['results'] as $key => $array) {
        }


        /*foreach ($api_response['results'] as $key => $array){




}*/


        /*$gamescollection = collect($api_response);*/




        // adding filter feature to api respone elements which is multidimensional array
        // this functionality will make a collection and iterate over nested items to order
        // items corresponding to the $filter_determination factor if exist


        $collection_api_result = collect($api_elements);



        $filter_data_determination  ??
            $collection_api_result->eachSpread(function ($array) use ($filter_data_determination) {

                $array->sortBy($filter_data_determination);
            });

        if ($collection_api_result) return $collection_api_result;


        return $api_elements;


        var_dump($api_elements);
    }
}
