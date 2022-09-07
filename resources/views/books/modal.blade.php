
{{-- modal content --}}
<div class="container ">
    <div class="row">
      <h5 class="card-title ">Book Title: {{$book->title}}</h5>
      <br>
      <br>
      <br>
      <h5 class="card-title">Author:  {{$book->author}}</h5>
    </div>
    <hr class="dropdown-divider">
    <div class="row">
      <div class="card mb-3 " style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{$book->picture}}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Description</h5>
              <p class="card-text">{{$book->description}}</p>
              <input type="hidden" name="id" value="{{$book->id}}">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="dropdown-divider">

 
  </div>