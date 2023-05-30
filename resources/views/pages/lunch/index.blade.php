@include('layouts.header')
<link
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

@section('title', 'Home')

<style>
    td .p {
        font-size: 14px !important;
    }
    .remove-icon-position{
        position: absolute;
        top: -10px;
        right: 0px;
        cursor: pointer;
        display: none;
    }
    .edit-icon-position{
        position: absolute;
        top: -10px;
        right: 30px;
        cursor: pointer;
        display: none;
    }
    .nav-tabs .nav-item:hover .remove-icon-position, .nav-tabs .nav-item:hover .edit-icon-position{
        display: block;
    }

</style>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('layouts.nav')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.layout')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row d-flex justify-content-between align-items-center">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0" style="text-transform: capitalize;">
                                {{ $pagename }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/menupage">Menupage</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">{{ $pagename }}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">{{ $page_id }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12 mb-2">
                    
                </div>
            </div>
            <div class="content-body">
                <section id="nav-tabs-aligned">
                    <div class="row match-height">
                        <!-- Centered Aligned Tabs starts -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                                        <div>
                                            <div class="form-modal-ex">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inlineForm">
                                                    Add
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel33">Category</h4>
                                                                <button type="button" class="close category-modal-close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="#" class="category-create-modal">
                                                                <div class="modal-body">
                                                                    <label>Category Name: </label>
                                                                    <div class="form-group">
                                                                        <input type="text" placeholder="Category" class="form-control category-text" required/>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-primary btn-add-category">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($categories as $category)
                                            <li class="nav-item">
                                                <a class="nav-link {{$category->id == $firstid ? 'active' : ''}}" id="tab-category-{{$category->id}}" data-toggle="tab" href="#category-{{$category->id}}" aria-controls="category-{{$category->id}}" role="tab" aria-selected="true">
                                                    {{$category->name}}
                                                </a>
                                                <i data-feather='edit-2' class="edit-icon-position" data-id="{{$category->id}}"></i>
                                                <i data-feather='x' class="remove-icon-position" data-id="{{$category->id}}"></i>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                    <div class="tab-content mt-3">
                                        @foreach ($categories as $category)
                                            <div class="tab-pane {{$category->id == $firstid ?'active' : ''}}" id="category-{{$category->id}}" aria-labelledby="tab-category-{{$category->id}}" role="tabpanel">
                                                <p>
                                                    <h2>{{$category->name}}</h2>
                                                    <button type="button" class="btn btn-primary">Add</button>
                                                </p>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h4></h4>
                                                                <p></p>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Centered Aligned Tabs ends -->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('layouts.footer')
    <script>
        '@if (session()->has('message'))<div class="alert alert-success">' + toastr["success"]("{{ session()->get('message') }}") + '</div>@endif';
        
        $('.category-create-modal').on('submit', function(e){
            var category_text = $('.category-text').val();
            $('.category-modal-close').click();
            var url = '{{route('category.create')}}';
            var page_id = '{{$page_id}}';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: url,
                data: {name : category_text, page_id : page_id},
                success: function(data) {
                    if(data['success']){
                        var id = data['success'];
                        $('.nav-tabs').append("<li class='nav-item'><a class='nav-link' id='tab-category-"+id+"' data-toggle='tab' href='#category-"+id+"' aria-controls='category-"+id+"' role='tab' aria-selected='false'>"+category_text+"</a><i data-feather='edit-2' class='edit-icon-position'></i><i data-feather='x' class='remove-icon-position'></i></li>");

                        $('.tab-content').append("<div class='tab-pane' id='category-"+id+"' aria-labelledby='tab-category-"+id+"' role='tabpanel'><p><h2>"+category_text+"</h2></p><table class='table'><tbody></tbody></table></div>");
                    }
                    else{
                        
                    }
                }
            });
            
        });

        $(document).on('click', '.edit-icon-position', function(e){
            var dataid = $(this).data('id');
            console.log('dataid', dataid);
        });

    </script>
</body>
