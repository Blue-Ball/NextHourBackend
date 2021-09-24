 foreach ($menu_items as $value) {
            if ($value->movie_id != null) {
                if($request->tmdb == "on"){
                    $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->where('tmdb','Y')->first());
                }elseif($request->age_rating != 0){
                    if($request->age_rating == "all"){
                         $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->first());
                    }else{
                        $age = $request->age_rating . '+';
                         $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->where('maturity_rating','>=',$age)->first());
                    }
                   
                }
                elseif($request->featured){
                     $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->where('featured',1)->first());
                }
                elseif($request->upcoming == "on"){
                     $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->where('is_upcoming',1)->first());
                }
                elseif($request->title != 0){
                    $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->orderBy('title',$request->title)->first());
                }else{
                    $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->first());
                }
                

            } else {

                $ts = TvSeries::where('id', $value->tv_series_id)->where('status', 1)->first();
                if (isset($ts)) {
                    $x = count($ts->seasons);

                    if ($x == 0) {

                    } else {
                        $items->push($ts->seasons[0]);
                    }

                }

            }
        }