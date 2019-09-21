@extends('layouts.admin')

@section('content')
<style type="text/css">
    .bg-login-image{
    background-image: url('{{url('/public/dashboard/')}}/img/undraw_Vehicle_sale_a645.svg') !important;
    background-position: center !important;
    background-size: 80%;
    background-repeat: no-repeat;
  }
  .btn-primary{
    cursor: pointer;
  }


    


</style>
	  <div class="container p-2">
          <div class="card o-hidden border-0 shadow-lg my-2 my-md-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
		<div class="row">
          <div class="col-lg-6">
            <div class="pt-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Photos!</h1>
              </div>
            </div>
            
            <div class="row pl-5">
              <div class="col-sm-12">
                <div id="photos" class="images-container">
                    <!-- Add Button -->
                    <a href="#" class="add-image" data-toggle="modal" data-target="#modal-media">
                      <div class="image-container new new-danger">
                        <div class="image">
                          <i class="fa fa-plus"></i>
                        </div>
                    </div>
                    </a>
                    <!-- Add Button -->

                    <!-- Photos -->
                    @foreach($photos as $photo)
                    <div class="image-container">
                      <div class="controls">
   
              <!---->
                        <a href="#" class="control-btn remove" data-toggle="modal" data-target="#confirmDeleteModal{{$photo->id}}">
                          <i class="far fa-trash-alt"></i>
                        </a>
                      </div>
                      <div class="image" style="background-image:url('{{url('public/images/').'/'.$photo->filename}}')"></div>
                    </div>
                    @endforeach
                    <!-- Photos-->                
                  </div>
                </div>
              </div>
          </div>

          <div class="col-lg-6">

        
            <div class="p-2 p-md-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Item Details!</h1>
              </div>
              <form class="user" method="POST" action="{{ url('dashboard/inventory').'/'.$item->id }}" aria-label="{{ __('Register') }}">
              	  @csrf
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0">
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label> 
                      <input type="text" class="pl-4 text-uppercase form-control-user form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ old('stock', $item->stock) }}" id="stock" name="stock" placeholder=" Stock" readonly="true">
                      @if ($errors->has('stock'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stock') }}</strong>
                            <strong>Click this <i class="text-primary fa fa-magic"></i> button to continue.</strong>
                            
                        </span>
                    @endif
                    </div>
                    <div class="col-md-3 col-xs-3 pr-0">
                    </div>
                  </div>
                    
                  
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0">
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label>                 
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('year') ? ' is-invalid' : '' }}
                      {{ ($item->year == '') ? ' empty' : '' }}" name="year" id="year">
                      <option value=""> Select Year</option>
                      @foreach($years as $year)
                      <option value="{{$year->number}}"
                        {{ ( $item->year == $year->number) ? 'selected' : '' }}>
                        {{$year->number}}</option>
                      @endforeach
                      </select>
                      @if ($errors->has('year'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('year') }}</strong>
                      </span>
                      @endif
                    </div>
                    <div class="col-md-3 col-xs-3 pr-0">
                      <div class="btn-primary form-control-user p-3 text-center" alt="New year" data-toggle="modal" data-target="#modal-addYear">
                      <i class="fa fa-plus"></i></div>
                    </div>                
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0"> 
                    <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label> 
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('make') ? ' is-invalid' : '' }}
                      {{ ($item->make == '') ? ' empty' : '' }}" name="make" id="make">
                        <option value=""> Select Make</option>
                        @foreach($makers as $make)
                        <option value="{{$make->id}}"{{ ($item->make == $make->id) ? 'selected' : '' }} >{{$make->name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('make'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('make') }}</strong>
                        </span>
                        @endif
                    </div>
                      <div class="col-md-3 col-xs-3 pr-0">
                        <div id="makeButton" class="btn-primary form-control-user p-3 text-center" alt="New make" data-toggle="modal" data-target="#modal-addMake">
                        <i class="fa fa-plus"></i></div>
                      </div>                
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0"> 
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label> 
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('model') ? ' is-invalid' : '' }}
                      {{ ($item->model == '') ? ' empty' : '' }}" name="model" id="model">
                        <option value=""> Select Model</option>
                        @foreach($models as $model)
                        <option value="{{$model->id}}"{{ ($item->model == $model->id) ? 'selected' : '' }} >{{$model->name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('model'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('model') }}</strong>
                        </span>
                        @endif
                    </div>
                      <div class="col-md-3 col-xs-3 pr-0">
                        <div id="modelButton" class="btn-primary form-control-user p-3 text-center" alt="New model" data-toggle="modal" data-target="#modal-addModel">
                          <i class="fa fa-plus"></i></div>
                      </div>                
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label>
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('category') ? ' is-invalid' : '' }}
                      {{ ($item->category == '') ? ' empty' : '' }}" name="category" id="category">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"{{ ($item->category == $category->id) ? 'selected' : '' }} >{{$category->name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('category'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                        @endif
                    </div>               
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0">
                      <input type="text" class="text-uppercase form-control-user form-control" value="{{  old('color', $item->color) }}" id="color" name="color" placeholder="Color">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0">                   
                      <input type="text" class="text-uppercase form-control-user form-control" name="vin" value="{{ old('vin', $item->vin) }}" placeholder="VIN">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ ($item->engine == '') ? ' empty' : '' }}" name="enginesize" id="enginesize">
                        <option value="">Select ENGINE SIZE</option>
                        @foreach($engines as $engine)
                        <option value="{{$engine->Liters}}"
                          {{ ($item->enginesize == $engine->Liters) ? 'selected' : '' }}>{{$engine->Liters}}L</option>
                        @endforeach
                      </select>
                    </div>               
                  </div>
                </div>
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="empty text-uppercase form-control-select form-control
                      {{ ($item->cylinders == '') ? ' empty' : '' }}" name="cylinders" id="cylinders">
                        <option value="">Select CYLINDERS</option>
                        @foreach($cylinders as $cylinder)
                        <option value="{{$cylinder->number}}"
                          {{ ($item->cylinders == $cylinder->number) ? 'selected' : '' }}>{{$cylinder->number}}</option>
                        @endforeach
                      </select>
                    </div>               
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ ($item->drive == '') ? ' empty' : '' }}" name="drive" id="drive">
                        <option value="">Select DRIVE</option>
                        <option value="fwd"{{ ($item->drive == 'fwd') ? 'selected' : '' }}>fwd</option>
                        <option value="rwd"{{ ($item->drive == 'rwd') ? 'selected' : '' }}>rwd</option>
                        <option value="4wd"{{ ($item->drive == '4wd') ? 'selected' : '' }}>4wd</option>

                      </select>
                    </div>               
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ ($item->fuel == '') ? ' empty' : '' }}" name="fuel" id="fuel">
                        <option value="">Select Fuel</option>
                        @foreach($fuels as $fuel)
                        <option value="{{$fuel->id}}"{{ ($item->fuel == $fuel->id) ? 'selected' : '' }} >{{$fuel->name}}</option>
                        @endforeach
                      </select>
                    </div>               
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ ($item->transmission == '') ? ' empty' : '' }}" name="transmission" id="transmission">
                        <option value="">Select transmission</option>
                        <option value="manual"{{ ($item->transmission == 'manual') ? 'selected' : '' }} >manual</option>
                        <option value="automatic"{{ ($item->transmission == 'automatic') ? 'selected' : '' }} >automatic</option>
                      </select>
                    </div>               
                  </div>
                </div>
                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0">                   
                      <input type="text" class="text-uppercase form-control-user form-control" name="description" value="{{ old('description', $item->description) }}" placeholder="Description">
                    </div>
                  </div>
                </div>

                <hr>
                    <div class="form-group text-right pt-3">
                 <button type="submit" class="btn btn-danger">
                       {{ __('Update Item') }}
                    </button>
                   </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Add Image -->
  <div class="modal fade" id="modal-media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Photo Library!</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body">
     
          <form id="imageUpload" method="POST" action="{{route('photos.store')}}" enctype="multipart/form-data"
      class="dropzone imageUpload"
      id="my-awesome-dropzone"> 
              @csrf
              <input type="hidden" name="inventory_id" value="{{$item->id}}">
            </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Add Image -->


