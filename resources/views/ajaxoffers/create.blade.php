@extends('layouts.app')
@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{__('offer.header')}}
            </div>
            <div class="container">
                <div class="alert alert-success" id="msg_success" style="display: none" role="alert">
                    <strong>تم الحفظ بنجاح</strong>
                </div>
                <form method="POST" id="offerForm" action="" enctype="multipart/form-data" >
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                    <div class="form-group row">
                        <label for="inputName">{{__('offer.offer name ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" placeholder="">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror

                    </div>
                    <div class="form-group row">
                        <label for="inputName">{{__('offer.offer name en')}}</label>
                        <input type="text" class="form-control" name="name_en" placeholder="">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror

                    </div>
                    <div class="form-group row">
                        <label for="inputName" >{{__('offer.offer price')}}</label>
                        <input type="text" class="form-control" name="price" placeholder="">
                         @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                         @enderror
                    </div>

                    <div class="form-group row">
                        <label for="inputName">{{__('offer.offer details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar"  placeholder="">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="inputName">{{__('offer.offer details en')}}</label>
                        <input type="text" class="form-control" name="details_en"  placeholder="">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="inputName">{{__('offer.offer img')}}</label>
                        <input type="file" class="form-control" name="offer_img" >
                        @error('offer_img')
                        <small class="form-text text-danger">{{$message}}</small>
                         @enderror
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button id="save_offer" class="btn btn-primary">{{__('offer.btn')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@section('scripts')
<script>
     $(document).on('click','#save_offer',function(e){
        e.preventDefault();
        var formData = new FormData($('#offerForm')[0]);
        $.ajax({
                type: 'post',
                enctype:'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data : formData ,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true){
                        $('#msg_success').show();
                    }


                }, error: function (reject) {

                }
            });

     });

</script>
@stop
