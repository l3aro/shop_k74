@extends('admin.layout.main') 
@section('title', 'Category') 
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh mục</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/admin/categories/create" class="btn btn-primary">Thêm danh mục</a>
                            <h3 style="margin: 0;"><strong>Phân cấp Menu</strong></h3>
                            <div class="vertical-menu">
                                <div class="item-menu active">Danh mục </div>
                                {{-- Start categories --}}
                                @if ($categories->count() > 0)
                                @foreach ($categories as $category)
                                <div class="item-menu"><span>{{$category->name}}</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="/admin/categories/{{$category->id}}/edit"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div>
                                @php 
                                if (!is_null($category->sub)) {
                                    printSubCategories($category->sub, 1);
                                } 
                                @endphp
                                @endforeach
                                @endif


                                {{-- <div class="item-menu"><span>Nam</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div>
                                <div class="item-menu"><span>---|Áo khoác Nam</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div>
                                <div class="item-menu"><span>---|---|Áo khoác Nam (Dành cho việc mở rộng)</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div>
                                <div class="item-menu"><span>Nữ</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div>
                                <div class="item-menu"><span>---|Áo khoác Nữ</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div> --}}
                                {{-- end categories --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.col-->


    </div>
    <!--/.row-->
</div>
@endsection

@php
    function printSubCategories($categories, $nth) 
    {
        foreach ($categories as $category) {
            echo '
            <div class="item-menu"><span>'.printMark($nth).$category->name.'</span>
                <div class="category-fix">
                    <a class="btn-category btn-primary" href="/admin/categories/'.$category->id.'/edit"><i
                                                class="fa fa-edit"></i></a>
                    <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                </div>
            </div>
            ';
            if (!is_null($category->sub)) {
                printSubCategories($category->sub, $nth+1);
            }
        }
    }

    function printMark($times)
    {
        $mark = '';
        for ($i = 0; $i < $times; $i++) {
            $mark .= '---|';
        }
        return $mark;
    }
@endphp