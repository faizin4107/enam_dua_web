@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form method="post" action="/bussiness/update/{{ $post->id }}" novalidate enctype="multipart/form-data">
                <input type="hidden" name="categories_id" value="{{ $post->categories }}">
                @method('PUT')
                @csrf
                <div class="mb-3 mt-5">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" 
                    placeholder="Enter name..."
                     class="form-control" 
                     name="name"
                     value="{{ old('name', $post->name) }}">
                    @error('name')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>
                 
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image</label>
                    <input type="text" 
                     class="form-control" 
                     name="image_url"
                     value="{{ old('image_url', $post->image_url) }}">
                    @error('image_url')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_closed" class="form-label">Closed</label>
                    <select name="is_closed" name="is_closed" class="form-select">
                       
                        @if($post->is_closed === 1)
                        <option value="1">Open</option>
                        <option value="0">Closed</option>
                        @else 
                        <option value="0">Closed</option>
                        <option value="1">Open</option>
                        @endif
                        
                    </select>
                    @error('is_closed')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">Url</label>
                    <input type="text" 
                    placeholder="Enter url..."
                    name="url"
                     class="form-control" 
                     value="{{ old('url', $post->url) }}">
                    @error('url')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="review_count" class="form-label">Review Count</label>
                    <input type="number" 
                    placeholder="Enter review..."
                    name="review_count"
                     class="form-control" 
                     value="{{ old('review_count', $post->review_count) }}">
                    @error('review_count')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" 
                    placeholder="Enter rating..."
                    name="rating"
                     class="form-control" 
                     value="{{ old('rating', $post->rating) }}">
                    @error('rating')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" 
                    placeholder="Enter price..."
                    name="price"
                     class="form-control" 
                     value="{{ old('price', $post->price) }}">
                    @error('price')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" 
                    placeholder="Enter phone..."
                    name="phone"
                     class="form-control" 
                     value="{{ old('phone', $post->phone) }}">
                    @error('phone')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    @foreach($post->categories as $row)
                    <input type="text" 
                        id="categories"
                        name="categories[]"
                        placeholder="Enter title..."
                        value="{{ $row->title }}"
                        class="form-control mt-2">
                    @endforeach
                    
                    <div id="newCategories">
                    </div>
                    <button type="button" id="btnCategories" class="btn btn-primary btn-sm mt-2">Add Categories</button>
                </div>

                <div class="mb-3">
                    <label for="coordinates" class="form-label">Coordinates</label>
                    <input type="text" 
                    id="latitude"
                    name="latitude"
                    value="{{ $post->coordinates[0]->latitude }}"
                    placeholder="Enter latitude..."
                     class="form-control">
                     <input type="text" 
                     id="longitude"
                     name="longitude"
                     value="{{ $post->coordinates[0]->longitude }}"
                     placeholder="Enter longitude..."
                      class="form-control mt-2">
                </div>

                <div class="mb-3">
                    <label for="transactions" class="form-label">Transactions</label>
                     @foreach($post->transactions as $row)
                    <input type="text" 
                        id="transactions"
                        name="transactions[]"
                        placeholder="Enter transactions..."
                        value="{{ $row->transaction_name }}"
                        class="form-control mt-2">
                    @endforeach
                    <div id="newTransactions">
                    </div>
                    <button type="button" id="btnTransactions" class="btn btn-primary btn-sm mt-2">Add Transactions</button>
                </div>


                <div class="mb-3">
                    <label for="coordinates" class="form-label">Locations</label>
                    <input type="text" 
                    name="address1"
                    value="{{ $post->locations[0]->address1 }}"
                    placeholder="Enter address1..."
                     class="form-control">
                     <input type="text" 
                     name="address2"
                     value="{{ $post->locations[0]->address2 }}"
                     placeholder="Enter address2..."
                      class="form-control mt-2">
                      <input type="text" 
                      name="address3"
                      value="{{ $post->locations[0]->address3 }}"
                      placeholder="Enter address3..."
                       class="form-control mt-2">
                       <input type="text" 
                       name="city"
                       value="{{ $post->locations[0]->city }}"
                       placeholder="Enter city..."
                        class="form-control mt-2">
                        <input type="number" 
                        name="zip_code"
                        value="{{ $post->locations[0]->zip_code }}"
                        placeholder="Enter zip_code..."
                         class="form-control mt-2">
                         <input type="text" 
                       name="state"
                       value="{{ $post->locations[0]->state }}"
                       placeholder="Enter state..."
                        class="form-control mt-2">
                </div>

                
                
                <button type="submit" onclick="showLoading()" class="btn btn-primary btn-sm mt-3">
                  <span>Submit</span>
                  <i class="fa fa-plus ml-2"></i>
                </button>
              </form>
        </div>
    </div>
</div>





@endsection

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#btnCategories').click(function() {
            $('#newCategories').append(`
                <input type="text" 
                    id="categories"
                    name="categories[]"
                    placeholder="Enter title..."
                     class="form-control mt-2">
            `);
        })

        $('#btnTransactions').click(function() {
            $('#newTransactions').append(`
                <input type="text" 
                    id="transactions"
                    name="transactions[]"
                    placeholder="Enter transactions..."
                     class="form-control mt-2">
            `);
        })

        
    })

    
    
  function showLoading() {
    document.querySelector('#loading').classList.add('loading');
    document.querySelector('#loading-content').classList.add('loading-content');
  }
</script>