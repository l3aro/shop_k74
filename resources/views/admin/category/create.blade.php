@extends('admin.layout.main') 
@section('title', 'Category') 
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
            <li class="active">Icons</li>
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
                            @if (session()->has('success'))
                            <div class="alert bg-success" role="alert">
                                <svg class="glyph stroked checkmark">
                                    <use xlink:href="#stroked-checkmark"></use>
                                </svg> Đã sửa danh mục thành công! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                            @endif
                            <form action="/admin/categories" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Danh mục cha:</label>
                                    <select class="form-control" name="parent">
                                            <option value="0">----ROOT----</option>
                                            {{-- <option>Nam</option>
                                            <option>---|Áo khoác nam</option>
                                            <option>---|---|Áo khoác nam</option>
                                            <option selected>Nữ</option>
                                            <option>---|Áo khoác nữ</option> --}}
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên Danh mục</label>
                                    <input required type="text" class="form-control" name="name" placeholder="Tên danh mục mới">
                                    @if (session()->has('conflict'))
                                    <div class="alert bg-danger" role="alert">
                                        <svg class="glyph stroked cancel">
                                                <use xlink:href="#stroked-cancel"></use>
                                            </svg>Tên danh mục đã tồn tại!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                    </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
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