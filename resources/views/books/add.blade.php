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
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

          <div class="col-lg-6">

        
            <div class="p-lg-5 p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">¡Registrar libro!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('books.store') }}" aria-label="{{ __('Register') }}">
              	  @csrf
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0">
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label> 
                      <input type="text" class="pl-4 text-uppercase form-control-user form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ old('stock') }}" id="stock" name="stock" placeholder=" Stock" readonly="true">
                      @if ($errors->has('stock'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stock') }}</strong>                            
                        </span>
                    @endif
                    </div>
                    <div class="col-md-3 col-xs-3 pr-0">
                      <div class="btn-primary form-control-user p-3 text-center" onclick="generateStock()">
                        <i class="fa fa-magic"></i></div>
                    </div>
                  </div>
                    
                  
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0">
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label>                 
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('year') ? ' is-invalid' : '' }}
                      {{ (old('year') == '') ? ' empty' : '' }}" name="year" id="year">
                      <option value=""> Select Year</option>
                      @foreach($years as $year)
                      <option value="{{$year->number}}"
                        {{ ( old('year') == $year->number) ? 'selected' : '' }}>
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

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0"> 
                    <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label> 
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('make') ? ' is-invalid' : '' }}
                      {{ (old('make') == '') ? ' empty' : '' }}" name="make" id="make">
                        <option value=""> Select Make</option>
                        @foreach($makers as $make)
                        <option value="{{$make->id}}"{{ (old('make') == $make->id) ? 'selected' : '' }} >{{$make->name}}</option>
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

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9 p-0"> 
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label> 
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('model') ? ' is-invalid' : '' }}
                      {{ (old('model') == '') ? ' empty' : '' }}" name="model" id="model">
                        <option value=""> Select Model</option>
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

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <label class="text-bold text-danger" style="float: left !important; position: absolute; top: 15px; left: 15px;">* </label>
                      <select class="pl-4 text-uppercase form-control-select form-control
                      {{ $errors->has('category') ? ' is-invalid' : '' }}
                      {{ (old('category') == '') ? ' empty' : '' }}" name="category" id="category">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"{{ (old('category') == $category->id) ? 'selected' : '' }} >{{$category->name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('category'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-3 col-xs-3 pr-0">
                        <div id="categoryButton" class="btn-primary form-control-user p-3 text-center" alt="New Category" data-toggle="modal" data-target="#modal-addCategory">
                          <i class="fa fa-plus"></i></div>
                      </div>              
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0">
                      <input type="text" class="text-uppercase form-control-user form-control" value="{{ old('color') }}" id="color" name="color" placeholder="Color">
                    </div>
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0">                   
                      <input type="text" class="text-uppercase form-control-user form-control" name="vin" value="{{ old('vin') }}" placeholder="VIN">
                    </div>
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ (old('enginesize') == '') ? ' empty' : '' }}" name="enginesize" id="enginesize">
                        <option value="">Select ENGINE SIZE</option>
                        @foreach($engines as $engine)
                        <option value="{{$engine->Liters}}"
                          {{ (old('enginesize') == $engine->Liters) ? 'selected' : '' }}>{{$engine->Liters}}L</option>
                        @endforeach
                      </select>
                    </div>               
                  </div>
                </div>
                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="empty text-uppercase form-control-select form-control
                      {{ (old('cylinders') == '') ? ' empty' : '' }}" name="cylinders" id="cylinders">
                        <option value="">Select CYLINDERS</option>
                        @foreach($cylinders as $cylinder)
                        <option value="{{$cylinder->number}}"
                          {{ (old('cylinders') == $cylinder->number) ? 'selected' : '' }}>{{$cylinder->number}}</option>
                        @endforeach
                      </select>
                    </div>    
                      <div class="col-md-3 col-xs-3 pr-0">
                        <div id="cylinderButton" class="btn-primary form-control-user p-3 text-center" alt="New cylinder" data-toggle="modal" data-target="#modal-addCylinder">
                        <i class="fa fa-plus"></i></div>
                      </div>
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ (old('drive') == '') ? ' empty' : '' }}" name="drive" id="drive">
                        <option value="">Select DRIVE</option>
                        <option value="fwd"{{ (old('drive') == 'fwd') ? 'selected' : '' }}>fwd</option>
                        <option value="rwd"{{ (old('drive') == 'rwd') ? 'selected' : '' }}>rwd</option>
                        <option value="4wd"{{ (old('drive') == '4wd') ? 'selected' : '' }}>4wd</option>

                      </select>
                    </div>               
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ (old('fuel') == '') ? ' empty' : '' }}" name="fuel" id="fuel">
                        <option value="">Select Fuel</option>
                        @foreach($fuels as $fuel)
                        <option value="{{$fuel->id}}"{{ (old('fuel') == $fuel->id) ? 'selected' : '' }} >{{$fuel->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 col-xs-3 pr-0">
                      <div class="btn-primary form-control-user p-3 text-center" alt="New fuel" data-toggle="modal" data-target="#modal-addFuel">
                      <i class="fa fa-plus"></i></div>
                    </div>
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0"> 
                      <select class="text-uppercase form-control-select form-control
                      {{ (old('transmission') == '') ? ' empty' : '' }}" name="transmission" id="transmission">
                        <option value="">Select transmission</option>
                        <option value="manual"{{ (old('transmission') == 'manual') ? 'selected' : '' }} >manual</option>
                        <option value="automatic"{{ (old('transmission') == 'automatic') ? 'selected' : '' }} >automatic</option>
                      </select>
                    </div>               
                  </div>
                </div>

                <div class="form-group hide">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 p-0">                   
                      <input type="text" class="text-uppercase form-control-user form-control" name="description" value="{{ old('description') }}" placeholder="Description">
                    </div>
                  </div>
                </div>

                <hr>
                    <div class="form-group text-right pt-3">
                 <button type="submit" class="btn btn-danger">
                       {{ __('Register Item') }}
                    </button>
                   </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

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

<!-- Modal Add Category -->
  <div class="modal fade" id="modal-addCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addCategoryForm">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need a new category?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="form-group">
              <label for="name" class="col-form-label">{{ __('Category name') }}</label>
                <input id="name" type="name" class="form-control" name="name">
                    <span class="invalid-feedback invalid-name" role="alert">
                      <strong id="invalid-name-message"></strong>
                    </span>
            </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn btn-primary btn-sm" onclick="addCategory()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Category -->

  <!-- Modal Add Cylinder -->
  <div class="modal fade" id="modal-addCylinder" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addCylinderForm">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need a new cylinder number?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="form-group">
              <label for="number" class="col-form-label">{{ __('Cylinder number') }}</label>
                <input id="number" type="number" class="form-control" name="number">
                    <span class="invalid-feedback invalid-number" role="alert">
                      <strong id="invalid-number-message"></strong>
                    </span>
            </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn btn-primary btn-sm" onclick="addCylinder()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Cylinder -->

  <!-- Modal Add Fuel -->
  <div class="modal fade" id="modal-addFuel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addFuelForm">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need a new fuel?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="form-group">
              <label for="name" class="col-form-label">{{ __('Fuel name') }}</label>
                <input id="name" type="name" class="form-control" name="name">
                    <span class="invalid-feedback invalid-name" role="alert">
                      <strong id="invalid-name-message"></strong>
                    </span>
            </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn btn-primary btn-sm" onclick="addFuel()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Fuel -->
<!-- Modal Section -->
<script type="text/javascript" src="{{url('public')}}/dashboard/js/inventory.js"></script>
@endsection