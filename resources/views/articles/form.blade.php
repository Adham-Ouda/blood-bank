        @inject('articlescategory','App\ArticlesCategory')
        <div class="form-group">
            <label for="name">Title</label>
             
            {!! Form::text('title' ,null,[
             
               'class' => 'form-control'
            ]) !!}
           
           <label for="name">Image</label>

           {!! Form::file('image' ,null,[
             
               'class' => 'form-control'
            ]) !!}
            

           <label for="name">Body</label>
              
            {!! Form::textarea('body' ,null,[
             
               'class' => 'form-control'
            ]) !!}
          
         </div>
         <div class="form-group">
            <label for="name">Category</label>
            {!! Form::select('articles_category_id',$articlescategory->pluck('category_name','id')->toArray(),null,[
                'class' => 'form-control',
                'placeholder' => 'Pick a category..'
            ]) !!}

          </div>
          <div class="form-group">
             <button class="btn btn-primary" type="submit">Submit</button>
          </div>
          