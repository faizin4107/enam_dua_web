@extends('layouts.main')

@section('container')
   <div class="container">
      <div class="row mt-4">
        
         <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
            <div class="card mt-5">
                @foreach ($review as $rev)
                <iframe src="{{ $rev->url }}" height="400"></iframe>
               
               <div class="card-body">
                 <h5 class="card-title">{{ Str::substr($rev->name, 0, 20) }}</h5>
                 <p class="card-text">{{ $rev->text }}</p>
                 <p><a href="{{ $rev->url }}" target="_blank"> View website</a></p>
                 <p class="card-text">{{ $rev->rating }} 
                  <span class="jstars" data-value={{ floatVal($rev->rating) }}
                   data-total-stars="5" data-color="#DCF310" 
                   data-empty-color="black" data-size="20px"
                  ></span>
                  <p class="card-text">{{ $rev->time_created }}</p>
                  @foreach ($reviewuser as $item)
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $item[0]['name'] }}</div>
                        <a href="{{ $item[0]['profile_url'] }}" target="_blank"> View profile</a>
                      </div>
                      <?php if($item[0]['image_url'] !== null) : ?>
                      <a href="{{ $item[0]['image_url'] }}" data-fancybox="gallery">
                        <img src="{{ $item[0]['image_url'] }}" style="object-fit:cover; height: 50px; width: 50px" class="rounded img-thumbnail" alt="...">
                     </a>
                     <?php else: ?>
                     <a href="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" data-fancybox="gallery">
                        <img src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" style="object-fit:cover; height: 50px; width: 50px" class="rounded img-thumbnail" alt="...">
                     </a>
                     
                     <?php endif;?>
                    </li>
                    
                  </ul>
                  
                  @endforeach
             </div>
             @endforeach
            
            
            
            
         </div>
         
      </div>
      
   </div>
   
@endsection