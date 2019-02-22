<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SitesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
    public function index() {
        
        //$sites = Site::all();
        
        $sites = \App\Recipe::sortable()->paginate(10);
        
        
        return view('sites.console', compact('sites'));  //wyświetlanie zawartości tabeli / przekazanie zmiennej sites
        
    }
    
    public function search(Request $request) {
        
        //$sites = Site::all();
        $search = $request->get('search');
        $sites = \App\Recipe::sortable()->where('name', 'like', '%'.$search.'%')->paginate(10); //obsługa wyszukiwania po nazwie przepisu
        
        
        return view('sites.console', compact('sites'));  //wyświetlanie zawartości tabeli / przekazanie zmiennej sites
        
    }
    
    
    public function add() {
        return view('sites.add');
    }
    
    public function raport() {
        //$android_users = \App\Android_User; 
        $today = date("Y-m-d");
        $day7ago = date('Y-m-d', strtotime("-7days"));
        $day30ago = date('Y-m-d', strtotime("last month"));
        
        //$android_users = DB::select('select login,created_at from android_users', array(1));
        //$android_users_counts = DB::select('select login,created_at from android_users WHERE created_at >= ? AND created_at <= ?', [$day7ago,$today], array(1));
        $android_users_counts = DB::select('select login,created_at from android_users WHERE created_at > ? AND created_at <= ?', [$day7ago,$today], array(1));
        $android_users = DB::select('select (count(q.label) - 1) as y, q.label  from (
            (SELECT date(created_at) as label FROM android_users
            WHERE created_at > DATE_SUB(CURRENT_DATE(), INTERVAL 8 DAY))
            union all( SELECT DATE(DATE_ADD(DATE_SUB(CURRENT_DATE(), INTERVAL 8 DAY), 
            INTERVAL @i:=@i+1 DAY) ) as label
            FROM android_user_logs, (SELECT @i:=0) r
              where @i < DATEDIFF(now(), DATE_SUB(CURRENT_DATE(), INTERVAL 8 DAY))
               )
            ) as q
            group by q.label', array(1));
        $android_users30days_counts = DB::select('select login,created_at from android_users WHERE created_at >= ? AND created_at <= ?', [$day30ago,$today], array(1));
        $android_users30days = DB::select('select (count(q.label) - 1) as y, q.label  from (
            (SELECT date(created_at) as label FROM android_users
            WHERE created_at > DATE_SUB(CURRENT_DATE(), INTERVAL 31 DAY))
            union all( SELECT DATE(DATE_ADD(DATE_SUB(CURRENT_DATE(), INTERVAL 31 DAY), 
            INTERVAL @i:=@i+1 DAY) ) as label
            FROM android_user_logs, (SELECT @i:=0) r
              where @i < DATEDIFF(now(), DATE_SUB(CURRENT_DATE(), INTERVAL 31 DAY))
               )
            ) as q
            group by q.label', array(1));
        $count_recipes = DB::select('select category, COUNT(id) as `ilosc` from recipes GROUP BY category', array(1));
        
        //$android_users = DB::table('android_users')->select(['login','created_at'])->whereRaw("created_at >= '$day7ago' AND created_at <= '$today'")->paginate(5);
        //$android_users30days = DB::table('android_users')->select(['login','created_at'])->whereRaw("created_at >= '$day30ago' AND created_at <= '$today'")->paginate(5);
        return view('sites.raport', compact('android_users','android_users_counts','android_users30days_counts','android_users30days','count_recipes'));
    }
    
    
    public function save(Request $request) {
       
     $this->validate($request, [  //walidacja odbieranych zdjęć
         'zdjecie_glowne' => 'required|image|mimes:jpeg,jpg,png|max:2048',
         'fot1' => 'image|mimes:jpeg,jpg,png|max:2048',
         'fot2' => 'image|mimes:jpeg,jpg,png|max:2048',
         'fot3' => 'image|mimes:jpeg,jpg,png|max:2048'         
     ]);
     
     $site = new \App\Recipe(); //tworzenie obiektu do zapisania w bazie danych
     
     $image = $request->file('zdjecie_glowne');
     $fileName = $request->get('kategoria').time().'.'.$image->getClientOriginalExtension();
     $image->move(public_path("upload"),$fileName);
     
     if($request->file('fot1')){ //sprawdzanie czy fot1 dodane w formularzu
     $image1 = $request->file('fot1');
     $fileName1 = $request->get('kategoria').time().rand().'.'.$image1->getClientOriginalExtension();
     $image1->move(public_path("upload"),$fileName1);
     $site-> photo1 = $fileName1;
     }
     
     if($request->file('fot2')){
     $image2 = $request->file('fot2');
     $fileName2 = $request->get('kategoria').time().rand().'.'.$image2->getClientOriginalExtension();
     $image2->move(public_path("upload"),$fileName2);
     $site-> photo2 = $fileName2;
     }
     
     if($request->file('fot3')){
     $image3 = $request->file('fot3');
     $fileName3 = $request->get('kategoria').time().rand().'.'.$image3->getClientOriginalExtension();
     $image3->move(public_path("upload"),$fileName3);
     $site-> photo3 = $fileName3;
     }
        
        $site-> name = $request->input('nazwa');
        $site-> category = $request->get('kategoria'); //get dla selecta(enum)
        $site-> description = $request->input('opis');
        $site-> components = $request->input('skladniki');
        $site-> way_of_preparation = $request->input('sposob_przyrzadznia');
        $site-> main_photo = $fileName;
        
        $site-> URL_video = $request->input('URL_filmu');
        $site-> id_user = Auth::user()->id;
        $site->save();
      
        return redirect()->route('sites.show', $site);
       
    }
    
    
    public function show(\App\Recipe $site) {
        
        return view('sites.show', compact('site'));
    }
    
    public function edit(\App\Recipe $site) {
        
        return view('sites.edit', compact('site'));
    }
    
    public function update(Request $request, \App\Recipe $site) { 
        
        $this->validate($request, [  //walidacja odbieranych zdjęć
         'zdjecie_glowne' => 'image|mimes:jpeg,jpg,png|max:2048',
         'fot1' => 'image|mimes:jpeg,jpg,png|max:2048',
         'fot2' => 'image|mimes:jpeg,jpg,png|max:2048',
         'fot3' => 'image|mimes:jpeg,jpg,png|max:2048'         
     ]);
        
     
     if($request->file('zdjecie_glowne')){ //sprawdzanie czy zdjecie_glowne dodane w formularzu
     $image = $request->file('zdjecie_glowne');
     $fileName = $request->get('kategoria').time().'.'.$image->getClientOriginalExtension();
     $image->move(public_path("upload"),$fileName);
     $site-> main_photo = $fileName;
     }
     
     if($request->input('usun1')){ //sprawdzanie czy usun11 dodane w formularzu - Obsługa przycisku Usuń zdjęcie
     $site-> photo1 = NULL;
     }
     if($request->file('fot1')){ //sprawdzanie czy fot1 dodane w formularzu
     $image1 = $request->file('fot1');
     $fileName1 = $request->get('kategoria').rand().'.'.$image1->getClientOriginalExtension();
     $image1->move(public_path("upload"),$fileName1);
     $site-> photo1 = $fileName1;
     }
     
     
     if($request->file('fot2')){
     $image2 = $request->file('fot2');
     $fileName2 = $request->get('kategoria').rand().'.'.$image2->getClientOriginalExtension();
     $image2->move(public_path("upload"),$fileName2);
     $site-> photo2 = $fileName2;
     }
     
     if($request->file('fot3')){
     $image3 = $request->file('fot3');
     $fileName3 = $request->get('kategoria').rand().'.'.$image3->getClientOriginalExtension();
     $image3->move(public_path("upload"),$fileName3);
     $site-> photo3 = $fileName3;
     }
        
        $site-> name = $request->input('nazwa');
        $site-> category = $request->get('kategoria'); //get dla selecta(enum)
        $site-> description = $request->input('opis');
        $site-> components = $request->input('skladniki');
        $site-> way_of_preparation = $request->input('sposob_przyrzadznia');
        
        
        $site-> URL_video = $request->input('URL_filmu');
        $site-> id_user = Auth::user()->id;
        
        $site->update();
        return redirect()->route('sites.show', $site);
    }
    
    
    public function destroy(\App\Recipe $site) { 
               
        $site->delete();
        return redirect()->route('sites.console');
    }
}
