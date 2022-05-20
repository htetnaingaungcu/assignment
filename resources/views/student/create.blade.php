@extends('layout.app')

@section('content')

    <div class="header">
        <h3>Create A Student</h3>
    </div>
    <div class="content">
        <form action="{{route('student.store')}}" method="POST">
            @csrf

            <div class="mb-3 row">
                <div class="col-md-3">
                    <label for="name" class="form-label">Name</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control" id="name-input" placeholder="Name" required>
                </div>
                
            </div>
            <div class="mb-3 row">
                <div class="col-md-3">
                    <label for="Date of Birth" class="form-label">Date of Birth</label>
                </div>
                <div class="col-md-5">
                    <input type="date" name="dob" class="form-control" id="name-input" placeholder="Date of Birth" required>
                </div>
                
            </div>

            <div class="mb-3 row">
                <div class="col-md-3">
                    <label for="Email" class="form-label">Email</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="email" class="form-control" id="email-input" placeholder="Example@gmail.com">
                </div>
                
            </div>

            <div class="mb-3 row">
                <div class="col-md-3">
                    <label for="NRC" class="form-label">NRC</label>
                </div>      
                <div class="col-md-5 d-flex">
                    <select name="nrc[]" id="nrc_select1" class="nrc_select1">
                        
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select> 
                    <select name="nrc[]" id="nrc_select2" class="nrc_select2">
                        <option value="abc(N)">abc(N)</option>
                        <option value="aab(N)">aab(N)</option>
                        <option value="acd(N)">acd(N)</option>
                        <option value="cde(N)">cde(N)</option>
                        <option value="efg(N)">efg(N)</option>
                    </select> 
                    <input type="text" name="nrc[]" id="nrc_no" class="nrc_no" required>
                </div>
                
            </div>

            <div class="row mt-2 mb-4">
                <div class="col-md-3">
                    <label for="">Select Course</label><br/>
                </div>
                <div class="col-md-7 row">
                @foreach(config('course.name') as $key=>$value) 
                    <div class="col-md-4 row">
                        <div class="col-md-8">
                            <input type="checkbox" name="course[]" id="{{$value}}" value="{{$value}}" class="check-cls">
                            <label for="label_{{$value}}">{{$value}}</label>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

            

            <div class="row mb-4">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="text-align: right;">
                    <a href="{{route('student.index')}}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-create" disabled="disabled">Create</button>
                </div>
            </div>
        </form>
        
    </div>

@endsection

@section('javascript')
    <script>
        $(".check-cls").click(function() {
            $(".btn-create").attr("disabled", !$('.check-cls').is(":checked"));
        });
    </script>
    
@endsection()