<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id= auth()->user()->id;
        $user_data= DB::table('users')
        ->join('bookings', 'users.id', '=', 'bookings.id_user')
        ->join('books', 'books.id', '=','bookings.id_book' )
        ->select( 'books.title', 'books.author','bookings.id')
        ->where('users.id', '=',$id)
        ->get();
        
         $photo= DB::table('users')->find($id);
        $reserves= $user_data->count();
        //   dd($user_data);
        return view('books.profile',['photo'=>$photo,'reserves' =>$user_data, 'all_reserves' =>$reserves]);
    }

    public function books(){


        $books= DB::table('books')
        ->select( '*')
        ->where('status', '=',0)
        ->get();
        // dd($books);

        $categories = DB::table('categories')->select('*')->get();

        return view('books.list',['books' =>$books, 'items' =>$categories]);
    }


    public function filter($id){
        
        if($id==0){
            $books = DB::table('books')->select('*')->where('status', '=',0)->get();
        }else{
            $books= DB::table('books')->select('*') ->where('status', '=',0)->where('id_categories', '=',$id)->get();
        }

    return view('books.table',['books' =>$books]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->days==0){
            return redirect()->back()->with('error', 'Reserve Failed the dropdown of days may be more than cero days!');
        }
        $date=getdate();
        $id= auth()->user()->id;
  
         $date=$date['year'].'-'.$date['mon'].'-'.$date['mday'];

        $reserve= DB::table('bookings')->insert([
            'reservation_date' => $date,
            'reservation_days' => $request->days,
            'id_user'=> $id,
            'id_book' => $request->id

        ]);

        $state = DB::table('books')
        ->where('id', $request->id)
        ->update(['status' => 1]);

        if($reserve){
            return redirect()->back()->with('status', 'Reserve Added!');
        }else{
            return redirect()->back()->with('error', 'Reserve Failed!');
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $book= DB::table('books')->find($id);

     return  view('books.modal',['book' =>$book]);
    }


    public function register(Request $request){

        if($request->password ==  $request->password_confirmation){
        
       

if($request->hasFile("photo")){

    $photo = $request->file("photo");
    $name_photo=$request->name.".".$photo->guessExtension();
    $route=public_path("img/post/");
    $photo->move($route,$name_photo);
} 
$register= DB::table('users')->insert([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'photo' => $name_photo

]);
return redirect()->back()->with('status', 'User registered successfull!');
}else{
    return redirect()->back()->with('error', 'the password is not equal to the one passed in, check again');
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking= DB::table('bookings')->find($id);

        $state = DB::table('books')
        ->where('id', $booking->id_book)
        ->update(['status' => 0]);
      
       if($state){
        $deleted = DB::table('bookings')->where('id', '=', $id)->delete();
        return redirect()->back()->with('status', 'Reserve deleted!');
       }else{
        return redirect()->back()->with('error', 'Reserve Failed to delete!');
       }
        
       
    }
}
