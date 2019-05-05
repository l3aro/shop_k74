@extends('client.layout.main')
@section('title', 'Giỏ hàng')
@section('content')
<div class="colorlib-shop">
    <div class="container table-cart">
        @include('client.table_cart')
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function() {
        bindBtnUpdate();
        bindBtnDelete();
    });

    function bindBtnUpdate() {
        $('.btn-update').click(function(e) {
            e.preventDefault();
            let data = {};
            $('.input-number').each(function(index, element) {
                let id = $(this).attr('data-id');
                let value = $(this).val();
                data[id] = value;
            });
            data["_token"] = "{{csrf_token()}}";
            
            $.ajax({
                url: '/gio-hang/sua',
                method: 'POST',
                data: data,
                success: function(scs) {
                    $('.table-cart').html(scs);
                    bindBtnUpdate();
                }
            });
        });
    }

    function bindBtnDelete() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Bạn có chắc không?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: 'Thôi, không xóa',
                confirmButtonText: 'Đúng, xóa nó đi!'
                }).then((result) => {
                if (result.value) {
                    let data = {};
                    data["id"] = $(this).attr('data-id');
                    data["_token"] = "{{csrf_token()}}";
                    
                    $.ajax({
                        url: '/gio-hang/xoa',
                        method: 'POST',
                        data: data,
                        success: function(scs) {
                            $('.table-cart').html(scs);
                            bindBtnDelete();
                        }
                    });
                }
            })
        });
    }
        
</script>
@endpush
