
{{-- table for filter assincronous --}}
<table class="table" >
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
  </table>