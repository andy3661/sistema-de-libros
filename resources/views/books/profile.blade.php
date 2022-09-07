@extends('layouts.app')

@section('content')
{{-- profile content --}}
<div class="container">
<div class="row">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
    <div class="card mb-3  center border border-dark" style="max-width: 210vh; height: 60vh;">
        <div class="row g-0">
         
          <div class="col-md-6">
            <div class="card-body">
              <h5 class="card-title">My name: {{auth()->user()->name}}</h5>
              <h5 class="card-title">Reserves Total: {{$all_reserves}}</h5>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="col-md-6 ">
            <img src="img/post/{{$photo->photo}}" class="img-fluid rounded-start" alt="..." >
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <h4 class="col-md-offset-6 card-title">My Reserves</h4>
        
    </div>
    <div class="col-md-6"> 
      {{-- form for get new book to the booking list of te user --}}
        <form action="{{ url('/list') }}" method="get">
            <input class="btn btn-outline-dark" type="submit" value="Add New Books" />
            @method('get')
            @csrf
        </form>
    </div>
    </div>
    <div class="row">
      {{-- table of reservations --}}
        <table class="table">
            <thead>
              <tr>
                
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($reserves as $reserv)
                <tr>

                
                <td>{{$reserv->title}}</td>
                <td>{{$reserv->author}}</td>
                
                <td>

                  {{-- form to delete the reservations of the user --}}
                    <form action="{{ url('/delete', ['id' => $reserv->id]) }}" method="post">
                        <input class="btn btn-outline-danger" type="submit" value="Delete" />
                        @method('delete')
                        @csrf
                    </form>
                 
                   </td>
            
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>


      @endsection

