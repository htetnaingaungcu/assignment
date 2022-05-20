@extends('layout.app')

@section('content')

    <div class="main">
        <div class="table-form">
            <h4>Student List</h4>

            
            <div class="table-header">  
                <div class="table-header-left"> 
                    <!-- <i class="fa fa-table" aria-hidden="true" style="margin-right: 3px;"></i><label>Table</label> -->
                </div>
                <div class="table-header-right">
                    <div class="">
                        <form action="" method="get" id="search_data">
                            <div class="input-group search">  
                                <div></div>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border:none; background:none;"><i class="fas fa-search" ></i></span>
                                </div>                              
                                <input type="text" name="search" class="form-control searchData" style="border:none" placeholder="Type to search ..." id="searchData" value="{{Request::get('search')}}">
                            </div>
                        </form>
                    </div> 

                </div>
            </div>

            <div class="table-filter">
                <div>
                    <div class="show-filter-data">

                        @if(Request::get('name'))
                        <span><i class="fa fa-font" aria-hidden="true"></i>Name : {{Request::get('name')}}</span>
                        @endif

                        @if(Request::get('dob'))
                        <span><i class="fa fa-calendar" aria-hidden="true"></i>Date of Birth : {{Request::get('dob')}}</span>
                        @endif

                        @if(Request::get('email'))
                        <span><i class="fa fa-at" aria-hidden="true"></i>Email : {{Request::get('email')}}</span>
                        @endif

                        @if(Request::get('nrc'))
                        <span><i class="fa fa-align-left" aria-hidden="true"></i>NRC : {{Request::get('nrc')}}</span>
                        @endif

                        @if(Request::get('course'))
                            
                            <span><i class="fa fa-list" aria-hidden="true"></i>Course : 
                                @foreach(explode(',', Request::get('course')) as $course)
                                {{$course}}
                                @endforeach
                            </span>                        
                        @endif
                    </div>
                    <div class="filter-list-name">
                        <button class="add-filter-btn" onclick="showFilter()">
                            <span><i class="fas fa-plus"></i></span>
                            Add Filter
                        </button>
                        <select name="filter-list" onChange="filterDataOnChange()" id="filter-list" class="filter-list">
                            <option value="" style="color:#ccc;">Filter by ...</option>
                            <option value="name" {{Request::get('name') ? 'disabled' : ''}}>Name</option>
                            <option value="dob" {{Request::get('dob') ? 'disabled' : ''}}>Date of Birth</option>
                            <option value="email" {{Request::get('email') ? 'disabled' : ''}}>Email</option>
                            <option value="nrc" {{Request::get('nrc') ? 'disabled' : ''}}>NRC</option>
                            <option value="course" {{Request::get('course') ? 'disabled' : ''}}>Course</option>
                        </select>
                    </div>
                    <div class="filter-input-gp">
                        <div class="">
                            <input type="text" class="filter-input" id="filter-input">
                            <select name="filter-course-select" id="filter-course-select" class="filter-course-select" multiple>
                                @foreach(config('course.name') as $key=>$value) 
                                    <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-icon">
                            <div class="filter-choose-wrapper"> 
                                <span class="filter-choose" style="cursor: pointer; margin-right: 10px" onclick="filterChoose()">
                                    <i class="fas fa-check"></i>
                                </span>
                            </div>
                            <div>
                                <span class="filter-clear" style="cursor: pointer;" onclick="filterClear()">
                                    <i class="far fa-times-circle"></i>
                                </span>
                            </div>   
                        </div>                                     
                    </div>
                </div>
                
                <div>
                    <div class="filter-data-reset text-right">
                        @if(Request::get('name') || Request::get('dob') || Request::get('email') || Request::get('nrc') || Request::get('course'))
                        <button class="filter-reset-btn" onclick="filterReset()">Reset</button>
                        @endif
                    </div>
                </div>
                
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <label><i class="fa fa-font" aria-hidden="true"></i>Name</label>
                            <span class="sort-asc" onclick="sortData('name_sort', '{{(Request::get('name_sort') == 'asc' || Request::get('name_sort') == null) ? 'desc' : 'asc'}}')">
                                @if(Request::get('name_sort') == 'asc' || Request::get('name_sort') == null)
                                    <i class="fas fa-sort-amount-up"></i>
                                @else
                                    <i class="fas fa-sort-amount-down"></i>
                                @endif
                            </span>
                        </th>
                        <th>
                            <label><i class="fa fa-calendar" aria-hidden="true"></i>Date of Birth</label>
                            <span class="sort-asc" onclick="sortData('dob_sort', '{{(Request::get('dob_sort') == 'asc' || Request::get('dob_sort') == null) ? 'desc' : 'asc'}}')">
                                @if(Request::get('dob_sort') == 'asc' || Request::get('dob_sort') == null)
                                    <i class="fas fa-sort-amount-up"></i>
                                @else
                                    <i class="fas fa-sort-amount-down"></i>
                                @endif
                            </span>
                        </th>
                        <th>
                            <label><i class="fa fa-at" aria-hidden="true"></i>Email</label>
                            <span class="sort-asc" onclick="sortData('email_sort', '{{(Request::get('email_sort') == 'asc' || Request::get('email_sort') == null) ? 'desc' : 'asc'}}')">
                                @if(Request::get('email_sort') == 'asc' || Request::get('email_sort') == null)
                                    <i class="fas fa-sort-amount-up"></i>
                                @else
                                    <i class="fas fa-sort-amount-down"></i>
                                @endif
                            </span>
                        </th>
                        <th>
                            <label><i class="fa fa-align-left" aria-hidden="true"></i>NRC</label>
                            <span class="sort-asc" onclick="sortData('nrc_sort', '{{(Request::get('nrc_sort') == 'asc' || Request::get('nrc_sort') == null) ? 'desc' : 'asc'}}')">
                                @if(Request::get('nrc_sort') == 'asc' || Request::get('nrc_sort') == null)
                                    <i class="fas fa-sort-amount-up"></i>
                                @else
                                    <i class="fas fa-sort-amount-down"></i>
                                @endif
                            </span>
                        </th>
                        <th>
                            <label><i class="fa fa-list" aria-hidden="true"></i>Course</label>
                            <span class="sort-asc" onclick="sortData('course_sort', '{{(Request::get('course_sort') == 'asc' || Request::get('course_sort') == null) ? 'desc' : 'asc'}}')">
                                @if(Request::get('course_sort') == 'asc' || Request::get('course_sort') == null)
                                    <i class="fas fa-sort-amount-up"></i>
                                @else
                                    <i class="fas fa-sort-amount-down"></i>
                                @endif
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>
                            <label for="">{{$student->name}}</label>
                        </td>
                        <td>
                            <label for="">{{date('Y-m-d',strtotime($student->dob))}}</label>
                        </td>
                        <td>
                            <label for="">{{$student->email}}</label>
                        </td>
                        <td>
                            <label for="">{{$student->nrc}}</label>
                        </td>
                        <td class="courses">
                            <label for="">
                                @if($student->course || !isset($student->course)) 
                                    @foreach(json_decode($student->course) as $cs) 
                                        <span>{{$cs}}</span>
                                    @endforeach
                                @endif
                            </label>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
        <div>
            <a href="{{route('student.create')}}">Create student</a>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        

        function sortData(key, value) {
            const urlParams = new URLSearchParams(window.location.search);
            
            if(key.includes('_sort')) {
                urlParams.delete('name_sort');
                urlParams.delete('dob_sort');
                urlParams.delete('email_sort');
                urlParams.delete('nrc_sort');
                urlParams.delete('course_sort');

            } 
            
            urlParams.set(key, value);

            let main_url = window.location.href.split('?')[0];
            main_url += "?"+urlParams.toString();
            window.location = main_url;
        }

        function filterDataOnChange() {
            let filter = $('.filter-list').val();
            let filter_input = $('.filter-input').val();
            $('.filter-input').val('');
            if($('.filter-list').val() == 'dob') {
                $('.filter-input').attr('type', 'date');
                $('.filter-input').addClass('input-date');
                $('.filter-course-select').hide();
                $('.filter-input').show();
                $('.filter-choose-wrapper').css({
                    'margin-bottom' : '0'
                })


            }
            else if($('.filter-list').val() == 'course') {
                $('.filter-course-select').show();
                $('.filter-input').hide();
                $('.filter-input').removeClass('input-date');
                $('.filter-choose-wrapper').css({
                    'margin-bottom' : '4px'
                })
            }
             else {
                $('.filter-course-select').hide();
                $('.filter-input').removeClass('input-date');
                $('.filter-input').show();
                $('.filter-input').attr('type', 'text');
                $('.filter-choose-wrapper').css({
                    'margin-bottom' : '0'
                })
            }

            $('.filter-input-gp').css({
                'display': 'flex'
            })
            
        }

        function filterDataAppend() {
            let filter = $('.filter-list').val();
            let filter_input = $('.filter-input').val();
            if(filter_input) {
                $('.show-filter-data').append("<span>"+filter+"-"+filter_input+"</span>");
            }
            
        }

        function filterChoose(key, value) {
            const urlParams = new URLSearchParams(window.location.search);
            key = $('#filter-list').val();
            if($('#filter-list').val() == 'course') {
                value = $('#filter-course-select').val();
            } else {
                value = $('#filter-input').val();
            }
            
             
            
                urlParams.delete(key);
                urlParams.set(key, value);


            let main_url = window.location.href.split('?')[0];
            main_url += "?"+urlParams.toString();
            window.location = main_url;

            $('.filter-input-gp').css({
                'display': 'none'
            })
            filterDataAppend();
            $('.filter-input').val('');
            $(".filter-list option:selected").attr('disabled','disabled');

            $('.add-filter-btn').show();
            $('.filter-list').hide();            
        }

        function filterClear() {
            $('.filter-input').val('');
            
            $('.filter-input-gp').css({
                'display': 'none'
            })

        }       

        function showFilter() {
            $('.add-filter-btn').hide();
            $('.filter-list').show();
        }

        function filterReset() {
            window.location = "/student";
        }

        
        
    </script>
@endsection