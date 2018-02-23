  @if (session()->has('success_msg'))
                <div class="alert alert-success">
                    {{ session()->get('success_msg') }}
                </div>
            @endif

            @if (count($errors) > 0)
                
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors as $error)
                           {{ $errors }}
                        @endforeach
                    
                    @if (count($errors)==1)
                        <ul>{{ (string)$errors }}</ul>
                    @endif
                        
                    </ul>
                </div>

            @endif