@extends('layouts.app')

@section('content')

<div class="container">

  {{-- alerts  --}}
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


    {{-- content --}}
    <div class="row " >
      <select id="categories" class="form-select border border-dark" aria-label="Default select example">
        <option value="0" selected>Open this select menu</option>
        @foreach($items as $key)
        <option value="{{$key->id}}">{{$key->name}}</option>
        @endforeach
      </select>
     {{--table  --}}
<div id="table"> <table class="table" >
  <thead>
    <tr>
      
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
      @foreach ($books as $book)
      <tr>

      
      <td>{{$book->title}}</td>
      <td>{{$book->author}}</td>
      
      <td>
        <button type="button"  id="modal-button" onclick="modal({{$book->id}})" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Ver
        </button>

         </td>
  
    </tr>
    @endforeach
  </tbody>
</table></div>
       
    </div>
</div>

<!-- Modal -->
<div class="modal fade border border-dark" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h5 class="modal-title" id="staticBackdropLabel">Book Imformation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ url('/reserve') }}" method="post">
      <div class="modal-body" id="Modal-content">
       
       
      </div>
      {{-- form for reservation --}}
      
      <div class="modal-footer">
       <div class="container">
        <select class="form-select  col-3  border border-dark"  name="days" aria-label="Default select example">
          <option value="0" selected>Select the number of days</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
        </select>
      <br>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
       
          
          <input class="btn btn-outline-primary" type="submit" value="Reserve" />
        
        @method('post')
        @csrf
      </div>
   

      </div>
    </form>
    </div>
  </div>
</div>




{{-- js functions for modal an filter --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
  $( "#categories" ).change(function() {
     
     console.log( 'entra ajax');
         let category= $("#categories").val();
         $.ajax({
             method: 'get',
          
             url: 'filter/'+category,
             dataType: "html",
             success: function (json) {
                 $("#table").html(json);
                 //			$(".modal-dialog").removeClass("modal-lg");
                 // $("#ModalGeneralMessage").html(data.formulario);
                 // $("#ModalGeneral").modal("show");
                 
                //  setTimeout(function () {
                //      validarEnviarFormTerceros('editar');
                //      cargarCombosUbicacion();
                //  }, 1800);
             },
         
         });
         console.log( "ready!" );
     });


  function modal(id){
    let libro =  id
     console.log(libro);

  $.ajax({
             method: 'get',
          
             url: 'show/'+libro,
             dataType: "html",
             success: function (json) {
                 $("#Modal-content").html(json);
                 //			$(".modal-dialog").removeClass("modal-lg");
                 // $("#ModalGeneralMessage").html(data.formulario);
                 // $("#ModalGeneral").modal("show");
                 
               
             },
         
         });
};
     </script>
@endsection