<!-- Modal Section -->
  <!-- Modal Add Year -->
  <div class="modal fade" id="modal-addYear" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addYearForm">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need a new year?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="form-group">
              <label for="number" class="col-form-label">{{ __('Year number') }}</label>
                <input id="number" type="number" class="form-control" name="number">
                    <span class="invalid-feedback invalid-year" role="alert">
                      <strong id="invalid-year-message"></strong>
                    </span>
                </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn btn-primary btn-sm" onclick="addYear()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Year -->

    <!-- Modal Add Make -->
  <div class="modal fade" id="modal-addMake" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addMakeForm">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need a new maker?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="form-group">
              <label for="name" class="col-form-label">{{ __('Make name') }}</label>
                <input id="name" type="name" class="form-control" name="name">
                    <span class="invalid-feedback invalid-name" role="alert">
                      <strong id="invalid-name-message"></strong>
                    </span>
                </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn btn-primary btn-sm" onclick="addMake()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Make -->


    <!-- Modal Add Model -->
  <div class="modal fade" id="modal-addModel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addModelForm">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need a new model?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="form-group">
              <label for="name" class="col-form-label">{{ __('Model name') }}</label>
                <input id="name" type="name" class="form-control" name="name">
                    <span class="invalid-feedback invalid-name" role="alert">
                      <strong id="invalid-name-message"></strong>
                    </span>
                <input id="make_id" type="hidden" name="make_id" value="">
            </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn btn-primary btn-sm" onclick="addModel()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Model -->


@foreach($photos as $photo)
  <!-- Modal Delete Photo -->
  <div class="modal fade" id="confirmDeleteModal{{$photo->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form method="POST" action="{{route('photos.destroy',$photo->filename)}}">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need to delete the photo?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
            <h6 class="h6">Are you sure?</h6>
            <input name="_method" type="hidden" value="delete">

          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <button class="btn btn-primary btn-sm"> Confirm </button>
          </div>
        </div>
          </form>
      </div>
    </div>
@endforeach
  <!-- Modal Delete photo -->

  <script src="{{url('/public/dashboard')}}/js/dropzone.js"></script>
  <script type="text/javascript">
    var uploaded = 0;
$(document).on('hide.bs.modal','#modal-media', function () {
  if(uploaded>0){
    location.reload();
  }
});

Dropzone.autoDiscover = false;


$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone("#imageUpload", {
            maxFilesize: 5,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            timeout: 5000,
  });
  myDropzone.on("addedfile", function(file) {
    uploaded++;
  });
})
</script>


<script type="text/javascript" src="{{url('public')}}/dashboard/js/inventory.js"></script>
@endsection