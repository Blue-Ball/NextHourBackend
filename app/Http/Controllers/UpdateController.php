<?php

namespace App\Http\Controllers;

use App\Config;
use Artisan;
use Carbon\Carbon;
use Crypt;
use Hash;
use App\AppConfig;
use App\AppSlider;
use App\SplashScreen;
use App\Movie;
use App\ChatSetting;
use App\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan as FacadesArtisan;
use Illuminate\Support\Facades\Validator;
use Session;
use App\ColorScheme;
use App\Http\Controllers\InitializeController;
use Illuminate\Support\Facades\Http;

class UpdateController extends Controller
{
       //Existing user 
    public function exitterm(){
        return view('install.existeula');
    }


    public function updateeula(Request $request){
        $d = \Request::getHost();
        $domain = str_replace("www.", "", $d);  
        if(strstr($domain,'localhost') || strstr($domain,'.test') || strstr($domain,'mediacity.co.in') || strstr($domain,'castleindia.in')){
             $put = 1;
            file_put_contents(public_path().'/config.txt', $put);
            return $this->process($request);
        }
        else{
            
            $request->validate([
            'eula' => 'required',
            'domain'=>'required',
            'code'=>'required'
        ],
        [
            'eula.required'=>'Please accept Terms and Conditions !',
            'domain.required'=>'Please enter your domain name !',
            'code.required'=>'Please enter your envato purchase code !'
        ]);

            $alldata = ['app_id' => "24626244", 'ip' => $request->ip(), 'domain' => $domain , 'code' => $request->code];
        
            $data = $this->make_request($alldata);

            if ($data['status'] == 1)
            {

                $put = 1;
                file_put_contents(public_path().'/config.txt', $put);
                return $this->process($request);
            }
            elseif ($data['msg'] == 'Already Register')
            {  
                
                return back()->withInput()->with('deleted','User is already registered');
            }
            else
            {
                return back()->withInput()->with('deleted',$data['msg']);
            }


        }
        
        

    }



