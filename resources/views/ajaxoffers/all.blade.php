@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="alert alert-success" id="msg_success" style="display: none" role="alert">
                <strong>تم الحفظ بنجاح</strong>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('offer.offer name')}}</th>
                    <th scope="col">{{__('offer.offer price')}}</th>
                    <th scope="col">{{__('offer.offer details')}}</th>
                    <th scope="col">{{__('offer.img_offer')}}</th>
                    <th scope="col">{{__('offer.operation')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr class="offerRow{{$offer->id}}">
                            <th scope="row">{{$offer->id}}</th>
                            <td>{{$offer->name}}</td>
                            <td>{{$offer->price}}</td>
                            <td>{{$offer->details}}</td>
                                <td><img style="width: 80px" src="{{asset('images/offers/'.$offer->offer_img)}}" alt=""></td>
                            <td>
                                <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-primary">{{__('offer.update offer')}}</a>
                                <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger">{{__('offer.delete offer')}}</a>
                                <a href="" offer_id="{{$offer->id}}"  class="delete_btn btn btn-danger">Delete Ajax</a>
                                <a href="{{route('ajax.offers.edit',$offer->id)}}" class="btn btn-primary">Update Aj</a>

                            </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        @stop
        @section('scripts')
<script>
     $(document).on('click','.delete_btn',function(e){
        e.preventDefault();
        var offer_id = $(this).attr('offer_id');
        $.ajax({
                type: 'post',
                enctype:'multipart/form-data',
                url: "{{route('ajax.offers.delete')}}",
                data :{
                    '_token':"{{csrf_token()}}",
                    'id' : offer_id
                },
                success: function (data) {
                    if(data.status == true){
                        $('#msg_success').show();
                    }
                    $('.offerRow'+data.id).remove();

                }, error: function (reject) {

                }
            });

     });

</script>
@stop
