@extends('layouts.main')

@section('container')
   <div class="container">
      {{-- <form>
         <div class="row mt-4">
               <div class="col-lg-4">
                  <label for="search" class="form-label">Search</label>
                  <input type="text" placeholder="Search type in the search box..." class="form-control" id="search">
               </div>
               <div class="col-lg-4 btnSearch">
                  <button type="submit" class="btn btn-primary">Search</button>
               </div>
         </div>
      </form> --}}
      <div class="row">
         <div class="col-lg-8">
            <h4>Total Data : {{ $count }}
            
            </h4>
         </div>
         <div class="col-lg-4">
            <form action="{{ route('bussiness.store') }}" method="post">
               @csrf
               <button type="submit" id="loading-btn" class="btn btn-primary btn-sm float-end btnCustomStore"><span id="icon-btn"></span>Store From API</button>
            </form>
            
         </div>
      </div>
      <div class="row mt-4">
         
         
         
         @foreach ($posts as $item)
         <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
            <div class="card mt-3">
               <a href="{{ $item->image_url }}" data-fancybox="gallery">
                  <img src="{{ $item->image_url }}" style="object-fit:cover; height: 300px; width: 550px" class="card-img-top img-fluid rounded img-thumbnail" alt="...">
               </a>
               
               <div class="card-body">
                 <h5 class="card-title">{{ Str::substr($item->name, 0, 20) }}</h5>
                 <p class="card-text">{{ $item->review_count }} reviews</p>
                 <p class="card-text">{{ $item->rating }} 
                  <span class="jstars" data-value={{ floatVal($item->rating) }}
                   data-total-stars="5" data-color="#DCF310" 
                   data-empty-color="black" data-size="20px"
                  ></span>
               </p>
                 <div class="row">
                  <div class="col-lg-12">
                     <form method="post" action="/bussiness/destroy/{{ $item->id }}">
                     <a href="/reviews/{{ $item->uniq_id }}" class="btn btn-primary mr-2 btnCustom"><i class="fa fa-info-circle"></i></a>
                     <a href="/bussiness/edit/{{ $item->id }}" class="btn btn-warning mr-2 btnCustom"><i class="fa fa-edit text-white"></i></a>
                     
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btnCustom deleteData" onclick="showLoading()"><i class="fa fa-trash"></i></button>
                     </form>
                    </div>
                   
                 </div>
               </div>
             </div>
            
            
            
            
         </div>
         @endforeach
      </div>
      
   </div>
   
@endsection
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
   function showLoading() {
    document.querySelector('#loading-content').classList.add('loading-content');
  }
//   function showLoading2() {
   
//    //  document.querySelector('#loading-btn').classList.add('buttonload');
//   }
  $(document).ready(function() {
      $('#loading-btn').click(function() {
         $('#icon-btn').append(`
         <i class="fa fa-spinner fa-spin"></i>`);
         $('#loading-btn').addClass('buttonload');
      })
   })
</script>