        @inject('governorate','App\Governorate')
        <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('city' ,null,[
             
               'class' => 'form-control'
            ]) !!}

          </div>
          <div class="form-group">
            <label for="name">Governorate</label>
            {!! Form::select('governorate_id',$governorate->pluck('governorate','id')->toArray(),null,[
                'class' => 'form-control',
                'placeholder' => 'Pick a gov...'
            ]) !!}

          </div>
          
         
          