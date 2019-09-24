    var number=0;
    var ma = "";
    var mo = "";
    var year;
    var make="";
    var make_id = 0;
    var model="";
    var stock;

    $(document).ready(function(){
      $("#modelButton").hide();
      stock = $("#stock").val();
      number  = stock.replace(/[^0-9]/g,'');
      if(stock != ""){
        $(".hide").removeClass('hide');
      }
      make_id = $("#make").find('option:selected').val();
      model_id = $("#model").find('option:selected').val();
      if(make_id == ""){

      }
      else{
        if(model_id == ""){
          generateModel();
        }
        make = $("#make").find('option:selected').text();
        ma = make.charAt(0);
        
      }      
    });

   $( "select" ) .change(function () {    
    id = $(this).closest('select').attr('id');
    value = $("#"+id).val();
    if(value == ""){
      $("#"+id).addClass('empty');
    }
    else{
      $("#"+id).removeClass('empty');
    }
      switch(id){
        case "year":
        year = $(this).find('option:selected').val();
        console.log(year);
        if(year == ""){
           $("#make").prop("disabled", true);
            $("#makeButton").hide();
          }
          else{
            $("#make").prop("disabled", false);
            $("#makeButton").show();
          }
        break;
        case "make":
          make = $(this).find('option:selected').text();
          make_id = $(this).find('option:selected').val();
          ma = make.charAt(0);
          $("#stock").val(ma+mo+number);
          if(make_id == ""){
           $("#model").prop("disabled", true);
            $("#modelButton").hide();
          }
          else{
            $("#model").prop("disabled", false);
            $("#make_id").val($(this).find('option:selected').val());
            $("#modelButton").show();
            generateModel();

          }
          console.log(make_id);
          console.log(ma);
        break;
        case "model":
          model = $(this).find('option:selected').text();
          mo = model.charAt(0);
          $("#stock").val(ma+mo+number);
        break;
        case "enginechart":
          enginechart = $(this).val();
            if(enginechart != ""){
            $("#enginesize").prop("disabled", false);
          }
          else{
            $("#enginesize").prop("disabled", true);
          }
        break;
      }
    });  

    function generateModel() {
      $('#model').empty();
      $('#model').append('<option value=""> Select Model</option>');
      url = localurl+"/models/"+make_id;

      $.ajax({
        type:"GET",
        url: url,
        success: function(data){
          $(data).each(function(index, model){
             //year = '<a class="dropdown-item" data="'+year.number+'">'+year.number+'</a>';
            $('#model').append($('<option>',
             {
                value: model['id'],
                text :  model['name']
              }
            )
            );
          });
        }
      });
    }

    function generateStock() {
        number = 0;
        while(number < 1000){
          getRandomInt();
        }
       $("#stock").val(ma+mo+number);
       $(".hide").removeClass('hide');
    }

    // Retorna un entero aleatorio entre min (incluido) y max (excluido)
    // ¡Usando Math.round() te dará una distribución no-uniforme!
    function getRandomInt() {
      number =  Math.floor(Math.random() * (1000 - 10000)) + 1000;
      number = Math.abs(number);
      return number;
    }

    function addYear(){
       var formDataValues = document.forms.namedItem("addYearForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/dashboard/catalog/years";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      $('#year').append($('<option>',
                         {
                            value: data.number,
                            text : data.number
                          }));
                      $("#year option[value='"+data.number+"']").prop('selected', true);

                        $('#modal-addYear').modal('hide');
                        $('#year').removeClass('empty');
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('.invalid-year').show();
                      $('#invalid-year-message').text(response.errors.number);
                      $('#addYearForm #number').addClass('is-invalid');

                    }});
    }

    function addMake(){
       var formDataValues = document.forms.namedItem("addMakeForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/dashboard/catalog/makers";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      $('#make').append($('<option>',
                         {
                            value: data.id,
                            text : data.name
                          }));
                      $("#make option[value='"+data.id+"']").prop('selected', true);

                        $('#modal-addMake').modal('hide');
                        $('#make').removeClass('empty');
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('#addMakeForm .invalid-name').show();
                      $('#addMakeForm #invalid-name-message').text(response.errors.name);
                      $('#addMakeForm #name').addClass('is-invalid');
                    }});
    }

      function addModel(){
       var formDataValues = document.forms.namedItem("addModelForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/dashboard/catalog/models";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      $('#model').append($('<option>',
                         {
                            value: data.id,
                            text : data.name
                          }));
                      $("#model option[value='"+data.id+"']").prop('selected', true);

                        $('#modal-addModel').modal('hide');
                        $('#model').removeClass('empty');
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('#addModelForm .invalid-name').show();
                      $('#addModelForm #invalid-name-message').text(response.errors.name);
                      $('#addModelForm #name').addClass('is-invalid');
                    }});
    }

      function addCategory(){
       var formDataValues = document.forms.namedItem("addCategoryForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/dashboard/catalog/categories";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      $('#category').append($('<option>',
                         {
                            value: data.id,
                            text : data.name
                          }));
                      $("#category option[value='"+data.id+"']").prop('selected', true);

                        $('#modal-addCategory').modal('hide');
                        $('#category').removeClass('empty');
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('#addCategoryForm .invalid-name').show();
                      $('#addCategoryForm #invalid-name-message').text(response.errors.name);
                      $('#addCategoryForm #name').addClass('is-invalid');
                    }});
    }

      function addCylinder(){
       var formDataValues = document.forms.namedItem("addCylinderForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/dashboard/catalog/cylinders";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      $('#cylinder').append($('<option>',
                         {
                            value: data.number,
                            text : data.number
                          }));
                      $("#cylinder option[value='"+data.number+"']").prop('selected', true);

                        $('#modal-addCylinder').modal('hide');
                        $('#cylinder').removeClass('empty');
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('#addCylinderForm .invalid-number').show();
                      $('#addCylinderForm #invalid-number-message').text(response.errors.number);
                      $('#addCylinderForm #number').addClass('is-invalid');
                    }});
    }

      function addFuel(){
       var formDataValues = document.forms.namedItem("addFuelForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/dashboard/catalog/fuels";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      $('#fuel').append($('<option>',
                         {
                            value: data.id,
                            text : data.name
                          }));
                      $("#fuel option[value='"+data.id+"']").prop('selected', true);

                        $('#modal-addFuel').modal('hide');
                        $('#fuel').removeClass('empty');
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('#addFuelForm .invalid-name').show();
                      $('#addFuelForm #invalid-name-message').text(response.errors.name);
                      $('#addFuelForm #name').addClass('is-invalid');
                    }});
    }
                
