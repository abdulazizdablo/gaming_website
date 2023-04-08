<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

trait ApiTrait
{

    public function getApiCustimized(string $filter_data_determination = null, string $query_param = null)
    {




        $rapid_api_key = env('API_RAPID_KEY');





        collect($api_response = Http::withUrlParameters([
            'endpoint' => 'https://api.rawg.io/api/games?',
            'key' => $rapid_api_key,
            'query_search' => $query_param


        ])->timeout(60)->get('{+endpoint}key={key}{query_search?}')['results']);








        $required_fields = array_flip(['name', 'background_image', 'rating', 'released', 'genres',]);
        /* dd($api_response_resutls);*/
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

        //}
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


        /*$collection_api_result = collect($api_elements);



        $collect = $collection_api_result->groupBy(function (array $item, int $key) use($filter_data_determination) {
          if($filter_data_determination == 'genres'){
            return $item['genres'][0]['name'];}
              return $item[$filter_data_determination];

        }); */     /*  $collection_api_result->map(function ($array) use ($filter_data_determination) {
               
$array = collect($array);

  $array->groupBy((fn ($array) => $array['genres'][0] ));
    
      */

        /*$array->sortBy('genres');*/

        /*$result = $collection_api_result->groupBy (fn ($item) => $item['genres'][0]['name']*/
        /*  }*/
        /* )*/
       return($api_elements);
       

    }

}
