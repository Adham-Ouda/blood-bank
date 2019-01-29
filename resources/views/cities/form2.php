<div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('city' ,null,[
             
               'class' => 'form-control'
            ]) !!}

          </div>
           <div class="dropdown">
         <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose the governorate
         <span class="caret"></span></button>
         <ul class="dropdown-menu">
         @foreach ($governorates as $governorate)
         <li><a href="#">HTML</a></li>
         @endforeach
         <li><a href="#">CSS</a></li>
         <li><a href="#">JavaScript</a></li>
         </ul>
         </div> 

          <div class="form-group">
             <button class="btn btn-primary" type="submit">Submit</button>
          </div> 