  public function process($request){
    
    
                ini_set('memory_limit', '-1');

                try
                {
                    \DB::connection()
                        ->getPdo();

                   

                        if (\Schema::hasTable('configs')) {

                            try{
                                // Artisan::call('migrate', [
                                //     '--path' => 'database/migrations/existing',
                                //     '--force' => true,
                                // ]);
                                Artisan::call('migrate --path=database/migrations/existing');
                                Artisan::call('migrate --path=database/migrations/update_3_1');
                                Artisan::call('migrate --path=database/migrations/update_v3_2');
                                Artisan::call('migrate --path=database/migrations/update_v3_3');
                                Artisan::call('migrate --path=database/migrations/update_v3_4');
                                Artisan::call('migrate --path=database/migrations/update_v4_0');

                               
                                if(\Schema::hasTable('chat_settngs')){
                                    $chat_setting = ChatSetting::first();
                                    if(!isset($chat_setting)){
                                         Artisan::call('db:seed' ,['--class'=>'ChatSettingsTableSeeder']);
                                    }
                                       
                                  
                                }
                                if(\Schema::hasTable('app_sliders')){
                                    $app_slider = AppSlider::first();
                                    if(!isset($app_slider)){
                                        Artisan::call('db:seed' ,['--class'=>'AppSlidersTableSeeder']);
                                    }
                                       
                                  
                                }
                                if(\Schema::hasTable('app_configs')){
                                    $app_config = AppConfig::first();
                                    if(!isset($app_config)){
                                        Artisan::call('db:seed' ,['--class'=>'AppConfigsTableSeeder']);
                                    }
                                       
                                  
                                }
                                if(\Schema::hasTable('splash_screens')){
                                    $splashscreen = SplashScreen::first();
                                    if(!isset($splashscreen)){
                                        Artisan::call('db:seed' ,['--class'=>'SplashScreensTableSeeder']);
                                    }
                                }

                                if(\Schema::hasTable('oauth_clients')){
                                    $outhclient = \DB::table('oauth_clients')->get();
                                    if(!isset($outhclient) ){
                                        Artisan::call('db:seed' ,['--class'=>'OauthClientsTableSeeder']);
                                    }
                                }

                                if(\Schema::hasTable('oauth_personal_access_clients')){
                                    $outhpersonalaccess = \DB::table('oauth_personal_access_clients')->first();
                                    if(!isset($outhpersonalaccess) ){
                                        Artisan::call('db:seed' ,['--class'=>'OauthPersonalAccessClientsTableSeeder']);
                                    }
                                }

                                if(\Schema::hasTable('color_schemes')){
                                    $color_setting = ColorScheme::first();
                                    if(!isset($color_setting)){
                                        Artisan::call('db:seed' ,['--class'=>'ColorSchemesTableSeeder']);
                                    }
                                }

                                $movies = Movie::where('slug','=', NULL)->get();
                                if(isset($movies) && count($movies) > 0){
                                    foreach($movies as $movie){
                                     $m = Movie::find($movie->id);
                                     if(isset($m)){
                                        $m->slug = str_slug($m->title, '-');
                                        $m->slug;
                                        $m->save();
                                     }
                                        
                                    }
                                }
                                


                                $seasons = Season::where('season_slug','=', NULL)->get();
                                if(isset($seasons) && count($seasons) > 0){
                                    foreach($seasons as $season){
                                    $s = Season::find($season->id);
                                        if(isset($s)){
                                            $s->season_slug = str_slug($s->tvseries->title . '-season-' . $s->season_no, '-');;
                                            $s->save();
                                         }
                                   
                                    }
                                }
                               
                              

                               $this->changeEnv(['IS_INSTALLED' => '1','APP_DEBUG' => false]);
                               if (!file_exists(storage_path() . '/app/keys/license.json')) {

                                    /** License Migration Process */

                                    $token = @file_get_contents(public_path() . '/intialize.txt');
                                    $code = @file_get_contents(public_path() . '/code.txt');
                                    $domain = @file_get_contents(public_path() . '/ddtl.txt');

                                    if ($token != '' && $code != '') {

                                        $lic_json = array(
                                            
                                            'name' => auth()->user()->name,
                                            'code' => $code,
                                            'type' => __('envato'),
                                            'domain' => $domain,
                                            'lic_type' => __('regular'),
                                            'token' => $token

                                        );

                                        $file = json_encode($lic_json);

                                        $filename = 'license.json';

                                        Storage::disk('local')->put('/keys/' . $filename, $file);

                                        /** Delete this token files */

                                        try {

                                            $token ? unlink(public_path() . '/intialize.txt') : '';
                                            $code ? unlink(public_path() . '/code.txt') : '';
                                            $domain ? unlink(public_path() . '/ddtl.txt') : '';

                                        } catch (\Exception $e) {
                                            Log::error('Failed to migrate license reason : ' . $e->getMessage());
                                        }

                                    }

                                   
                                }

                                
                                return redirect('/')->with('added','Updated Successfully');
                            }
                            catch(\Exception $e){
                                
                                return back()->withInput()->with('deleted',$e->getMessage());
                            }
                           
                        }

                  
                } catch (\Exception $e) {
                   // return $e->getMessage();
                    
                    return redirect()->route('existterm')->withInput()->with('deleted',$e->getMessage());

                }

            
       
  }

   public function make_request($alldata)
    {
        $response = Http::post('https://mediacity.co.in/purchase/public/api/verifycode', [
            'app_id' => $alldata['app_id'],
            'ip' => $alldata['ip'],
            'code' => $alldata['code'],
            'domain' => $alldata['domain']
        ]);

        $result = $response->json();
        
        if($response->successful()){
            if ($result['status'] == '1')
            {
                $file = public_path() . '/intialize.txt';
                file_put_contents($file, $result['token']);
                file_put_contents(public_path() . '/code.txt', $alldata['code']);
                file_put_contents(public_path() . '/ddtl.txt', $alldata['domain']);
                return array(
                    'msg' => $result['message'],
                    'status' => '1'
                );
            }
            else
            {
                $message = $result['message'];
                return array(
                    'msg' => $message,
                    'status' => '0'
                );
            }
        }else
        {
            $message = "Failed to validate";
            return array(
                'msg' => $message,
                'status' => '0'
            );
        }

       
    }

   protected function changeEnv($data = array())
    {
        {
            if (count($data) > 0) {

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);

                // Loop through given data
                foreach ((array) $data as $key => $value) {
                    // Loop through .env-data
                    foreach ($env as $env_key => $env_value) {
                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if ($entry[0] == $key) {
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;

            } else {

                return false;
            }
        }
    }
}
